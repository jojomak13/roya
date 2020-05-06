<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsOrder extends Model
{
    protected $table = 'order_product';
    protected $fillable = ['name_en', 'name_ar', 'price', 'quantity', 'order_id', 'barcode', 'data'];
    protected $appends = ['serialized_data', 'colors_data'];

    public function getSerializedDataAttribute()
    {
        return unserialize($this->data);
    }

    public function getColorsDataAttribute()
    {
        $data = [];
        foreach(unserialize($this->data) as $color => $quantity){
            $data[] = [
                'color' => $color,
                'quantity' => $quantity
            ];
        }
        return $data;
    }
}
