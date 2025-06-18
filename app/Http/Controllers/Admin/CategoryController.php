<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::query()
                ->select(['id', 'name'])
                ->orderBy('id', 'desc');
            return DataTables::of($categories)
                ->addColumn('sl', function ($row) {
                    static $index = 0;
                    return ++$index;
                })
                ->addColumn('action', function ($row) {
                    $html = '';
                    $html .= '<button class="edit-category inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" data-id="' . $row->id . '" data-name="' . htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') . '">Edit</button>';
                    $html .= ' <button class="delete-category inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500" data-id="' . $row->id . '">Delete</button>';
                    return $html;
                })
                ->rawColumns(['sl','action'])
                ->make(true);
        }

        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404, 'Not Found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if ($validated === false) {
            return response()->json(['success' => false, 'message' => $request->errors()]);
        }

        try {
            $category = new Category();
            $category->name = $validated['name'];
            $category->save();
        } catch (\Throwable $th) {
            if (env('APP_DEBUG', false)) {
                return response()->json(['success' => false, 'message' => $th->getMessage()]);
            } else {
                return response()->json(['success' => false, 'message' => ['Something went wrong.']]);
            }
        }
        return response()->json(['success' => true, 'message' => ['Category created successfully.'], 'category' => $category]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404, 'Not Found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404, 'Not Found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if ($validated === false) {
            return response()->json(['success' => false, 'message' => $request->errors()]);
        }

        try {
            $category = Category::findOrFail($id);
            $category->name = $validated['name'];
            $category->update();
        } catch (\Throwable $th) {
            if (env('APP_DEBUG', false)) {
                return response()->json(['success' => false, 'message' => $th->getMessage()]);
            } else {
                return response()->json(['success' => false, 'message' => ['Something went wrong.']]);
            }
        }

        return response()->json(['success' => true, 'message' => ['Category updated successfully.']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            if ($category->products()->exists()) {
                return response()->json(['success' => false, 'message' => ['Category cannot be deleted because it has associated products.']]);
            }
            $category->delete();
        } catch (\Throwable $th) {
            if (env('APP_DEBUG', false)) {
                return response()->json(['success' => false, 'message' => $th->getMessage()]);
            } else {
                return response()->json(['success' => false, 'message' => ['Something went wrong.']]);
            }
        }
        return response()->json(['success' => true, 'message' => ['Category deleted successfully.']]);
    }
}
