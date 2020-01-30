<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    
    public function products()
    {
        return $this->hasMany(ProductsOrder::class, 'order_id', 'id');
    } 

    public function getStatusAttribute($status)
    {
        return [
            'payment_pending' =>  __('dashboard.orders.payment_pending'),
            'preparing' =>  __('dashboard.orders.preparing'),
            'shipping' =>  __('dashboard.orders.shipping'),
            'completed' =>  __('dashboard.orders.completed'),
            'error' =>  __('dashboard.orders.error'),
        ][$status];
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
                'name_en'  => $product->name_en,
                'name_ar'  => $product->name_ar,
                'price'    => $product->price,
                'quantity' => $productData['quantity']
            ]);
        }   
    }

}
