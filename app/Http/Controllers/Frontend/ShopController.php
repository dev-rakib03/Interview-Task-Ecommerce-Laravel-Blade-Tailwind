<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        $minPrice = Product::public()->min('price');
        $maxPrice = Product::public()->max('price');
        return view('frontend.shop.index', compact('minPrice', 'maxPrice'));
    }
    public function product_show($slug)
    {
        $product = Product::where('slug', $slug)->public()->first();
        if (!$product) {
            abort(404);
        }
        return view('frontend.shop.product', compact('product'));
    }
    public function product_list(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('categories')->public()->latest();

            if ($request->category) {
                $products = $products->whereHas('categories', function ($query) use ($request) {
                    $query->where('id', $request->category);
                });
            }

            if ($request->min && $request->max) {
                $products = $products->whereBetween('price', [$request->min, $request->max]);
            }

            $products = $products->paginate(30);
            $view = view('frontend.shop.partials.product_card', compact('products'))->render();
            return response()->json(['success' => true, 'products' => $view, 'next_page_url' => $products->nextPageUrl()]);
        }
        abort(404);
    }
}
