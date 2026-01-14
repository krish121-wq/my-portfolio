<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
class HomeController extends Controller
{
    public function index(){
      $OurProduct = product::latest()->take(8)->get();

    $ComingProduct = product::inRandomOrder()->take(8)->get(); 

    return view('main.index', compact('OurProduct', 'ComingProduct'));
    }
}
