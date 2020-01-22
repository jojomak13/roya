<?php

namespace App;

class Cart
{
    public $items = [];
    public $totalItems = 0;
    public $totalPrice = 0;

    public function __construct($cart = null)
    {
        if($cart){
            $this->items = $cart->items;
            $this->totalItems = $cart->totalItems;
            $this->totalPrice = $cart->totalPrice;
        }
    }

    private static function init()
    {
        if(static::hasCart())
            $cart = new static(session()->get('cart'));
        else
            $cart = new static();
        
        return $cart;
    }

    public static function add($product, $quantity = 1)
    {
        $item = [
            'id' => $product->id,
            'name_en' => $product->name_en,
            'name_ar' => $product->name_ar,
            'image' => $product->firstImage->url,
            'price' => $product->price,
            'quantity' => $quantity 
        ];
        
        $cart = static::init();
        $cart->totalItems += $quantity;
        $cart->totalPrice += ($product->price * $quantity);

        if(!array_key_exists($product->id, $cart->items))
            $cart->items[$product->id] = $item;
        else 
            $cart->items[$product->id]['quantity'] += $quantity;
        
        session()->put('cart', $cart);
    }

    public static function delete($id)
    {
        $cart = static::init();
        if(array_key_exists($id, $cart->items)){
            $cart->totalItems -= $cart->items[$id]['quantity'];
            $cart->totalPrice -= ($cart->items[$id]['quantity'] * $cart->items[$id]['price']);
            unset($cart->items[$id]);
            
            session()->forget('cart');
            session()->put('cart', $cart);
        }
    }
    
    public static function update($product, $quantity)
    {
        $cart = static::init();
        if(array_key_exists($product->id, $cart->items)){
            $cart->totalItems -= $cart->items[$product->id]['quantity'];
            $cart->totalPrice -= ($cart->items[$product->id]['quantity'] * $cart->items[$product->id]['price']);

            $cart->items[$product->id]['quantity'] = $quantity; 
            $cart->totalItems += $quantity;
            $cart->totalPrice += ($product->price * $quantity);

            session()->forget('cart');
            session()->put('cart', $cart);
        }
    }

    private static function hasCart()
    {
        return session()->has('cart')? session()->get('cart') : false;
    }

    public static function quantity()
    {
        if(static::hasCart()){
           return static::hasCart()->totalItems; 
        }

        return 0;
    }

    public static function get($id)
    {
        return static::init()->items[$id];
    } 

    public static function has($id)
    {
        return array_key_exists($id, static::init()->items);
    }

    public static function items()
    {
        return static::init()->items;
    }

    public static function totalPrice()
    {
        return static::init()->totalPrice;
    }

    public static function totalItems()
    {
        return static::init()->totalItems;
    }

    public static function clear()
    {
        return session()->forget('cart');
    }

    public static function handleProducts()
    {
        $products = [];

        foreach(static::items() as $key => $value){
            $products[$key] = [
                'quantity' => $value['quantity'],
                'total_price' => $value['quantity'] * $value['price'] 
            ];
        }

        return $products;
    }

}
