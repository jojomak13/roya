<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $cred = $request->only(['email', 'password']);

        if(!$token = JWTAuth::attempt($cred)){
            return response()->json(['status' => false, 'error' => __('auth.failed')], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validateForm());

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $roles = $request->all();
        $roles['password'] = bCrypt($request->password);  

        User::create($roles)->attachRole('user');

        return response()->json(['message' => __('user.user_created')], 201);  
    }

    public function update(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        } catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error' => $e->getMessage()]);
        }

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

        return response()->json(['status' => true, 'message' => __('user.auth.editSuccess')]);
    }

    public function self(){
        try {
            $user = auth()->userOrFail()->load('country', 'orders', 'orders.products');
        } catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error' => $e->getMessage()]);
        }

        return response()->json(['user' => $user]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['status' => true, 'message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }

    protected function validateForm()
    {
        $roles = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'address' => 'required',
            'age' => 'required|integer|min:16|max:100',
            'gender' => 'required',
            'news' => ''
        ];

        return $roles;
    }
}