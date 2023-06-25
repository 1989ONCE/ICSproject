<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-warning-group']);
        Permission::create(['name' => 'edit-warning-group']);
        Permission::create(['name' => 'delete-warning-group']);

        $adminRole = Role::create(['name' => 'Admin']);
        $superRole = Role::create(['name' => 'Supervisor']);
        $generalRole = Role::create(['name' => 'General']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-warning-group',
            'edit-warning-group',
            'delete-warning-group',
        ]);

        $superRole->givePermissionTo([
            'edit-users',
            'create-warning-group',
            'edit-warning-group',
        ]);

        $generalRole->givePermissionTo([
            'create-warning-group',
        ]);
    }

    
}
