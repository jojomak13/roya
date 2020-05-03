<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Factory;

class Order extends Model
{
    protected $guarded = [];
    protected $appends = ['order_status'];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function products()
    {
        return $this->hasMany(ProductsOrder::class, 'order_id', 'id');
    } 

    public static function boot()
    {
        parent::boot();
        static::creating(function($product)
        {
            $facotry = Factory::create();
            $product->barcode = $facotry->unique()->isbn10; 
        });   
    }

    public function getOrderStatusAttribute()
    {
        return [
            'payment_pending' =>  __('dashboard.orders.payment_pending'),
            'unpaid'          =>  __('dashboard.orders.unpaid'),
            'preparing'       =>  __('dashboard.orders.preparing'),
            'shipping'        =>  __('dashboard.orders.shipping'),
            'completed'       =>  __('dashboard.orders.completed'),
            'error'           =>  __('dashboard.orders.error'),
        ][$this->status];
    }

    public static function handleOrder($request)
    {
        $sum = 0;
        $products = [];
        foreach ($request as $product) {
            $sum += $product['totalPrice'];

            if($product['quantity']){
                $products[$product['productId']] = [
                    'quantity' => $product['quantity'],
                    'total_price' => $product['totalPrice']
                ];
            }
            
        }

        return ['products' => $products, 'total_price' => $sum];
    }

    public function createOrder($products)
    {
        foreach($products as $id => $productData){
            $product = Product::findOrFail($id);

            $this->products()->create([
                'barcode'  => $product->barcode,
                'name_en'  => $product->name_en,
                'name_ar'  => $product->name_ar,
                'price'    => $product->price,
                'quantity' => $productData['quantity'],
                'data'     => $productData['data'] ?? 'a:0:{}'
            ]);
        }   
    }

}
