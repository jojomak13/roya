<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'address', 'user_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function search($request)
    {
        return  static::where('name', 'like', '%' . $request->search . '%')
            ->with('user')->paginate(10);
    }
}
