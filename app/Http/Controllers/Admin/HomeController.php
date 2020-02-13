<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_dashboard'])->only('index');
    }

    public function index()
    {
        $profit = Order::selectRaw('
            YEAR(created_at) year,
            MONTH(created_at) month,
            SUM(total_price) total_price'
        )->havingRaw('year = YEAR(CURRENT_TIMESTAMP)')
        ->groupBy('month', 'year')
        ->get();
        
        $users = User::wherePermissionIs('create_orders')->pluck('id');

        $casher_profit = Order::selectRaw('users.first_name, users.last_name, COUNT(*) AS orders, SUM(total_price) as total_price')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->wherein('user_id', $users)
            ->groupBy('user_id')
            ->get(); 

        $uncompletedOrders = Order::Where('status', '!=', 'completed')->get();

        $usersCount = \App\User::count();

        $productsCount = \App\Product::count();

        $totalProfit = Order::selectRaw('SUM(total_price) as profit')
            ->whereRaw('Year(created_at) = YEAR(CURRENT_TIMESTAMP)')
            ->first();

        return view('admin.index', compact(
            'profit',
            'casher_profit',
            'uncompletedOrders',
            'usersCount',
            'productsCount',
            'totalProfit'
        ));
    }
}
