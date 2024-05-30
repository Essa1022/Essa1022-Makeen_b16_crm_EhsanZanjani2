<?php

namespace Database\Seeders;

use App\Models\User;
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
        Permission::create(['name' => 'read.permission']);
        Permission::create(['name' => 'give.permission']);
        // Role Permissions
        Permission::create(['name' => 'create.role']);
        Permission::create(['name' => 'read.role']);
        Permission::create(['name' => 'update.role']);
        Permission::create(['name' => 'delete.role']);
        Permission::create(['name' => 'give.role']);
        // User Permissions
        Permission::create(['name' => 'create.user']);
        Permission::create(['name' => 'read.user']);
        Permission::create(['name' => 'update.user']);
        Permission::create(['name' => 'delete.user']);
        // Product Permissions
        Permission::create(['name' => 'create.product']);
        Permission::create(['name' => 'read.product']);
        Permission::create(['name' => 'update.product']);
        Permission::create(['name' => 'delete.product']);
        //Task Permissions
        Permission::create(['name' => 'create.task']);
        Permission::create(['name' => 'read.task']);
        Permission::create(['name' => 'update.task']);
        Permission::create(['name' => 'delete.task']);
        //Team Permissions
        Permission::create(['name' => 'create.team']);
        Permission::create(['name' => 'read.team']);
        Permission::create(['name' => 'update.team']);
        Permission::create(['name' => 'delete.team']);
        //Ticket Permissions
        Permission::create(['name' => 'create.ticket']);
        Permission::create(['name' => 'read.ticket']);
        Permission::create(['name' => 'update.ticket']);
        Permission::create(['name' => 'delete.ticket']);
        //Order Permissions
        Permission::create(['name' => 'create.order']);
        Permission::create(['name' => 'read.order']);
        Permission::create(['name' => 'update.order']);
        Permission::create(['name' => 'delete.order']);
        //Label Permissions
        Permission::create(['name' => 'create.label']);
        Permission::create(['name' => 'read.label']);
        Permission::create(['name' => 'update.label']);
        Permission::create(['name' => 'delete.label']);
        Permission::create(['name' => 'give.label']);
        //Warranty Permissions
        Permission::create(['name' => 'create.warranty']);
        Permission::create(['name' => 'read.warranty']);
        Permission::create(['name' => 'update.warranty']);
        Permission::create(['name' => 'delete.warranty']);
        //Message Permissions
        Permission::create(['name' => 'create.message']);
        Permission::create(['name' => 'read.message']);
        Permission::create(['name' => 'update.message']);
        Permission::create(['name' => 'delete.message']);
        //Factor Permissions
        Permission::create(['name' => 'create.factor']);
        Permission::create(['name' => 'read.factor']);
        Permission::create(['name' => 'update.factor']);
        Permission::create(['name' => 'delete.factor']);
        //Category Permissions
        Permission::create(['name' => 'create.category']);
        Permission::create(['name' => 'read.category']);
        Permission::create(['name' => 'update.category']);
        Permission::create(['name' => 'delete.category']);
        //Brand Permissions
        Permission::create(['name' => 'create.brand']);
        Permission::create(['name' => 'read.brand']);
        Permission::create(['name' => 'update.brand']);
        Permission::create(['name' => 'delete.brand']);
        //Media Permissions
        Permission::create(['name' => 'create.media']);
        Permission::create(['name' => 'read.media']);
        Permission::create(['name' => 'update.media']);
        Permission::create(['name' => 'delete.media']);

        // Super Admin Role
        $super_admin = Role::where('name', 'super_admin')->exists();
        if (!$super_admin) {
            $super_admin = Role::create(['name' => 'super_admin']);
        }
        // Admin Role
        $admin = Role::where('name', 'admin')->exists();
        if (!$admin) {
            $admin = Role::create(['name' => 'admin']);
        }
        // User Role
        $user = Role::where('name', 'user')->exists();
        if (!$user) {
            $user = Role::create(['name' => 'user']);
        }
        // Reseller Role
        $reseller = Role::where('name', 'reseller')->exists();
        if (!$reseller) {
            $reseller = Role::create(['name' => 'reseller']);
        }

        $super_admin->syncPermissions([
            'create.user',
            'read.user',
            'update.user',
            'delete.user',
            'create.product',
            'read.product',
            'update.product',
            'delete.product',
            'create.task',
            'read.task',
            'update.task',
            'delete.task',
            'create.team',
            'read.team',
            'update.team',
            'delete.team',
            'create.order',
            'read.order',
            'update.order',
            'delete.order',
            'create.warranty',
            'read.warranty',
            'update.warranty',
            'delete.warranty',
            'create.ticket',
            'read.ticket',
            'update.ticket',
            'delete.ticket',
            'create.message',
            'read.message',
            'update.message',
            'delete.message',
            'create.label',
            'read.label',
            'update.label',
            'delete.label',
            'give.label',
            'create.factor',
            'read.factor',
            'update.factor',
            'delete.factor',
            'create.category',
            'read.category',
            'update.category',
            'delete.category',
            'create.brand',
            'read.brand',
            'update.brand',
            'delete.brand',
            'create.role',
            'read.role',
            'update.role',
            'delete.role'
        ]);

        $user->syncPermissions([
            'read.product',
            'read.category',
            'read.brand',
        ]);

        $reseller->syncPermissions([
            'create.category',
            'read.category',
            'update.category',
            'delete.category',
            'create.brand',
            'read.brand',
            'update.brand',
            'delete.brand',
            'create.warranty',
            'read.warranty',
            'update.warranty',
            'delete.warranty',
            'create.product',
            'read.product',
            'update.product',
            'delete.product',
            'create.label',
            'read.label',
            'update.label',
            'delete.label',
            'read.order',
            'read.user'
        ]);

        $super_admin = User::create([
            'username' => 'Ehsan',
            'password' => '1234',
            'phone_number' => '09021111111',
            'email' => 'ehsan@gmail.com'
        ]);

        $super_admin->assignRole('super_admin');
    }
}
