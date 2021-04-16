<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
//use App\Http\Controllers\Traits\Authorizable;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionDataTable $dataTable)
    {
        return $dataTable->render('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:permissions']);

        if(Permission::create($request->only('name')) ) {
            //flash('Permission Added');
        }

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('permissions.show', compact( 'permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact( 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, ['name' => 'required|unique:permissions,name,'.$permission->id]);

        if($permission->update($request->only('name'))) {
            //flash('Permission Added');
        }
        /*// admin permission has everything
        if($permission->name === 'Admin') {
            $permission->syncPermissions(Permission::all());
            return redirect()->route('permissions.index');
        }

        $permissions = $request->get('permissions', []);
        $permissions->syncPermissions($permissions);
        //flash( $permission->name . ' permissions has been updated.');*/


        return redirect()->route('permissions.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect(route('permissions.index'));
    }
}
