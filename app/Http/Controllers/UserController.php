<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Traits\Authorizable;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //use Authorizable;
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->can('adminFullApp')) {
            $roles = Role::pluck('name', 'id');
        }else{
            $roles = Role::where('name', '!=', 'SuperAdmin')->pluck('name', 'id');
        }
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validateUser($request, null, true);
        $userAttributes = $request->except('roles', 'permissions');
        $userAttributes['password'] = Hash::make($userAttributes['password']);

        if($user = User::create($userAttributes)) {
            event(new Registered($user));

            $this->syncPermissions($request, $user);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $user->addMediaFromRequest('image')->toMediaCollection('avatar');
            }

            return redirect(route('users.show', $user));
        }else{
            return redirect(route('users.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(auth()->user()->can('adminFullApp')) {
            $roles = Role::pluck('name', 'id');
            $permissions = Permission::all('name', 'id');
        }else{
            $roles = Role::where('name', '!=', 'SuperAdmin')->pluck('name', 'id');
            $permissions = Permission::select('name', 'id')->where('name', '!=', 'adminFullApp')->get();
        }
        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedAttributes = $this->validateUser($request, $user);

        if($request->has('password') && !empty($request->get('password'))){
            $userAttributes = $request->except('roles', 'permissions');
            $userAttributes['password'] = Hash::make($userAttributes['password']);
        }else{
            $userAttributes = $request->except('roles', 'permissions', 'password');
        }

        //$user->update($validatedAttributes);      // até posso meter isto tudo inline com o request()->validate
        $user->fill($userAttributes);      // até posso meter isto tudo inline com o request()->validate

        if(auth()->user()->can('manageUsers')) {
            // Handle the user roles
            $this->syncPermissions($request, $user);
        }
        $user->save();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $user->addMediaFromRequest('image')->toMediaCollection('avatar');
        }elseif($request->filled('delete_image') && $request->boolean('delete_image')){ // if the image was replaced above it will automatically delete this so don't run again
            $user->getFirstMedia('avatar')->delete();
        }
        /*else
            $user->de*/
        if(auth()->user()->can('manageApp')){
            return redirect(route('users.show', $user));
        }else{
            return redirect(route('users.edit', $user));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage with a json
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        if($user->delete())
            return ['success' => true];
        else
            return ['success' => false];
    }

    /**
     * @return array
     */
    public function validateUser(Request $request, User $user = null, $requestPassword = false): array
    {
        $validateArray = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $user === null ? 'unique:users' : Rule::unique('users')->ignore($user)], // 'email' => 'required|email|unique:users,email,' . $id,
        ];
        if(auth()->user()->can('manageUsers')){
            $validateArray ['roles']= 'required|min:1';
        }

        if($requestPassword || ($request->has('password') && !empty($request->get('password')))){
            $validateArray ['password']= ['string', 'min:8', 'confirmed'];
        }
        return $request->validate($validateArray);
    }

    /**
     * Return the users in json format
     * @param type $q
     * @return type
     */
    public function getUsers(Request $request) {
        $q = $request->q ?? null;
        $out = ['results' => ['id' => '', 'text' => '']];
        $results = [];
        if (!empty($q)) {
            $users = User::where('name', 'like', "%$q%")->limit(40)->orderBy('name', 'asc')->get();
        }else{
            $users = User::limit(40)->orderBy('name', 'asc')->get();
        }

        foreach($users as $user){
            $results [] =  ['id' => $user->id, 'text' => $user->name." [$user->email]"];
        }
        if(empty($results))
            return $out;
        else{
            $out = ['results' => $results];
            return $out;
        }
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }
}
