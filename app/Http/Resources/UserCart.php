<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCart extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        foreach($this->collection as $product){
            $data = [];
            foreach(unserialize($product->pivot->data) as $color => $quantity){
                $data[] = [
                    'color' => $color,
                    'quantity' => $quantity
                ];
            }

            $product->pivot->data = $data;
        }

        return $this->collection;
    }
}
