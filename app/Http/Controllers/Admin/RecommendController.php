<?php

namespace App\Http\Controllers\Admin;

use App\Recommend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecommendController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_recommends'])->only('index');
        $this->middleware(['permission:delete_recommends'])->only('destroy');
    }

    public function index()
    {

        $recommends = request()->has('search')? Recommend::search(request()) : Recommend::latest()->paginate(10); 
        
        return view('admin.recommends.index', compact('recommends'));
    }

    public function destroy(Recommend $recommend)
    {
        $recommend->delete();

        session()->flash('success', __('dashboard.recommends.deleted_success'));
        return redirect()->route('admin.recommends.index');
    }
}
