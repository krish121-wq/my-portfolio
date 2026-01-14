<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category; 

class CategoryController extends Controller
{
    public function index()
    {
        $categories = category::all(); 
        return view('admin.category.category', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
        ]);

        category::create($validatedData);

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    public function edit(string $id)
    {
        $category = category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
        ]);

        $category = category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id)
    {
        $category = category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}