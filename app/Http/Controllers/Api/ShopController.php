<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        $colors = $request->input('colors') ?? [];

        return $this->search();    
    }

    private function search()
    {
        $sortType = $this->sortType();
        $colors = request('colors');
        $brands = request('brands');

        if($colors && $brands)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->whereIn('color', $colors)
                ->whereIn('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else if($colors)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->whereIn('color', $colors)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else if($brands)
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
                ->whereIn('brand_id', $brands)
                ->with(['firstImage', 'category'])
                ->paginate(9);

        else
            return Product::orderBy(...$sortType)
                ->select('id', 'category_id', 'name_en', 'name_ar', 'status', 'sell_price', 'discount')
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