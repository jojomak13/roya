<?php

namespace App\Http\Controllers\Api;

use App\Color;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{

    public function home()
    {
        $brands = \App\Brand::latest()->get();
        $colors = Color::all(); 

        return response()->json([
            'brands' => $brands,
            'colors' => $colors,
            'products' => $this->search('where')
        ]);
    }

    public function category(Request $request)
    {
        $brands = \App\Brand::latest()->get();
        $colors = Color::all(); 

        return response()->json([
            'brands' => $brands,
            'colors' => $colors,
            'products' => $this->searchWith($request->category_id, 'where')
        ]);
    }

    public function index(Request $request)
    {
        return $this->search();    
    }

    public function show(Request $request, $id)
    {
        return $this->searchWith($id);    
    }

    private function search($where = 'whereIn')
    {
        $sortType = $this->sortType();
        $colors = request('colors');
        $brands = request('brands');

        if($colors && $brands)
            return Product::orderBy(...$sortType)
                ->select('products.id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount', 'color_product.color_id')
                ->join('color_product', 'product_id', 'products.id')
                ->$where('color_product.color_id', $colors)
                ->$where('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(30);

        else if($colors)
            return Product::orderBy(...$sortType)
                ->select('products.id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount', 'color_product.color_id')
                ->join('color_product', 'product_id', 'products.id')
                ->$where('color_product.color_id', $colors)
                ->with(['firstImage', 'category'])
                ->paginate(30);

        else if($brands)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->$where('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(30);

        else
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->with(['firstImage', 'category'])
                ->paginate(30);
    }


    private function searchWith($cat_id, $where = 'whereIn')
    {
        $sortType = $this->sortType();
        $colors = request('colors');
        $brands = request('brands');

        if($colors && $brands)
            return Product::orderBy(...$sortType)
                ->select('products.id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount', 'color_product.color_id')
                ->join('color_product', 'product_id', 'products.id')
                ->$where('color_product.color_id', $colors)
                ->$where('brand_id', $brands)
                ->where('category_id', $cat_id)
                ->with(['firstImage', 'category'])
                ->paginate(30);

        else if($colors)
            return Product::orderBy(...$sortType)
                ->select('products.id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount', 'color_product.color_id')
                ->join('color_product', 'product_id', 'products.id')
                ->$where('color_product.color_id', $colors)
                ->where('category_id', $cat_id)
                ->with(['firstImage', 'category'])
                ->paginate(30);

        else if($brands)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('category_id', $cat_id)
                ->$where('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(30);

        else
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('category_id',  $cat_id)
                ->with(['firstImage', 'category'])
                ->paginate(30);
    }

    private function sortType()
    {
        $sortType = request()->get('sortType');

        if(in_array($sortType, ['asc', 'desc']))
            return $sortType === 'desc' ? ['id', 'desc'] : ['id', 'asc'];  
        
        else if(in_array($sortType, ['high', 'low']))
            return $sortType === 'high' ? ['sell_price', 'desc'] : ['sell_price', 'asc'];  

        return ['id', 'desc'];
    }
}
