<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_users'])->only(['create', 'store']);
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:update_users'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = request()->has('search')? 
            User::search(request())->worker()->paginate(10) : 
            User::worker()->paginate(10); 

        return view('admin.users.index', compact('users'));
    }

    public function customers()
    {
        $users = request()->has('search')? 
            User::search(request())->whereRoleIs('user')->paginate(10) : 
            User::whereRoleIs('user')->paginate(10); 

        return view('admin.users.customers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::common()->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateForm();
        $data['password'] = bCrypt($data['password']);


        $user = User::create($data)
            ->uploadImage()
            ->attachRole($request->group);

        session()->flash('success', __('dashboard.users.create_success'));
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $yearProfit = \App\Order::selectRaw('
            YEAR(created_at) year,
            MONTH(created_at) month,
            SUM(total_price) total_price'
        )->havingRaw('year = YEAR(CURRENT_TIMESTAMP)')
        ->where('user_id', $user->id)
        ->groupBy('month', 'year')
        ->get();

        $monthProfit = \App\Order::selectRaw('
            YEAR(created_at) year,
            MONTH(created_at) month,
            DAY(created_at) day,
            SUM(total_price) total_price'
        )->havingRaw('year = YEAR(CURRENT_TIMESTAMP) AND month = MONTH(CURRENT_TIMESTAMP)')
        ->where('user_id', $user->id)
        ->groupBy('day', 'month', 'year')
        ->get();

        return view('admin.users.show', compact('user', 'yearProfit', 'monthProfit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validateForm($user);

        if(!$data['password']) 
            unset($data['password']);
        else
            $data['password'] = bCrypt($data['password']);

        $user->update($data);

        $user->uploadImage()
            ->syncRoles([$data['group']]);

        session()->flash('success', __('dashboard.users.edit_success'));
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->image);
        $user->delete();

        session()->flash('success', __('dashboard.users.delete_success'));
        return redirect()->route('admin.users.index');
    }

    public function validateForm($user = null)
    {
        $roles = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'confirmed',
            'group' => 'required',
            'address' => 'required',
            // 'image' => 'image',
            'age' => 'required|integer|min:15|max:100',
            'gender' => 'required'
        ];

        if($user){
            $roles['password'] = request('password')? 'required|min:8|'.$roles['password'] : $roles['password'];
            $roles['email'] .= ',email,' . $user->id;
        }
        
        $roles = request()->validate($roles);

        // if(request()->has('image'))
        //     $roles['image'] = User::upload(request(), $user);

        return $roles;
    }
}
