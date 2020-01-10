<?php

$middlewares = [
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'auth', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
];

Route::group($middlewares, function(){
	Route::prefix('dashboard')->name('admin.')->group(function(){
		
		Route::get('/', 'HomeController@index')->name('home');

		Route::get('permissions', 'PermissionController@index')->name('permissions.index');

		Route::resource('roles', 'RoleController');

		Route::resource('users', 'UserController');
		
		Route::resource('categories', 'CategoryController');

		Route::resource('stores', 'StoreController');

		Route::resource('products', 'ProductController');

		Route::resource('orders', 'OrderController');

		Route::resource('images', 'ImageController');

		Route::resource('slideshow', 'SlideShowController');

		Route::resource('offers', 'OfferController');

		Route::resource('blogs', 'BlogController');

		Route::resource('brands', 'BrandController');

	});
});