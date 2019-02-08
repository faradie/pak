<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //permission
        Permission::create(['name' => 'submission']);
        Permission::create(['name' => 'accept applicant']);
        Permission::create(['name' => 'reject applicant']);
        Permission::create(['name' => 'sees applicant']);
        Permission::create(['name' => 'record submission']);
        Permission::create(['name' => 'administration check']);
        Permission::create(['name' => 'accept submission']);
        Permission::create(['name' => 'reject submission']);
        Permission::create(['name' => 'create disposition']);
        Permission::create(['name' => 'notif applicant']);
        Permission::create(['name' => 'create supeng']);
        Permission::create(['name' => 'file check']);
        Permission::create(['name' => 'create pak']);
        Permission::create(['name' => 'create team']);
        Permission::create(['name' => 'apply team']);
        Permission::create(['name' => 'apply score']);
        Permission::create(['name' => 'create sk']);
        Permission::create(['name' => 'create pak detail']);


        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        // this can be done as separate statements
        $role = Role::create(['name' => 'applicant']);
        $role->givePermissionTo('submission');

        // or may be done by chaining
        $role = Role::create(['name' => 'verificator'])
            ->givePermissionTo(['accept applicant', 'reject applicant','sees applicant']);
    }
}
