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

        User::create($roles);

        return response()->json(['message' => __('user.user_created')], 201);  
    }

    public function self(){
        try {
            $user = auth()->userOrFail()->load('country');
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