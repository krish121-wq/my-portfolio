<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wishlists;
use App\Models\product; // Model name ka dhyan rakhein (Capital W)
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Route me apne 'index' naam diya hai listing ke liye
    public function index()
    {
        $wishlists = wishlists::where('user_id', Auth::id())->with('product')->get();
        return view('main.wishlist', compact('wishlists'));
    }

    // Route me apne 'addtowishlist' naam diya hai, to yahan bhi wahi hona chahiye
    public function addtowishlist(Request $request)
    {
        // 1. Login Check
        if (!Auth::check()) {
            return response()->json(['error' => 'Please login first'], 401);
        }

        try {
            // 2. Check Duplicate
            $exists = wishlists::where('user_id', Auth::id())
                              ->where('product_id', $request->product_id)
                              ->exists();

            if ($exists) {
                return response()->json(['success' => 'Item already in Wishlist!']);
            }

            // 3. Save Data (Migration ke hisaab se small 'category_id')
            $wishlist = new wishlists();
            $wishlist->user_id = Auth::id();
            $wishlist->product_id = $request->product_id;
            $wishlist->category_id = $request->category_id; // Small 'i' confirm
            $wishlist->save();

            return response()->json(['success' => 'Item added to Wishlist successfully!']);

        } catch (\Exception $e) {
            // Error dikhane ke liye
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteWishlist($id)
    {
        wishlists::where('user_id', Auth::id())->where('product_id', $id)->delete();
        return redirect()->back()->with('success', 'Item removed from wishlist');
    }
}