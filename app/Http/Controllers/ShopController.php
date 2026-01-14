<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function shop()
    {
        // 1. 'withCount' use kiya taki view me count lene ke liye bar-bar query na chale (Optimized)
        $categories = Category::withCount('products')->get()->groupBy('category');
        
        // 2. Pagination ke sath products fetch kiye
        $products = Product::latest()->paginate(6);

        return view('main.shop', compact('products', 'categories'));
    }

    public function ProductByCategory($id)
    {
        $category = Category::withCount('products')->findOrFail($id);
        
        // Relationship ke through paginate kiya
        $products = $category->products()->latest()->paginate(6);
        
        // Sidebar ke liye saari categories chahiye hongi
        $categories = Category::withCount('products')->get()->groupBy('category');

        return view('main.shop', compact('products', 'categories', 'category'));
    }

    public function single_product($id)
    {
        $singleProduct = Product::with('category')->findOrFail($id);
        return view('main.product_details', compact('singleProduct'));
    }
}