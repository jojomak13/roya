<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_stores'])->only(['create', 'store']);
        $this->middleware(['permission:read_stores'])->only('index');
        $this->middleware(['permission:update_stores'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_stores'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = request()->has('search')? Store::search(request()) : Store::with('user')->paginate(10); 
        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereRoleIs('supplier')->get();

        return view('admin.stores.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Store::create($this->validateForm());

        session()->flash('success', __('dashboard.stores.create_success'));
        return redirect()->route('admin.stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $users = User::whereRoleIs('supplier')->get();
        return view('admin.stores.edit', compact('store', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $store->update($this->validateForm());

        session()->flash('success', __('dashboard.stores.edit_success'));
        return redirect()->route('admin.stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();

        session()->flash('success', __('dashboard.stores.delete_success'));
        return redirect()->route('admin.stores.index');
    }

    protected function validateForm()
    {
        return request()->validate([
            'name' => 'required',
            'address' => 'required',
            'user_id' => 'required' 
        ]);
    }
}
