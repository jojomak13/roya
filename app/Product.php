<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name_en', 'name_ar', 'buy_price', 'sell_price', 'weight', 'description_en', 'description_ar', 'user_id', 'category_id'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function search($request)
    {
        return  static::where(lang('name'), 'like', '%' . $request->search . '%')->paginate(10);
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


}
