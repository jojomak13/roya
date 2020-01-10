<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_brands'])->only(['create', 'store']);
        $this->middleware(['permission:read_brands'])->only('index');
        $this->middleware(['permission:update_brands'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_brands'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = request()->has('search')? Brand::search(request()) : Brand::latest()->paginate(10); 

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brands = Brand::create($request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required|image',
        ]))->uploadImage();

        session()->flash('success', __('dashboard.brands.create_success'));
        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $products = $brand->products;
        return view('admin.brands.show', compact('brand', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
        ]));
            
        $brand->uploadImage();

        session()->flash('success', __('dashboard.brands.edit_success'));
        return redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        \Storage::delete($brand->image);
        $brand->delete();
        
        session()->flash('success', __('dashboard.brands.delete_success'));
        return redirect()->route('admin.brands.index');
    }
}
