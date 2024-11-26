<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'Payment Request']);
        Permission::create(['name' => 'Users Account']);
        Permission::create(['name' => 'Account Management']);
        Permission::create(['name' => 'Game Management']);
        Permission::create(['name' => 'Setting Management']);
        // Create roles and assign existing permissions
        // $admin = Role::create(['name' => 'Admin']);
        // $staff = Role::create(['name' => 'Staff']);
        // $manager = Role::create(['name' => 'Manager']);

        // $admin->givePermissionTo(Permission::all()); // Give all permissions to Admin
        // $manager->givePermissionTo(['edit users', 'view reports']);
        // $staff->givePermissionTo(['view reports']);
    }
}

