<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $permisisons = [
            ['name' => 'create_users'],
            ['name' => 'update_users'],
            ['name' => 'delete_users'],
            ['name' => 'index_users']
        ];
        $user_permissions = Permission::create($permisisons);
        $admin->givePermissionTo($user_permissions);
    }
}
