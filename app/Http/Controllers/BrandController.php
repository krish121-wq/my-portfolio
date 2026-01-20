<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::latest()->get();
        return view ('admin.brands.brands', compact('brands'));
    }

    public function create(){
        return view ('admin.brands.create');
    }

    public function store(Request $request){
        $request->validate([
         'name' => 'required|unique:brands|max:255'
        ]);

        Brand::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand Added Successfully');

    }

    public function edit($id){
        $brand = Brand::findorFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id){
        $request->validate([
         'name' => 'required|max:255|unique:brands,name,'.$id
        ]);

        $brand = Brand::findorFail($id);
        $brand->update([
         'name' => $request->name,
         'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand Update SuccessFully');
    }

    public function destroy($id){
        Brand::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Brand Deleted Successfully');
    }

}
