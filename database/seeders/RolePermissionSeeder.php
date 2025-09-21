<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions
        Permission::create(['name' => 'manage universities']);
        Permission::create(['name' => 'manage departments']);
        Permission::create(['name' => 'manage faculties']);
        Permission::create(['name' => 'view all']);

        // Roles
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $teacher = Role::create(['name' => 'teacher']);
        $teacher->givePermissionTo(['manage departments', 'manage faculties', 'view all']);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['view all']);
    }
}
