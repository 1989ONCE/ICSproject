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
        Permission::create(['name' => 'set-models']);

        $adminRole = Role::create(['name' => 'Admin']);
        $generalRole = Role::create(['name' => 'General']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'set-models',
        ]);
    }

    
}
