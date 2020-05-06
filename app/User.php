<?php

namespace App;

use App\Jobs\VerifyEmail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'address', 'image', 'age', 'gender', 'news', 'phone', 'city', 'postal_code', 'country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
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

    protected $appends = [
        'profile_image'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
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
    
    public function getprofileImageAttribute()
    {
        return $this->image ? url('storage/'.$this->image) : asset('admin/images/avatar.png'); 
    }

    public function scopeWorker($query)
    {
        return $query->wherePermissionIs('read_dashboard');
    }

    public function scopeSearch($query, $request)
    {
        return  $query->orWhere('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%');
    }

    public function review()
    {
        return $this->belongsToMany(Product::class)->withPivot(['stars', 'feedback'])->withTimeStamps();
    }
    
    public function favorites(){
        return $this->belongsToMany(Product::class, 'favorites')
            ->with('firstImage')
            ->withTimeStamps();
    } 

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Product::class, 'cart')
            ->with(['firstImage'])
            ->withPivot(['quantity', 'data'])
            ->withTimestamps();
    }
    
    public function cartQuantity()
    {
        $quantity = 0;
        foreach ($this->cart as $product) {
            $quantity += $product->pivot->quantity;
        }

        return $quantity;
    }

    public function TotalPrice()
    {
        $totalPrice = 0;

        foreach($this->cart as $product){
            $totalPrice += ($product->price * $product->pivot->quantity) + 40;
        }

        return $totalPrice;
    }

    public function handleProducts()
    {
        $products = [];

        foreach($this->cart as $product){
            $products[$product->id] = [
                'quantity' => $product->pivot->quantity,
                'total_price' => $product->pivot->quantity * $product->price,
                'data' => $product->pivot->data
            ];
        }

        return $products;
    }

    public function emptyCart()
    {
        $this->cart()->detach();
    } 
}
