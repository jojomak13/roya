<?php

namespace App\Http\Controllers\Admin;

use App\User;
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
        $products = request()->has('search')? Product::search(request()) : Product::paginate(10); 

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

        return view('admin.products.create', compact('categories', 'users'));
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

        session()->flas('success', __('dashboard.products.create_success'));
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    protected function formValidate($product = null)
    {
        $roles = [
            'name' => 'required',
            'buy_price' => 'required|integer',
            'sell_price' => 'required|integer',
            'user_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'weight' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];

        if(!$product) $roles['images'] = 'required';

        return request()->validate($roles);
    }
}
