<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slideshows = \App\SlideShow::latest()->get();
        $categories = \App\Category::parent()->with('childrens')->get();
        $newProducts = \App\Product::latest()
            ->with(['firstImage', 'category'])->take(10)->get();

        $hotProducts = \App\Product::latest()
            ->where('status', 'hot')->with(['firstImage', 'category'])->take(10)->get();

        $offers = \App\Offer::latest()->with(['products' => function($el){
                $el->with(['firstImage', 'category'])->take(4);
            }])->get();
        
        $latestBlogs = \App\Blog::latest()->take(5)->get();

        return response()->json([
            'slideshow' => $slideshows,
            'categories' => $categories,
            'newProducts' => $newProducts,
            'hotProducts' => $hotProducts,
            'offers' => $offers,
            'latestBlogs' => $latestBlogs
        ]);
    }

}
