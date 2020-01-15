<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function show()
    {
        $products = \App\Product::latest()
        ->select('id', 'category_id', 'name_en', 'name_ar', 'status')
        ->whereIn('id', request('products'))
        ->with(['firstImage', 'category'])->take(10)->get();

        return response()->json(['products' => $products]);
    }
}
