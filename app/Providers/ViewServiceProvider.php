<?php

namespace App\Providers;

use App\Brand;
use App\Product;
use App\Category;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.user._brands', function($view){
            $view->with('brands', Brand::all());
        });

        view()->composer('layouts.user._footer', function($view){
            $products = Product::latest()->select('id', 'name_en', 'name_ar')->take(5)->get();
            $view->with('products', $products);
        });
    }
}
