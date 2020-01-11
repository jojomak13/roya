<?php

namespace App;

use Intervention\Image\Facades\Image;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'address', 'image', 'age', 'gender', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_login'
    ];

    public function generateToken()
    {
        $this->api_token = Str::random(60);
        $this->save();
    }
    
    public function fullName()
    {
        return ucfirst($this->first_name . ' ' . $this->last_name);
    }

    public static function upload($request, $user = null)
    {
        if($user)
            \Storage::delete($user->image);

        $image = $request->image->store('users');

        Image::make('storage/'.$image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
        })->save();

        return $image;
    }

    public function image()
    {
        return $this->image ? url('storage/'.$this->image) : asset('admin/images/avatar.png'); 
    }

    public static function search($request)
    {
        return  static::where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->paginate(10);
    }

    public function review()
    {
        return $this->belongsToMany(Product::class)->withPivot(['stars', 'feedback'])->withTimeStamps();
    }
}
