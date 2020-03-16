<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{

    public function home()
    {
        $brands = \App\Brand::latest()->get();
        $colors = \DB::table('products')->select('color')->distinct()->get();

        return response()->json([
            'brands' => $brands,
            'colors' => $colors,
            'products' => $this->search()
        ]);
    }

    public function category(Request $request)
    {
        $brands = \App\Brand::latest()->get();
        $colors = \DB::table('products')->select('color')->distinct()->get();

        return response()->json([
            'brands' => $brands,
            'colors' => $colors,
            'products' => $this->searchWith($request->category_id)
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

    private function search()
    {
        $sortType = $this->sortType();
        $colors = request('colors');
        $brands = request('brands');

        if($colors && $brands)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('color', $colors)
                ->where('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else if($colors)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('color', $colors)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else if($brands)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->with(['firstImage', 'category'])
                ->paginate(9);
    }


    private function searchWith($cat_id)
    {
        $sortType = $this->sortType();
        $colors = request('colors');
        $brands = request('brands');

        if($colors && $brands)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('category_id', $cat_id)
                ->where('color', $colors)
                ->where('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else if($colors)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('category_id', $cat_id)
                ->where('color', $colors)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else if($brands)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('category_id', $cat_id)
                ->where('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->where('category_id',  $cat_id)
                ->with(['firstImage', 'category'])
                ->paginate(9);
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
