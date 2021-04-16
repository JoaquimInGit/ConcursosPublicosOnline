<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");
        }

        // Confirm roles needed
        if ($this->command->confirm('Create Permissions and Roles for user? [y|N]', true)) {
            // Seed the default permissions
            //$permissions = Permission::defaultPermissions(); // edit to have default permissions
            $permissions = ['accessAsUser','manageApp','manageUsers','adminApp','adminFullApp'];

            foreach ($permissions as $perms) {
                Permission::firstOrCreate(['name' => $perms]);
            }

            $this->command->info('Default Permissions added.');
            if ($this->command->confirm('Create default permissions? [y|N]', true)) {
                $roles_array = ['SuperAdmin', 'Admin', 'Manager', 'User']; // edit with default roles
                // add roles
                foreach ($roles_array as $role) {
                    $role = Role::firstOrCreate(['name' => trim($role)]);
                    //edit with the used roles
                    if ($role->name == 'SuperAdmin') {
                        // assign all permissions
                        $role->syncPermissions(Permission::whereIn('name', ['manageApp','manageUsers','adminApp','adminFullApp'])->get());
                        $this->command->info('SuperAdmin granted all the permissions');
                    } elseif($role->name == 'Admin'){
                        // assign all permissions
                        $role->syncPermissions(Permission::whereIn('name', ['manageApp','manageUsers','adminApp'])->get());
                        $this->command->info('Admin granted almost all permissions');
                    } elseif($role->name == 'Manager'){
                        // assign all permissions
                        $role->syncPermissions(Permission::whereIn('name', ['manageApp'])->get());
                        $this->command->info('Manager granted some permissions');
                    } elseif($role->name == 'User'){
                        // for others by default only read access
                        $role->syncPermissions(Permission::whereIn('name', ['accessAsUser'])->get());
                    }

                    // create one user for each role
                    //$this->createUser($role);
                }
            }else {
                // Ask for roles from input
                $input_roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');

                // Explode roles
                $roles_array = explode(',', $input_roles);

                // add roles
                foreach ($roles_array as $role) {
                    $role = Role::firstOrCreate(['name' => trim($role)]);

                    if ($role->name == 'Admin' || $role->name == 'SuperAdmin') {
                        // assign all permissions
                        $role->syncPermissions(Permission::all());
                        $this->command->info('Admin granted all the permissions');
                    } else {
                        // for others by default only read access
                        //$role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get()); //REVER ISTO QUE JÁ NÂO SE USA
                    }

                    // create one user for each role
                    //$this->createUser($role);
                }

                $this->command->info('Roles ' . $input_roles . ' added successfully');
            }

        } else {
            //Role::firstOrCreate(['name' => 'User']);
            //$this->command->info('Added only default user role.');
        }
        if ($this->command->confirm('Do you want to create a superAdmin user account? [y|N]', true)) {
            $this->call(UserSeeder::class);
            $this->command->warn('Password is "12345678"');
            $user = User::first();
            $user->assignRole(Role::first()->name);
        }
        if ($this->command->confirm('Do you want to apply all seeds? [y|N]', true)) {
            $this->call(SettingSeeder::class);
        }
        if ($this->command->confirm('Do you want to create a some random data for other tables? [y|N]', true)) {
            //User::factory()->count(10)->create();
            //put here other factories
            /*try {
                $this->command->info('Init factory of Members');
                factory(\App\Models\Member::class, 5)->create();
            }catch (\Illuminate\Database\QueryException $e ){
                $this->command->info('The creation of members as failed for some, please run manualy the following code in tinker "factory(\App\Models\Member::class, 5)->create();" ');
            }
            try {
                $this->command->info('Init factory of Social Members');
                factory(\App\Models\SocialMember::class, 5)->create();
            }catch (\Illuminate\Database\QueryException $e ){
                $this->command->info('The creation of members as failed for some, please run manualy the following code in tinker "factory(\App\Models\SocialMember::class, 5)->create()" ');
            }*/
        }
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {
        $user = User::factory()->create();
        $user->assignRole($role->name);

        if( $role->name == 'Admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
