<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
class ColorController extends Controller
{
    public function index(){
        $colors = Color::latest()->get();
        return view('admin.colors.colors', compact('colors'));
    }

    public function create() {
        return view('admin.colors.create');
    }

    public function store(Request $request){
        $request->validate([
         'name' => 'required|max:255',
         'code' => 'required|max:255'

        ]);

        Color::create([
        'name' => $request->name,
        'code' => $request->code
        ]);

        return redirect()->route('colors.index')->with('success', 'Color Added Successfully');

    }

    public function edit($id){
        $color = Color::findorFail($id);
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255'

        ]);

        $color = Color::findorFail($id);
        $color->update([
            'name' => $request->name,
            'code' => $request->code

        ]);

        return redirect()->route('colors.index')->with('success', 'Color Update Sccessfully');
    }

    public function destroy($id){
        Color::findorFail($id)->delete();
        return redirect()->back()->with('success', 'Color Deleted Successfully');

        
    }
}
