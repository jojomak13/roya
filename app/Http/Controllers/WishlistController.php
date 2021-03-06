<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wishlist = auth()->user()->favorites;
        return view('user.wishlist', compact('wishlist'));
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
