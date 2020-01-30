<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsOrder extends Model
{
    protected $table = 'order_product';
    protected $fillable = ['name_en', 'name_ar', 'price', 'quantity', 'order_id'];
}
