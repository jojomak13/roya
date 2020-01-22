<?php

namespace App;

use App\Jobs\VerifyEmail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'address', 'image', 'age', 'gender', 'news', 'api_token', 'phone', 'city', 'postal_code', 'country_id'
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
    
    // public function sendEmailVerificationNotification()
    // {
    //     VerifyEmail::dispatch($this);
    // }
    
    public function fullName()
    {
        return ucfirst($this->first_name . ' ' . $this->last_name);
    }
 
    public function uploadImage($imageName = 'image')
    {
        if(request()->has('image')){
            request()->validate(['image' => 'image']);

            \Storage::delete($this->image);

            $uploadedImage = request()->image->store('users/');

            \Image::make('storage/'.$uploadedImage)->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();

            $this->update(['image' => $uploadedImage]);
        }

        return $this;
    }

    public function imageUrl()
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
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
