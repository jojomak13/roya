<?php

namespace App;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name_en', 'name_ar', 'barcode', 'buy_price', 'sell_price', 'weight', 'description_en', 'description_ar', 'user_id', 'category_id', 'status', 'color', 'discount', 'offer_id', 'brand_id'];
    protected $appends = ['total_rate', 'product_rate', 'price', 'url', 'handled_status', 'barcode'];

    protected $with = ['category'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function firstImage()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product')->withTimeStamps();
    }
    
    public function stores()
    {
        return $this->belongsToMany(Store::class)->withPivot(['quantity'])->withTimeStamps();
    }

    public function votes()
    {
        return $this->belongsToMany(User::class)
            ->using('App\Review')
            ->select('users.id', 'first_name', 'last_name')
            ->withPivot(['stars', 'feedback'])
            ->withTimeStamps();
    }

    public function getTotalRateAttribute()
    {
        return $this->votes->count() ? ($this->votes()->sum('stars') / ($this->votes()->count() * 5)) * 5 : 0;
    }

    public function getProductRateAttribute()
    {
        $res = [];
        for ($i = 5 - floor($this->total_rate); $i > 0; $i--)
            $res[] = '<i class="fa fa-star"></i>';
            
        for($i = 1; $i <= floor($this->total_rate); $i++)
            $res[] = '<i class="fa fa-star active"></i>';
    
        return ($res);
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
        return round($this->sell_price - (($this->discount * $this->sell_price) / 100));
    }

    public function getUrlAttribute()
    {
        return route('product', [$this->id, \Str::slug($this->{lang('name')})]);
    }

    public function getBarcodeAttribute()
    {
        return $this->id;
    }

    public static function search($request)
    {
        return  static::where(lang('name'), 'like', '%' . $request->search . '%')->paginate(10);
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

    public function upload($images)
    {
        foreach ($images as $image) {
            $uploadedImage = $image->store('products/'.$this->id);
            $this->images()->create(['url' => $uploadedImage]);
            
            \Image::make('storage/'.$uploadedImage)->resize(470, 560)->save();
        }
    }

    public static function updateQuantity($products)
    {
        foreach($products as $id => $data){
            $product = static::findOrFail($id);
            $product->stores[0]->pivot->quantity -= $data['quantity'];

            $product->stores[0]->pivot->save();
            
            if(!$product->stores[0]->pivot->quantity){
                $product->status = 'outOfStock';
                $product->save();
            }
        }
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

    public function getHandledStatusAttribute()
    {
        return [
            '' => ['', ''],
            'available' => ['Available', 'primary'],
            'hot' => ['Hot', 'danger'],
            'offer' => ['Offer', 'warning'],
            'outOfStock' => ['Out Of Stock', 'danger'],
        ][$this->status];
    }

}
