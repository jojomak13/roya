<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return \App\User::all();
});

Route::post('login', 'Api\UserController@login');

Route::post('register', 'Api\UserController@register');

Route::get('categories', 'Api\CategoryController@index');

Route::get('products/{category}', 'Api\ProductController@index');
Route::get('product/{product}', 'Api\ProductController@show');

Route::get('/shop', 'Api\ShopController@index');
Route::get('/shop/{id}', 'Api\ShopController@show');