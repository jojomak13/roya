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

Route::post('login', 'UserController@login');

Route::post('register', 'UserController@register');

Route::get('categories', 'CategoryController@index');

Route::get('products/{category}', 'ProductController@index');
Route::get('product/{product}', 'ProductController@show');

Route::get('/shop', 'ShopController@index');
Route::get('/shop/{id}', 'ShopController@show');

// Home controller
Route::get('/home', 'HomeController@index');

// Main Search
Route::post('/search', 'HomeController@search');
