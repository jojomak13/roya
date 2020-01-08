<?php

namespace App\Http\Controllers;

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
        return $categories;
        return view('user.index', compact('slideshows'));
    }
}
