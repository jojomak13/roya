<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $slideshows = \App\SlideShow::latest()->get();
        $categories = \App\Category::parent()->with('childrens')->get();
        $brands = \App\Brand::latest()->get();
        $colors = Product::select('color')->distinct()->get();    
 
        return view('user.shop', compact(
            'slideshows',
            'categories',
            'brands',
            'colors'
        ));
    }
}
