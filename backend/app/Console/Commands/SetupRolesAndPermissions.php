<?php
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SetupRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:roles-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up roles and permissions';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Creating permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);

        // Creating roles and assigning existing permissions
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['edit articles', 'delete articles']);

        $this->info('Roles and permissions have been set up successfully.');
    }
}
