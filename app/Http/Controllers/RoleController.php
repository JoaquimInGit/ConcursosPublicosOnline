<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
//use App\Http\Controllers\Traits\Authorizable;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {

        return $dataTable->render('roles.index');
        //.return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if(Role::create($request->only('name')) ) {
            //flash('Role Added');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::all('name', 'id');
        return view('roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all('name', 'id');
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, ['name' => 'required|unique:roles,name,'.$role->id]);

        if($role->update($request->only('name'))) {
            //flash('Role Added');
        }
        /*// admin role has everything
        if($role->name === 'Admin') {
            $role->syncPermissions(Permission::all());
            return redirect()->route('roles.index');
        }

        $permissions = $request->get('permissions', []);
        $role->syncPermissions($permissions);
        //flash( $role->name . ' permissions has been updated.');*/


        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('roles.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function updatePermissions(Request $request, Role $role)
    {
        // admin role has everything
        /*if($role->name === 'Admin') {
            $role->syncPermissions(Permission::all());
            return redirect()->route('roles.index');
        }*/

        $permissions = $request->get('permissions', []);
        $role->syncPermissions($permissions);
        //flash( $role->name . ' permissions has been updated.');


        return redirect()->route('roles.show', $role);
    }
}
