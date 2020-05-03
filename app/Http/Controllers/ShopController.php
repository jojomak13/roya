<?php

namespace App\Http\Controllers;

use App\Color;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $slideshows = \App\SlideShow::latest()->get();
        $categories = \App\Category::parent()->with('childrens')->get();
        $brands = \App\Brand::latest()->get();
        $colors = Color::all();    
 
        return view('user.shop.index', compact(
            'slideshows',
            'categories',
            'brands',
            'colors'
        ));
    }

    public function show(Category $category)
    {
        $slideshows = \App\SlideShow::latest()->get();
        $categories = \App\Category::parent()->with('childrens')->get();
        $brands = \App\Brand::latest()->get();
        $colors = Color::all();    
 
        return view('user.shop.show', compact(
            'slideshows',
            'categories',
            'brands',
            'colors',
            'category'
        ));
    }

}
