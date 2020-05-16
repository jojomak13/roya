<?php

use App\Events\ProductCreatedEvent;

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
	// Home Page
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/terms', 'HomeController@terms')->name('terms');

	// Main Search
	Route::post('/search', 'HomeController@search')->name('search');
	
	// Shop & category
	Route::get('/shop', 'ShopController@index')->name('shop');
	Route::get('/shop/{category}-{slug}', 'ShopController@show')->name('shop.show');

	// Single Product
	Route::get('/product/{id}-{slug}', 'HomeController@show')->name('product');
	Route::post('/review/{product}', 'HomeController@review')->name('product.review');

	// Blog
	Route::get('/blog', 'BlogController@index')->name('blog.index');
	Route::get('/blog/{blog}-{slug}', 'BlogController@show')->name('blog.show');

	// Cart & checkout
	Route::resource('/cart', 'CartController');
	Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');
	Route::post('/procced', 'CartController@procced')->name('cart.procced');

	// Cards Token
	Route::post('cards', 'CardController@store')->name('cards.create');
	Route::delete('cards', 'CardController@destroy')->name('cards.delete');

	// Profile
	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
	Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
	
	// Wishlist
	Route::get('/wishlist', 'WishlistController@index')->name('wishlist.index');
	Route::post('/wishlist', 'WishlistController@store')->name('wishlist.store');

	// Recommend product 
	Route::post('/recommend', 'RecommendController@store')->name('recommend');

	// Laravel auth
	Auth::routes(['verify' => true]);
});

