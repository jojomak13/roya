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

// Auth Controller
Route::prefix('auth')->group(function(){
	Route::post('/self', 'AuthController@self');
	Route::post('/login', 'AuthController@login');
	Route::post('/register', 'AuthController@register');
	Route::post('/logout', 'AuthController@logout');
});

// Home controller
Route::get('/home', 'HomeController@index');

// Main Search
Route::post('/search', 'HomeController@search');

// Shop 
Route::get('/shop/home', 'ShopController@home');
Route::get('/shop/show', 'ShopController@category');


Route::get('categories', 'CategoryController@index');

Route::get('products/{category}', 'ProductController@index');
Route::get('product/{product}', 'ProductController@show');

// For Front End only
Route::get('/shop', 'ShopController@index');
Route::get('/shop/{id}', 'ShopController@show');