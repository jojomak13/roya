<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Country;
use App\Product;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified')->only(['checkout']);
        $this->middleware('cart')->only(['checkout']);
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = product::where('id', $request->product_id)->with('firstImage')->first();
        $quantity = $request->quantity ?: 1;

        if($product && $product->status != 'outOfStock'){

            $maxQuantity = $product->stores->first()->pivot->quantity;

            if(Cart::has($product->id)){

                if($maxQuantity < Cart::get($product->id)['quantity'] + $quantity){
                    return response()->json(['status' => true, 'message' => __('user.cart.outOfQuantity', ['quantity' => $maxQuantity])]);
                } 
                
            } else {
                if($maxQuantity < $quantity)
                    return response()->json(['status' => true, 'message' => __('user.cart.outOfQuantity', ['quantity' => $maxQuantity])]);
            }

            Cart::add($product, $quantity);
            return response()->json(['status' => true, 'message' => __('user.cart.addSuccess')]);
            
        }  else if($product && $product->status == 'outOfStock') {
            return response()->json(['status' => true, 'message' => __('user.cart.outOfStock')]);
        }

        return response()->json(['status' => false]);
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


    public function checkout()
    {
        $user = auth()->user();
        $countries = Country::all();

        return view('user.checkout', compact('user', 'countries'));
    }

    public function procced(Request $request)
    {
        $request->validate(['agree' => 'required']);
        $user = auth()->user();
        
        $this->updateUser($user);         

        $charge = Stripe::charges()->create([
            'currency' => 'EGP',
            'source' => $request->stripeToken,
            'amount' => Cart::totalPrice(),
            'description' => 'Order'
        ]);

        if($charge['id']){
            $handledProducts = Cart::handleProducts();

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => Cart::totalPrice(),
                'status' => 'preparing'
            ])->createOrder($handledProducts);
            
            Product::updateQuantity($handledProducts);
        
            Cart::clear();

            session()->flash('success', __('user.cart.order_created'));

        } else {
            session()->flash('warning', __('user.cart.order_failed'));
        }

        return redirect()->route('home');
    }

    private function updateUser($user)
    {
        $user->update(request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required|string|min:11|max:13',
            'city' => 'min:3|max:20|nullable',
            'country_id' => 'integer|nullable',
            'postal_code' => 'max:10|nullable',
        ]));
    }

}
