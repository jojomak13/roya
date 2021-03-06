<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Helpers\Fawry;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user()->load(['favorites', 'orders' => function($order){
            $order->latest()->with('products');
        }]);
        
        return view('user.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        $countries = Country::all();
        $cards = (new Fawry)->listCustomerTokens(auth()->user());

        return view('user.profile.edit', compact('user', 'countries', 'cards'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $roles = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'address' => 'required',
            'phone' => 'required|string|min:11|max:13',
            'news' => '',
            'city' => 'min:3|max:20|nullable',
            'country_id' => 'integer|nullable',
            'postal_code' => 'max:10|nullable'
        ];

        if(!empty($request->get('password')))
            $roles['password'] = 'min:8|confirmed'; 
        
        $roles = $request->validate($roles);

        if(array_key_exists('password', $roles)){
            $roles['password'] = BCrypt($roles['password']);
        }

        $roles['news'] = $request->has('news')? true : false; 
        
        $user->uploadImage();
        $user->update($roles);

        session()->flash('success', __('user.auth.editSuccess'));
        return redirect()->route('profile');
    }
}
