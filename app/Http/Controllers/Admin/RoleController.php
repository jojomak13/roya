<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_roles'])->only(['create', 'store']);
        $this->middleware(['permission:read_roles'])->only('index');
        $this->middleware(['permission:update_roles'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_roles'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($this->validateForm());

        $role->attachPermissions($request->permissions);

        session()->flash('success', __('dashboard.roles.create_success'));
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($this->validateForm($role));

        $role->syncPermissions($request->permissions);

        session()->flash('success', __('dashboard.roles.edit_success'));
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('success', __('dashboard.roles.delete_success'));
        return redirect()->route('admin.roles.index');
    }

    protected function validateForm($role = null)
    {
        $roles = [
            'name' => 'required|unique:roles',
            'description' => 'required',
            'permissions' => 'required|array'
        ];
        
        $roles['name'] .= ($role)? ',name,' . $role->id : ''; 
        return request()->validate($roles);
    }
}
