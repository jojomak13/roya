<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_comments'])->only('index');
        $this->middleware(['permission:delete_comments'])->only('destroy');
    }

    public function index()
    {
        $reviews = DB::table('product_user')
            ->join('users', 'users.id', '=', 'product_user.user_id')
            ->join('products', 'products.id', '=', 'product_user.product_id')
            ->select('product_user.*', 'users.first_name', 'users.last_name', 'products.name_ar', 'products.name_en')
            ->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy($id)
    {
        DB::table('product_user')->where('id', $id)->delete();
        
        session()->flash('success', __('dashboard.reviews.delete_success'));
        return redirect()->route('admin.reviews.index');
    }
}
