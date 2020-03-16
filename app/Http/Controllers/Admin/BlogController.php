<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:create_blogs'])->only(['create', 'store']);
        $this->middleware(['permission:read_blogs'])->only('index');
        $this->middleware(['permission:update_blogs'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_blogs'])->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = request()->has('search')? Blog::search(request()) : Blog::latest()->paginate(10); 

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::latest()->wherePermissionIs('create_blogs')->get();
        return view('admin.blogs.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blogs = Blog::create($request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'content_en' => 'required',
            'content_ar' => 'required',
            'image' => 'required|image',
            'user_id' => 'required'
        ]))->uploadImage();

        session()->flash('success', __('dashboard.blogs.create_success'));
        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $users = User::latest()->wherePermissionIs('create_blogs')->get();
        return view('admin.blogs.edit', compact('blog', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'user_id' => 'required',
            'content_en' => 'required',
            'content_ar' => 'required',
        ]));
            
        $blog->uploadImage();

        session()->flash('success', __('dashboard.blogs.edit_success'));
        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        \Storage::delete($blog->image);
        $blog->delete();
        
        session()->flash('success', __('dashboard.blogs.delete_success'));
        return redirect()->route('admin.blogs.index');
    }
}
