<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Order;
use App\Country;
use App\Product;

class CartController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('cart')->only(['checkout']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = auth()->user()->cart;

        return response()->json(['products' => $cart]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?: 1;
        
        $maxQuantity = $product->stores->first()->pivot->quantity;

        if($quantity > $maxQuantity){
            return response()->json(['status' => false, 'message' => __('user.cart.outOfQuantity', ['quantity' => $maxQuantity])]);
        }

        auth()->user()->cart()->syncWithoutDetaching([$request->product_id => [
            'quantity' => $quantity
        ]]);

        return response()->json(['status' => true, 'message' => __('user.cart.addSuccess')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $maxQuantity = $product->stores->first()->pivot->quantity;

        if($request->quantity > $maxQuantity){
            return response()->json(['status' => false, 'message' =>  __('user.cart.outOfQuantity', ['quantity' => $maxQuantity])]);
            
        } else {
            auth()->user()->cart()->syncWithoutDetaching([$id => [
                'quantity' => $request->quantity
            ]]);
            
            return response()->json(['status' => true, 'message' => __('user.cart.updated')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->cart()->detach($id);

        return response()->json(['status' => true, 'message' => __('user.cart.removed')]);
    }

    public function checkout()
    {
        $user = auth()->user();
        $cart = $user->cart; 
        $countries = Country::all();

        return response()->json([
            'cart' => $cart,
            'total_price' => $user->totalPrice(),
            'countries' => $countries
        ]);
    }

    public function procced(Request $request)
    {
        $request->validate(['agree' => 'required']);
        $user = auth()->user();
        
        $this->updateUser($user);         

        $charge = Stripe::charges()->create([
            'currency' => 'EGP',
            'source' => $request->stripeToken,
            'amount' => auth()->user()->totalPrice(),
            'description' => 'Order'
        ]);

        if($charge['id']){
            $handledProducts = auth()->user()->handleProducts();

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => auth()->user()->totalPrice(),
                'status' => 'preparing'
            ])->createOrder($handledProducts);
            
            Product::updateQuantity($handledProducts);
        
            auth()->user()->emptyCart();

            return response()->json(['status' => true, 'message' => __('user.cart.order_created')]);
            
        } 

        return response()->json(['status' => true, 'message' => __('user.cart.order_failed')]);
    }

    private function updateUser($user)
    {
        $user->update(request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required|string|min:11|max:13',
            'city' => 'required|min:3|max:20|nullable',
            'country_id' => 'required|integer|nullable',
            'postal_code' => 'required|max:10|nullable',
        ]));
    }
}
