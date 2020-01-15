<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index()
    {
        $user = auth()->user();
        return view('user.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('user.profile.edit', compact('user'));
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
            'image' => 'image',
            'news' => ''
        ];

        if(!empty($request->get('password')))
        $roles['password'] = 'min:8|confirmed'; 
        
        $roles = $request->validate($roles);

        if(array_key_exists('password', $roles)){
            $roles['password'] = BCrypt($roles['password']);
        }

        $roles['news'] = $request->has('news')? true : false; 
        
        $user->update($roles);

        session()->flash('success', __('user.auth.editSuccess'));
        return redirect()->route('profile');
    }
}
