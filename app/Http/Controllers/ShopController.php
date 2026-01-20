<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Brand;

class ShopController extends Controller
{
   
    private function getFilteredProducts($request, $query)
    {
       
        if ($request->filled('brand')) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('slug', $request->brand);
            });
        }

        if ($request->filled('color')) {
            $query->where('color_id', $request->color);
        }

        
    if ($request->filled('min_price') && $request->filled('max_price')) {
        $min = (int) $request->min_price;
        $max = (int) $request->max_price;
    
        $query->whereBetween('price', [$request->min_price, $request->max_price]);
    }

       
        return $query->latest()->paginate(6)->withQueryString();
    }

    public function shop(Request $request)
    {
        
        $brands = Brand::withCount('products')->get();
        $colors = Color::withCount('products')->get();
        $categories = Category::withCount('products')->get()->groupBy('category');

       
        $products = $this->getFilteredProducts($request, Product::query());

        return view('main.shop', compact('products', 'categories', 'brands', 'colors'));
    }

    public function ProductByCategory(Request $request, $id)
    {
       
        $category = Category::findOrFail($id);

      
        $brands = Brand::withCount('products')->get();
        $colors = Color::withCount('products')->get();
        $categories = Category::withCount('products')->get()->groupBy('category');

     
        $products = $this->getFilteredProducts($request, $category->products());

        return view('main.shop', compact('products', 'categories', 'category', 'brands', 'colors'));
    }

   public function single_product($id)
{
    $product = Product::with(['category', 'brand', 'color'])->findOrFail($id);

    $relatedProducts = Product::where('category_id', $product->category_id)
                              ->where('id', '!=', $id) 
                              ->inRandomOrder()        
                              ->take(4)                
                              ->get();

    return view('main.single-product', compact('product', 'relatedProducts'));
}
}