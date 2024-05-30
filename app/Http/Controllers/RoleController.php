<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends ApiController
{

    // Roles index
    public function index(Request $request)
    {
        if ($request->user()->can('read.role', Role::class))
        {
            $roles = Role::get();
            return $this->success_response($roles);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Show specific Role
    public function show(Request $request, $id)
    {
        if ($request->user()->can('read.role'))
        {
            $role = Role::find($id);
            return $this->success_response($role);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Store a new Role
    public function store(Request $request)
    {
        if ($request->user()->can('create.role', Role::class))
        {
            $role = Role::create(['name' => $request->name]);
            return $this->success_response($role);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Update Role
    public function update(Request $request, string $id)
    {
        if ($request->user()->can('update.role', Role::class))
        {
            $role = Role::find($id)->update(['name' => $request->name]);
            return $this->success_response($role);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Destroy Roles
    public function destroy(Request $request, string $id)
    {
        if ($request->user()->can('delete.role', Role::class))
        {
            Role::destroy($id);
            return $this->delete_response();
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Update User Roles
    public function update_user_roles(Request $request, string $id)
    {
        if ($request->user()->can('give.role', Role::class))
        {
            $user = User::find($id);
            $user->syncRoles($request->roles);
            return $this->success_response($user);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Update Role Permissions
    public function update_permissions(Request $request, string $id)
    {
        if ($request->user()->can('give.permission', Role::class))
        {
            $role = Role::find($id);
            $role->permissions()->sync($request->permissions);
            return $this->success_response($role);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Update User Permissions
    public function update_user_permissions(Request $request, string $id)
    {
        if ($request->user()->can('give.permission', Role::class))
        {
            $user = User::find($id);
            $user->syncPermissions([$request->permissions]);
            return $this->success_response($user);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Permissions index
    public function permissions_index(Request $request)
    {
        if ($request->user()->can('read.permission', Role::class))
        {
            $permissions = Permission::get();
            return $this->success_response($permissions);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }
}
