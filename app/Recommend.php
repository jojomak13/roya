<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    protected $guarded = [];

    public static function search($request)
    {
        return  static::where('title', 'like', '%' . $request->search . '%')->latest()->paginate(10);
    }
}
