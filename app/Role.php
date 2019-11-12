<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = ['name', 'description'];

    public function scopeCommon($query)
    {
        return $query->where('name', '!=', 'admin');
    }
}
