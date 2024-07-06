<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User Permissions
        $user_list = Permission::create(['name' => 'users.list']);
        $user_view = Permission::create(['name' => 'users.view']);
        $user_create = Permission::create(['name' => 'users.create']);
        $user_update = Permission::create(['name' => 'users.update']);
        $user_delete = Permission::create(['name' => 'users.delete']);
        $user_edit = Permission::create(['name' => 'users.edit']);

        // Tasks Permissions
        $task_list = Permission::create(['name' => 'tasks.list']);
        $task_view = Permission::create(['name' => 'tasks.view']);
        $task_create = Permission::create(['name' => 'tasks.create']);
        $task_update = Permission::create(['name' => 'tasks.update']);
        $task_delete = Permission::create(['name' => 'tasks.delete']);
        $task_edit = Permission::create(['name' => 'tasks.edit']);

        // Project Permissions
        $project_list = Permission::create(['name' => 'projects.list']);
        $project_view = Permission::create(['name' => 'projects.view']);
        $project_create = Permission::create(['name' => 'projects.create']);
        $project_update = Permission::create(['name' => 'projects.update']);
        $project_delete = Permission::create(['name' => 'projects.delete']);
        $project_edit = Permission::create(['name' => 'projects.edit']);

        // Companies Permissions
        $company_list = Permission::create(['name' => 'companies.list']);
        $company_view = Permission::create(['name' => 'companies.view']);
        $company_create = Permission::create(['name' => 'companies.create']);
        $company_update = Permission::create(['name' => 'companies.update']);
        $company_delete = Permission::create(['name' => 'companies.delete']);
        $company_edit = Permission::create(['name' => 'companies.edit']);

        // Departments Permissions
        $department_list = Permission::create(['name' => 'departments.list']);
        $department_view = Permission::create(['name' => 'departments.view']);
        $department_create = Permission::create(['name' => 'departments.create']);
        $department_update = Permission::create(['name' => 'departments.update']);
        $department_delete = Permission::create(['name' => 'departments.delete']);
        $department_edit = Permission::create(['name' => 'departments.edit']);

        // Groups Permissions
        $group_list = Permission::create(['name' => 'groups.list']);
        $group_view = Permission::create(['name' => 'groups.view']);
        $group_create = Permission::create(['name' => 'groups.create']);
        $group_update = Permission::create(['name' => 'groups.update']);
        $group_delete = Permission::create(['name' => 'groups.delete']);
        $group_edit = Permission::create(['name' => 'groups.edit']);



        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete,
            $user_edit,

            $group_list,
            $group_view,
            $group_create,
            $group_update,
            $group_delete,
            $group_edit,

            $department_list,
            $department_view,
            $department_create,
            $department_update,
            $department_delete,
            $department_edit,

            $project_list,
            $project_view,
            $project_create,
            $project_update,
            $project_delete,
            $project_edit,

            $company_list,
            $company_view,
            $company_create,
            $company_update,
            $company_delete,
            $company_edit,

            $task_list,
            $task_view,
            $task_create,
            $task_update,
            $task_delete,
            $task_edit,

        ]);
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete,
            $user_edit,
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);
        $user_role = Role::create([
            'name' => 'user',
        ]);
        $user->assignRole($user_role); // This will Automatically assign User Role to Users
        $user->givePermissionTo([
            $user_list,
        ]);
        $user_role->givePermissionTo([
            $user_list,
        ]);

        // Creating the manager role and assigning permissions
        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo(['users.view', 'users.list']);  // Assign necessary permissions

    }
    public function down()
    {
        // Optionally, you can remove roles and permissions if needed
        // Permission::findByName('edit articles')->delete();
        // Permission::findByName('delete articles')->delete();
        // Role::findByName('writer')->delete();
        // Role::findByName('admin')->delete();
    }
}
