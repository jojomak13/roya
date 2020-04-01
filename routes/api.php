<?php

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
	Route::post('/update', 'AuthController@update');
	Route::post('/logout', 'AuthController@logout');
});

Route::middleware('auth:api')->group(function(){

// Home controller
Route::get('/home', 'HomeController@index');

// Main Search
Route::post('/search', 'HomeController@search');

// Shop 
Route::get('/shop/home', 'ShopController@home');
Route::get('/shop/show', 'ShopController@category');

// Product Controller
Route::get('product/{product}', 'ProductController@show');
Route::post('product/{product}/review', 'ProductController@review');

// Categories
Route::get('categories', 'CategoryController@index');

// Cart Controller
Route::resource('/cart', 'CartController');
Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');
Route::post('/procced', 'CartController@procced')->name('cart.procced');


// Wishlist Controller
Route::get('/wishlist', 'wishlistController@index');
Route::post('/wishlist', 'wishlistController@store');

Route::get('products/{category}', 'ProductController@index');
});

// For Front End only
Route::get('/shop', 'ShopController@index');
Route::get('/shop/{id}', 'ShopController@show');
