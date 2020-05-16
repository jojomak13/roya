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
        $newProducts = \App\Product::latest()
            // ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price')
            ->with(['firstImage', 'category'])->take(10)->get();

        $hotProducts = \App\Product::latest()
            // ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price')
            ->where('status', 'hot')->with(['firstImage', 'category'])->take(10)->get();

        $offers = \App\Offer::latest()->with(['products' => function($el){
            $el->with(['firstImage', 'category'])->take(4);
        }])->get();

        $latestBlogs = \App\Blog::latest()->take(5)->get();
        $latestCats = \App\Category::where('parent_id', '!=', 0)->latest()->take(5)->get();

        // $products = \App\Product::select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price')->get();
        $products = \App\Product::all();

        $topRated = $products->sortByDesc(function($product){
            return $product->total_rate;
        })->take(5);

        return view('user.index', compact(
            'slideshows',
            'categories',
            'newProducts',
            'hotProducts',
            'offers',
            'latestBlogs',
            'latestCats',
            'topRated'
        ));
    }

    public function show($id)
    {
        $product = Product::with('images', 'colors')->findOrFail($id);
        $relatedProducts = Product::with('firstImage')->where('category_id', $product->category->id)->take(10)->inRandomOrder()->get();

        $productRates = \App\Review::productRates($id);
        
        return view('user.product', compact('product', 'relatedProducts', 'productRates'));
    }

    public function review(Request $request, Product $product)
    {
        $roles = $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'feedback' => 'required|min:10'
        ], [], [
            'stars' => __('user.reviews.rate'),
            'feedback' => __('user.reviews.feedback')
        ]);
        
        $product->votes()->syncWithoutDetaching([
            auth()->user()->id => $roles
        ]);
        
        session()->flash('success', __('user.reviews.voted_message'));
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $products = Product::select('id', 'name_en', 'name_ar', 'status')
            ->with('firstImage')
            ->Where('name_en', 'like', '%' . $request->search . '%')
            ->orWhere('name_ar', 'like', '%' . $request->search . '%')
            ->take(5)
            ->get();

        return $products;
    }

    public function terms()
    {
        return view('user.terms');
    }

}
