<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_orders'])->only(['create', 'store']);
        $this->middleware(['permission:read_orders'])->only('index');
        $this->middleware(['permission:update_orders'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_orders'])->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDataTable $orders)
    {
        return $orders->render('admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Order::handleOrder($request->all());

        $order = Order::create([
            'status' => 'completed',
            'total_price' => $data['total_price'],
            'user_id' => auth()->user()->id

        ]);
        $order->createOrder($data['products']);
        

        Product::updateQuantity($data['products']);
        
        return response()->json(['order' => $order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order = $order->load(['products', 'user']);
        
        return view('admin.orders.show', compact('order'));
    }

    public function print(Order $order)
    {
        $order = $order->load(['products', 'user']);
        
        return view('admin.orders.print', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order = $order->load(['products', 'user']);
        
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        if($order->status == 'preparing'){
            $order->update([
                'status' => 'shipping'
            ]);   
            
        } else if($order->status == 'shipping'){
            $order->update([
                'status' => 'completed'
            ]);   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        session()->flash('success', __('dashboard.orders.delete_success'));
        return redirect()->route('admin.orders.index');
    }
}
