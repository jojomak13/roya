<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name_en', 'name_ar'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
