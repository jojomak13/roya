<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('user.blog.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('user.blog.show', compact('blog'));
    }
}
