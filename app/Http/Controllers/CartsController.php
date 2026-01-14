<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function index()
    {
        $carts = Carts::where('user_id', Auth::id())->with('product')->get();
        return view('main.cart', compact('carts'));
    }

    public function addtocart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please login first'], 401);
        }

        $exists = Carts::where('user_id', Auth::id())
                       ->where('product_id', $request->product_id)
                       ->exists();

        if ($exists) {
            return response()->json(['status' => 'info', 'message' => 'Product Already Added!']);
        }

        try {
            $cart = new Carts();
            $cart->user_id = Auth::id();
            $cart->product_id = $request->product_id;
            $cart->price = $request->price;
            $cart->category_id = $request->category_id;
            $cart->quantity = 1;
            $cart->save();

            return response()->json(['status' => 'success', 'message' => 'Added to Cart Successfully!']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateCartAjax(Request $request)
    {
        if(Auth::check() && $request->id && $request->quantity) {
            
            $cartItem = Carts::where('user_id', Auth::id())
                            ->where('product_id', $request->id)
                            ->first();

            if($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
                
                return response()->json(['success' => true]);
            }
        }
        
        return response()->json(['success' => false], 400);
    }

    public function deleteCarts($productId)
    {
        Carts::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        return redirect()->back()->with('success', 'Product removed successfully');
    }
}