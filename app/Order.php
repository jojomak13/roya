<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'total_price'])->withTimeStamps();
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
}
