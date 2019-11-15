<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];
    protected $append = ['children_count'];

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
        return  static::where('parent_id', '0')->where('name', 'like', '%' . $request->search . '%')->paginate(10);
    }
    
    public function deleteWithChilds()
    {
        $childs = static::where('parent_id', $this->id)->get();

        foreach ($childs as $child){
            $child->delete();
        }

        return $this->delete();
    }
}
