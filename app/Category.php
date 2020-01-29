<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name_en', 'name_ar', 'parent_id', 'image'];
    protected $appends = ['children_count', 'url', 'category_image'];

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

    public function uploadImage($imageName = 'image')
    {
        if(request()->has($imageName)){
            request()->validate(['image' => 'image']);

            \Storage::delete($this->image);

            $uploadedImage = request()->$imageName->store('categories/');
            
            \Image::make('storage/'.$uploadedImage)->resize(80, 80)->save();

            $this->update(['image' => $uploadedImage]);
        }
    }

}
