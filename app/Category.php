<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name_en', 'name_ar', 'parent_id', 'image', 'background_image'];
    protected $appends = ['children_count', 'url', 'category_image', 'category_background'];

    public function getChildrenCountAttribute()
    {
        return $this->childrens()->count();
    }

    public function scopeParent($query)
    {
        return $query->where('parent_id', '0');
    }

    public function childrens()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public static function search($request)
    {
        return  static::where('parent_id', '0')->where(lang('name'), 'like', '%' . $request->search . '%')->paginate(10);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function geturlAttribute()
    {
        return route('shop.show', [$this->id, \Str::slug($this->{lang('name')})]);
    }

    public function getCategoryImageAttribute()
    {
        return $this->image? url('storage/'.$this->image) : asset('admin/images/category.png');
    }

    public function getCategoryBackgroundAttribute()
    {
        return $this->background_image? url('storage/'.$this->background_image) : asset('admin/images/category_background.png');
    }

    public function uploadImage($imageName = 'image', $size = [24, 24])
    {
        if(request()->has($imageName)){
            request()->validate([$imageName => 'image']);

            \Storage::delete($this->$imageName);

            $uploadedImage = request()->$imageName->store('categories/');
            
            \Image::make('storage/'.$uploadedImage)->resize(...$size)->save();

            $this->update([$imageName => $uploadedImage]);
        }

        return $this;
    }

}
