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
		Route::get('customers', 'UserController@customers')->name('customers.index');
		
		Route::resource('categories', 'CategoryController');
		Route::get('categories/{category}/products', 'CategoryController@products')->name('category.products');

		Route::resource('stores', 'StoreController');

		Route::resource('products', 'ProductController');

		Route::resource('orders', 'OrderController');
		Route::get('orders/print/{order}', 'OrderController@print')->name('orders.print');

		Route::resource('images', 'ImageController');

		Route::resource('slideshow', 'SlideShowController');

		Route::resource('offers', 'OfferController');

		Route::resource('blogs', 'BlogController');

		Route::resource('brands', 'BrandController');

		Route::resource('recommends', 'RecommendController');

		Route::get('reviews', 'ReviewController@index')->name('reviews.index');
		Route::delete('reviews/delete/{id}', 'ReviewController@destroy')->name('reviews.destroy');
	});
});