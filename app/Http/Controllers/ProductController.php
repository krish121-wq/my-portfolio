<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;

class ProductController extends Controller
{
    public function index()
    {
        // Relationship ke sath load kiya taaki Brands/Colors table me dikha sakein
        $OurProduct = Product::with(['category', 'brand', 'color'])->get();
        return view('admin.product.product', compact('OurProduct'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->get(); // Assuming parent categories
        $subcategories = Category::where('parent_id', '!=', 0)->get(); // Assuming subcategories
        $brands = Brand::all();
        $colors = Color::all();

        return view('admin.product.create', compact('categories', 'subcategories', 'brands', 'colors'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'subcategory_id' => 'nullable|integer',
            'brand_id' => 'nullable|exists:brands,id',
            'color_id' => 'nullable|exists:colors,id',
            'price' => 'required|integer',
            'mrp' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $validateData['image'] = $imageName;
        }

        Product::create($validateData);
        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function show(string $id)
    {
        $product = Product::with(['category', 'brand', 'color'])->findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    public function edit(string $id)
    {
        $OurProduct = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Category::all(); // Adjust logic as per your DB structure
        $brands = Brand::all();
        $colors = Color::all();

        return view('admin.product.edit', compact('OurProduct', 'categories', 'subcategories', 'brands', 'colors'));
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'subcategory_id' => 'nullable|integer',
            'brand_id' => 'nullable|exists:brands,id',
            'color_id' => 'nullable|exists:colors,id',
            'price' => 'required|integer',
            'mrp' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Optional: Delete old image here if needed
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $validateData['image'] = $imageName;
        }

        $product->update($validateData);
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path('img/' . $product->image))) {
            unlink(public_path('img/' . $product->image)); // Delete image file
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}