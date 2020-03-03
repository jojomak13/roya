<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recommend;

class RecommendController extends Controller
{
    public function store(Request $request)
    {
        Recommend::create($request->validate(['title' => 'required']));

        session()->flash('success', __('user.header.recommend_created'));
        return redirect()->route('home');
    }
}
