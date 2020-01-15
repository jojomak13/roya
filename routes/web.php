<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$middlewares = [
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
];

Route::group($middlewares, function(){
	Route::get('/', 'HomeController@index')->name('home');
	
	Route::get('/shop', 'ShopController@index')->name('shop');

	Route::get('/product/{id}-{slug}', 'HomeController@show')->name('product');
	Route::post('/review/{product}', 'HomeController@review')->name('product.review');

	Route::get('/blog', 'BlogController@index')->name('blog.index');
	Route::get('/blog/{blog}-{slug}', 'BlogController@show')->name('blog.show');

	Route::get('/cart', 'CartController@index')->name('cart.index');
	Route::post('/cart', 'CartController@store')->name('cart.store');

	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');

	Route::get('/wishlist', 'WishlistController@show');

	Auth::routes(['verify' => true]);
});

