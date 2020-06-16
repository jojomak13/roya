<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Country;
use App\Product;
use App\Mail\OrderInvoice;
use Illuminate\Http\Request;
use App\Http\Resources\UserCart;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Api\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

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

        return response()->json([
            'products' => new UserCart($cart),
            'total_price' => auth()->user()->totalPrice()
        ]);
    }


    private function calcCart($product, $quantity)
    {
        $res = \DB::table('cart')
            ->where('user_id', auth()->user()->id)
            ->where('product_id', $product->id)
            ->get();

        $data = [];
        if($res->count()){
            $data = unserialize($res[0]->data);
        }

        $data[request()->color] = $quantity;

        $quantity = 0;
        foreach ($data as $key => $value) {
            $quantity += $value;
        }

        return ['data' => serialize($data), 'quantity' => $quantity];
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
        
        $res = $this->calcCart($product, $quantity);

        $maxQuantity = $product->stores->first()->pivot->quantity;

        if($res['quantity'] > $maxQuantity){
            return response()->json(['status' => false, 'message' => __('user.cart.outOfQuantity', ['quantity' => $maxQuantity])]);
        }

        auth()->user()->cart()->syncWithoutDetaching([$request->product_id => [
            'quantity' => $res['quantity'],
            'data' => $res['data']
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

        $res = $this->calcCart($product, $request->quantity);

        if($res['quantity'] > $maxQuantity){
            return response()->json(['status' => false, 'message' =>  __('user.cart.outOfQuantity', ['quantity' => $maxQuantity])]);
            
        } else {
            auth()->user()->cart()->syncWithoutDetaching([$id => [
                'quantity' => $res['quantity'],
                'data' => $res['data']
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
        $product = Product::findOrFail($id);

        $res = \DB::table('cart')
            ->where('user_id', auth()->user()->id)
            ->where('product_id', $product->id)
            ->get();
        
        $res = unserialize($res[0]->data);

        unset($res[request()->color]);
        
        if(!count($res)){
            auth()->user()->cart()->detach($id);
        } else {
            $quantity = 0;
            foreach($res as $key => $value){
                $quantity += $value;
            }

            auth()->user()->cart()->syncWithoutDetaching([$id => [
                'quantity' => $quantity,
                'data' => serialize($res)
            ]]);
        }

        return response()->json(['status' => true, 'message' => __('user.cart.removed')]);
    }

    public function checkout()
    {
        $user = auth()->user();
        $cart = $user->cart; 
        $countries = Country::all();

        return response()->json([
            'cart' => new UserCart($cart),
            'total_price' => $user->totalPrice(),
            'countries' => $countries
        ]);
    }

    public function procced(Request $request)
    {
        $request->validate(['agree' => 'required']);
        $user = auth()->user();
        
        $this->updateUser($user);         

        if(true){
            $handledProducts = auth()->user()->handleProducts();

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => auth()->user()->totalPrice(),
                'status' => 'preparing'
            ]);
            $order->createOrder($handledProducts);
            
            Product::updateQuantity($handledProducts);
        
            auth()->user()->emptyCart();

            Mail::to(auth()->user()->email)->queue(new OrderInvoice($order));

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
