<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->only(['review']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        return Product::where('category_id', $category->id)->with('images')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('images');
        $productRates = \App\Review::productRates($product->id);
        $relatedProducts = Product::with('firstImage')->where('category_id', $product->category->id)->take(10)->inRandomOrder()->get();

        return response()->json([
            'product' => $product,
            'rate' => $productRates,
            'related' => $relatedProducts 
        ]);
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

        return response()->json(['status' => true, 'message' => __('user.reviews.voted_message')], 201);
    }

}
