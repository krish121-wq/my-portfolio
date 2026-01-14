<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;  // Make sure model name starts with Capital P
use App\Models\Category; // Make sure model name starts with Capital C

class ProductController extends Controller
{
    public function index(){
        $OurProduct = Product::all();
        return view('admin.product.product', compact('OurProduct'));
    }

    public function create(){
        // 1. Yaha 'Product::all()' tha, maine 'Category::all()' kar diya
        $categories = Category::all(); 
        $subcategories = Category::all();
        return view('admin.product.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer', // Min/max removed for simplicity, works better
            'price' => 'required|integer',
            'mrp' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if($request->hasfile('image')){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $validateData['image'] = $imageName;
        }

        Product::create($validateData);
        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function show(string $id){ // 'stirng' spelling fixed to 'string'
        $product = Product::with('category')->findOrFail($id); // 'products' changed to 'Product'
        return view('admin.product.show', compact('product'));
    }

    public function edit(string $id){
        $categories = Category::all();
        $subcategories = Category::all();
        $OurProduct = Product::findOrFail($id); // 'products' changed to 'Product'
        return view('admin.product.edit', compact('OurProduct', 'categories', 'subcategories'));
    }

    public function update(Request $request, string $id){
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'price' => 'required|integer',
            'mrp' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',  
        ]);

        $product = Product::findOrFail($id); // 'products' changed to 'Product'

        if($request->hasfile('image')){
             $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            // 2. Variable spelling fix: $validatedData -> $validateData
            $validateData['image'] = $imageName; 
        }

        $product->update($validateData);
        return redirect()->route('product.index')->with('success', 'Data updated successfully');
    }

    public function destroy(string $id){
        $product = Product::findOrFail($id); // 'products' changed to 'Product'
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}