<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name_en', 'name_ar', 'parent_id'];
    protected $appends = ['children_count', 'url'];

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
}
