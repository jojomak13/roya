<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return view('user.wishlist');
    }

    public function show()
    {
        $products = \App\Product::latest()
        ->select('id', 'category_id', 'name_en', 'name_ar', 'status')
        ->whereIn('id', request('products'))
        ->with(['firstImage', 'category'])->get();

        return response()->json(['products' => $products]);
    }
}
