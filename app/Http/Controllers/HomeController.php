<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $slideshows = \App\SlideShow::latest()->get();
        $categories = \App\Category::parent()->with('childrens')->get();
        $newProducts = \App\Product::latest()->with(['firstImage', 'category'])->take(10)->get();
        $hotProducts = \App\Product::latest()->where('status', 'hot')->with(['firstImage', 'category'])->take(10)->get();
        $offers = \App\Offer::latest()->with(['products' => function($el){
            $el->with(['firstImage', 'category'])->take(4);
        }])->get();

        return view('user.index', compact(
            'slideshows',
            'categories',
            'newProducts',
            'hotProducts',
            'offers'
        ));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $relatedProducts = Product::with('firstImage')->where('category_id', $product->category->id)->get()->shuffle();
        
        return view('user.product', compact('product', 'relatedProducts'));
    }
}
