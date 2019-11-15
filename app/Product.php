<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'buy_price', 'sell_price', 'weight', 'description', 'user_id', 'category_id'];

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }
}
