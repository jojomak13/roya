<?php

namespace App\Http\Controllers;

use App\Order;
use App\Country;
use App\Product;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CartController extends Controller
{

    public function __construct()
    {
    
        $this->middleware('auth');
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

        return view('user.cart', compact('cart'));
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
            return response()->json(['status' => true, 'message' => __('user.cart.outOfQuantity', ['quantity' => $maxQuantity])]);
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
            session()->flash('success', __('user.cart.outOfQuantity', ['quantity' => $maxQuantity]));
            
        } else {
            auth()->user()->cart()->syncWithoutDetaching([$id => [
                'quantity' => $request->quantity
            ]]);
            
            session()->flash('success', __('user.cart.updated'));
        }

        return redirect()->back();
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

        session()->flash('info', __('user.cart.removed'));
        return redirect()->back();
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
            'city' => 'required|min:3|max:20|nullable',
            'country_id' => 'required|integer|nullable',
            'postal_code' => 'required|max:10|nullable',
        ]));
    }
}
