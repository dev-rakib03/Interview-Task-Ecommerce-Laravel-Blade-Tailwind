<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $cards = [
            [
                'title' => 'Total Categories',
                'count' => Category::count(),
                'icon' => 'fas fa-tags',
                'color' => 'bg-green-500',
            ],
            [
                'title' => 'Total Products',
                'count' => Product::count(),
                'icon' => 'fas fa-box',
                'color' => 'bg-blue-500',
            ],
            [
                'title' => 'Total Public Products',
                'count' => Product::where('status', 'public')->count(),
                'icon' => 'fas fa-eye',
                'color' => 'bg-yellow-500',
            ],
            [
                'title' => 'Total Hidden Products',
                'count' => Product::where('status', 'hidden')->count(),
                'icon' => 'fas fa-eye-slash',
                'color' => 'bg-purple-500',
            ],
        ];
        return view('admin.dashboard.index', compact('cards'));
    }
}
