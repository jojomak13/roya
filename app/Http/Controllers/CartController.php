<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = product::where('id', $request->product_id)->with('firstImage')->first();
        
        if($product && $product->status != 'outOfStock'){
            Cart::add($product, 1);
            return response()->json(['status' => true, 'message' => __('user.cart.addSuccess')]);
            
        }  else if($product && $product->status == 'outOfStock') {
            return response()->json(['status' => true, 'message' => __('user.cart.outOfStock')]);
        }

        return response()->json(['status' => false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {   
        $roles = $request->validate(['qty' => 'required|integer']);
        $maxQuantity = $product->stores->first()->pivot->quantity;

        if($maxQuantity < $request->qty){
            session()->flash('warning', __('user.cart.outOfQuantity', ['quantity' => $maxQuantity])); 

        } else {
            
            Cart::update($product, $roles['qty']);
            session()->flash('success', __('user.cart.updated'));
        }


        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Cart::delete($product->id);

        session()->flash('success', __('user.cart.removed'));
        return redirect()->route('cart.index');
    }
}
