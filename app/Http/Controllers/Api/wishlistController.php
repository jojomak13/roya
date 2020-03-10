<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class wishlistController extends Controller
{
    public function index()
    {
        return auth()->user()->favorites;
    }

    public function store(Request $request)
    {
        $request->validate(['product' => 'required|integer']);

        auth()->user()->favorites()->toggle($request->product);       
        
        if(auth()->user()->favorites->find($request->product))
            return response()->json(['status' => true, 'message' => __('user.wishlist.add_success')]);

        return response()->json(['status' => true, 'message' => __('user.wishlist.delete_success')]);
    }
}
