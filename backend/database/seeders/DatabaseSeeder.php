<?php

namespace Database\Seeders;

use App\Models\companies;
use App\Models\departments;
use App\Models\file_sharing;
use App\Models\Group;
use App\Models\group_members;
use App\Models\Message;
use App\Models\projects;
use App\Models\resources;
use App\Models\task_assignments;
use App\Models\tasks;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        companies::factory(10)->create();
        departments::factory(10)->create();
        file_sharing::factory(10)->create();
        group_members::factory(10)->create();
        Group::factory(10)->create();
        // Message::factory(0)->create();
        projects::factory(10)->create();
        resources::factory(10)->create();
        // task_assignments::factory(10)->create();
        tasks::factory(10)->create();
        // User::factory(10)->create();
        // $this->call(RolesAndPermissionsSeeder::class);
        // Role::firstOrCreate(['name' => 'super-admin']);

        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
