<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($data)){
            return response()->json(['status' => false, 'message' => __('auth.failed')]);
        }

        return response()->json(['user' => auth()->user()]);      
    }

    public function register(Request $request)
    {
        $user = User::create($this->validateForm())->attachRole('user');
        $user->generateToken();

        return response()->json(['user' => $user]);      
    }

    public function validateForm()
    {
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required',
            'image' => 'image',
            'age' => 'required',
            'gender' => 'required'
        ]);

        if(request()->has('image'))
            $data['image'] = User::upload(request());

        $data['password'] = bCrypt($data['password']);

        return $data;
    }
}
