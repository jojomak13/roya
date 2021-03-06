<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Brand;
use App\Color;
use App\Offer;
use App\Store;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_products'])->only(['create', 'store']);
        $this->middleware(['permission:read_products'])->only('index');
        $this->middleware(['permission:update_products'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_products'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = request()->has('search')? Product::search(request()) : 
                Product::with(['category', 'user', 'stores'])->paginate(10); 

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', '!=', '0')->get();
        $users = User::whereRoleIs('supplier')->get();
        $stores = Store::all();
        $offers = Offer::all();
        $colors = Color::all();
        $brands = Brand::all();

        return view('admin.products.create', compact('categories', 'users', 'stores', 'offers', 'brands', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $product = Product::create($this->formValidate());
        
        $product->upload($request->images);

        $product->colors()->sync($request->colors);
        $product->stores()->sync([
            $request->stores => [
                'quantity' => $request->quantity
            ]
        ]);

        session()->flash('success', __('dashboard.products.create_success'));
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($barcode)
    {        
        $product = Product::Where('id', $barcode)->with('stores')->first();

        return response()->json([
            'status' => $product ? true : false,
            'product' => $product 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('parent_id', '!=', '0')->get();
        $users = User::whereRoleIs('supplier')->get();
        $stores = Store::all();
        $offers = Offer::all();
        $colors = Color::all();
        $brands = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'users', 'stores', 'offers', 'brands', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($request->has('images'))
            $product->upload($request->images);
        
        $product->update($this->formValidate($product));

        $product->colors()->sync($request->colors);
        $product->stores()->sync([
            $request->stores => [
                'quantity' => $request->quantity
            ]
        ]);
        
        session()->flash('success', __('dashboard.products.edit_success'));
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        \Storage::deleteDirectory(dirname($product->images->first()->url));
        $product->images()->delete();
        $product->delete();

        session()->flash('success', __('dashboard.products.delete_success'));
        return redirect()->route('admin.products.index');
    }

    protected function formValidate($product = null)
    {
        $roles = [
            'name_en' => 'required',
            'name_ar' => 'required',
            'buy_price' => 'required',
            'sell_price' => 'required',
            'discount' => 'required|int|min:0|max:100',
            'offer_id' => '',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'description_en' => 'required',
            'description_ar' => 'required',
            'weight' => 'required',
            'stores' => 'required|exists:stores,id',
            'quantity' => 'required|int|min:1|max:9999',
            'status' => '',
            'brand_id' => 'required|exists:brands,id',
            'colors' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3500',
        ];
        
        if(!$product) $roles['images'] = 'required';

        return request()->validate($roles);
    }
}
