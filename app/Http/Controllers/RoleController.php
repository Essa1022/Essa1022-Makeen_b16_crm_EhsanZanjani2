<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        return response()->json($role);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id)->update(['name' => $request->name]);
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
    }

    // Update user roles
    public function update_user_roles(Request $request, string $id)
    {
        $user = User::find($id);
        $user->syncRoles($request->roles);
        return response()->json($user);
    }

    // Update role permissions
    public function update_permissions(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->permissions()->sync($request->permissions);
        return response()->json($role);
    }

    // Update user permissions
    public function update_user_permissions(Request $request, string $id)
    {
        $user = User::find($id);
        $user->syncPermissions([$request->permissions]);
        return response()->json($user);
    }

    // Permissions index
    public function permissions_index()
    {
        $permissions = Permission::get();
        return response()->json($permissions);
    }
}
