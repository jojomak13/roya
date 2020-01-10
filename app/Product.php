<?php

namespace App;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name_en', 'name_ar', 'barcode', 'buy_price', 'sell_price', 'weight', 'description_en', 'description_ar', 'user_id', 'category_id', 'status', 'color', 'discount', 'offer_id'];
    protected $append = ['handled_status', 'price', 'url'];
    protected $with = ['category'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function firstImage()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
    public function stores()
    {
        return $this->belongsToMany(Store::class)->withPivot(['quantity'])->withTimeStamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function getPriceAttribute()
    {
        return $this->sell_price - (($this->discount * $this->sell_price) / 100);
    }

    public function getUrlAttribute()
    {
        return route('product', [$this->id, \Str::slug($this->{lang('name')})]);
    }

    public static function search($request)
    {
        return  static::where(lang('name'), 'like', '%' . $request->search . '%')->paginate(10);
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function($product)
        {
            $facotry = Factory::create();
            $product->barcode = $facotry->unique()->isbn10; 
        });   
    }

    public function upload($images)
    {
        foreach ($images as $image) {
            $uploadedImage = $image->store('products/'.$this->id);
            $this->images()->create(['url' => $uploadedImage]);
            
            \Image::make('storage/'.$uploadedImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
    }

    public static function updateQuantity($products)
    {
        foreach($products as $id => $data){
            $product = static::findOrFail($id);
            $product->stores[0]->pivot->quantity -= $data['quantity'];
            $product->stores[0]->pivot->save();
        }
    }

    public static function colors()
    {
        return [
            'black' => '#000',
            'white' => '#fff',
            'gray' => '#CCC',
            'red' => '#900',
            'blue' => '#009',
            'green' => '#090',
            'yellow' => '#990',
            'purple' => '#909'
        ];
    }

    public static function status()
    {
        return [
            'available' => 'Available',
            'hot' => 'Hot',
            'offer' => 'Offer',
            'outOfStock' => 'Out Of Stock',
        ];
    }

    public function gethandledStatusAttribute()
    {
        return [
            'available' => ['Available', 'primary'],
            'hot' => ['Hot', 'danger'],
            'offer' => ['Offer', 'warning'],
            'outOfStock' => ['Out Of Stock', 'danger'],
        ][$this->status];
        
    }

}
