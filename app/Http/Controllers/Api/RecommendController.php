<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recommend;

class RecommendController extends Controller
{
    public function store(Request $request)
    {
        Recommend::create($request->validate(['title' => 'required']));

        return response()->json(['status' => true, 'message' =>  __('user.header.recommend_created')]);
    }
}
