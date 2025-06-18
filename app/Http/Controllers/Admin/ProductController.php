<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('categories')
                ->select(['id', 'name', 'description', 'price', 'sku', 'slug', 'thumbnail', 'images', 'status', 'created_at', 'updated_at'])
                ->orderBy('id', 'desc');

            return DataTables::of($products)
                ->addColumn('sl', function ($row) {
                    static $index = 0;
                    return ++$index;
                })
                ->editColumn('thumbnail', function ($row) {
                    $html = '';
                    if ($row->thumbnail) {
                        $html = '<img src="' . asset('storage/' . $row->thumbnail) . '" alt="Thumbnail" class="h-16 w-10 object-cover rounded"/>';
                    }
                    return $html;
                })
                ->addColumn('categories', function ($row) {
                    $html = '<div class="text-wrap">';
                    $html .= $row->categories
                        ->map(function ($category) {
                            return '<span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-1 px-2.5 py-0.5 rounded m-1">' . e($category->name) . '</span> ';
                        })
                        ->implode(' ');
                    $html .= '</div>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $html = '';
                    $html .= '<a href="' . route('admin.product.show', $row->id) . '" class="view-product inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 mr-1" data-id="' . $row->id . '">View</a>';
                    $html .= '<a href="' . route('admin.product.edit', $row->id) . '" class="edit-product inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mr-1" data-id="' . $row->id . '">Edit</a>';
                    $html .= '<button class="delete-product inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500" data-id="' . $row->id . '">Delete</button>';
                    return $html;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status === 'public') {
                        return '<span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Public</span>';
                    } else {
                        return '<span class="inline-block px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded">Hidden</span>';
                    }
                })
                ->editColumn('price', function ($row) {
                    return number_format($row->price, 2) . ' BDT';
                })
                ->rawColumns(['sl', 'action', 'thumbnail', 'status', 'categories', 'price'])
                ->make(true);
        }

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'sku' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|in:public,hidden',
            'thumbnail' => 'nullable|image',
            'images.*' => 'nullable|image',
            'categories' => 'required|array',
        ]);

        if ($validated === false) {
            return response()->json(['success' => false, 'message' => $request->errors()]);
        }

        try {
            $slug = Str::slug($request->name);

            $product = new Product($request->except('thumbnail', 'images', 'categories'));
            $product->slug = $slug;

            if ($request->hasFile('thumbnail')) {
                $product->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            if ($request->hasFile('images')) {
                $images = collect($request->file('images'))->map(function ($file) {
                    return $file->store('images', 'public');
                });
                $product->images = $images;
            }

            $product->save();

            if ($request->categories) {
                $product->categories()->sync($request->categories);
            }

            return response()->json([
                'success' => true,
                'message' => ['Product created successfully'],
                'product' => $product,
                'redirect' => route('admin.product.index'),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => ['Failed to create product'],
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('categories')->findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255||unique:products,name,' . $id,
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|in:public,hidden',
            'thumbnail' => 'nullable|image',
            'images.*' => 'nullable|image',
            'categories' => 'required|array',
        ]);

        if ($validated === false) {
            return response()->json(['success' => false, 'message' => $request->errors()]);
        }

        try {
            $product = Product::findOrFail($id);
            $product->fill($request->except('thumbnail', 'images', 'categories'));
            $product->slug = Str::slug($request->name);

            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail if exists
                if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                    Storage::disk('public')->delete($product->thumbnail);
                }
                $product->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            if ($request->hasFile('images')) {
                // Delete old images if exists
                if (is_array($product->images) || $product->images instanceof Collection) {
                    foreach ($product->images as $image) {
                        if ($image && Storage::disk('public')->exists($image)) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }
                $images = collect($request->file('images'))->map(function ($file) {
                    return $file->store('images', 'public');
                });
                $product->images = $images;
            }

            $product->save();

            if ($request->categories) {
                $product->categories()->sync($request->categories);
            }

            return response()->json([
                'success' => true,
                'message' => ['Product updated successfully'],
                'product' => $product,
                'redirect' => route('admin.product.index'),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => ['Failed to update product'],
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        try {
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            if (is_array($product->images) || $product->images instanceof Collection) {
                foreach ($product->images as $image) {
                    if ($image && Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $product->categories()->detach();

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => ['Product and related images deleted successfully'],
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => ['Failed to delete product'],
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
