<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Creating permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);

        // Creating roles and assigning existing permissions
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['edit articles', 'delete articles']);

        // Creating the manager role and assigning permissions
        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo(['view articles', 'edit articles']);  // Assign necessary permissions

    }
    public function down()
    {
        // Optionally, you can remove roles and permissions if needed
        Permission::findByName('edit articles')->delete();
        Permission::findByName('delete articles')->delete();
        Role::findByName('writer')->delete();
        Role::findByName('admin')->delete();
    }
}
