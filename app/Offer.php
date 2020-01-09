<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['name_en', 'name_ar', 'image'];
    protected $appends = ['max_discount'];

    public function products()
    {
        return $this->hasMany(Product::class);    
    }

    public function getMaxDiscountAttribute()
    {
        return $this->products()->max('discount');
    }

    public function uploadImage($imageName = 'image')
    {
        if(request()->has($imageName)){
            request()->validate(['image' => 'image']);

            \Storage::delete($this->image);

            $uploadedImage = request()->$imageName->store('offers/');
            
            \Image::make('storage/'.$uploadedImage)->resize(850, 200)->save();

            $this->update(['image' => $uploadedImage]);
        }
    }

    public static function search($request)
    {
        return  static::where(lang('name'), 'like', '%' . $request->search . '%')->latest()->paginate(10);
    }
}
