<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_categories'])->only(['create', 'store']);
        $this->middleware(['permission:read_categories'])->only('index');
        $this->middleware(['permission:update_categories'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_categories'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = request()->has('search')? Category::search(request()) : Category::where('parent_id', '0')->paginate(10); 
        
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::parent()->get();
        return view('admin.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create($this->validateForm());

        session()->flash('success', __('dashboard.categories.create_success'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = Category::where('parent_id', $category->id)->paginate(10); 
        
        return view('admin.categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($this->validateForm());

        
        session()->flash('success', __('dashboard.categories.edit_success'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->deleteWithChilds();

        session()->flash('success', __('dashboard.categories.delete_success'));
        return redirect()->route('admin.categories.index');
    }

    protected function validateForm()
    {
        return request()->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'parent_id' => 'integer'
        ]);
    }
}
