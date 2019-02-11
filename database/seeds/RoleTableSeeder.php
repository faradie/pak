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

        //create each permission
        Permission::create(['name' => 'submission']);
        Permission::create(['name' => 'accept applicant']);
        Permission::create(['name' => 'reject applicant']);
        Permission::create(['name' => 'sees applicant']);
        Permission::create(['name' => 'record submission bu']);
        Permission::create(['name' => 'record submission tu']);
        Permission::create(['name' => 'record submission as']);
        Permission::create(['name' => 'record submission jf']);
        Permission::create(['name' => 'record submission ko']);
        Permission::create(['name' => 'record submission se']);
        Permission::create(['name' => 'administration check']);
        Permission::create(['name' => 'accept submission tu']);
        Permission::create(['name' => 'reject submission tu']);
        Permission::create(['name' => 'accept submission se']);
        Permission::create(['name' => 'reject submission se']);
        Permission::create(['name' => 'create disposition']);
        Permission::create(['name' => 'notif applicant']);
        Permission::create(['name' => 'create supeng ko']);
        Permission::create(['name' => 'create supeng se']);
        Permission::create(['name' => 'file check']);
        Permission::create(['name' => 'create pak']);
        Permission::create(['name' => 'create team']);
        Permission::create(['name' => 'apply team']);
        Permission::create(['name' => 'apply score']);
        Permission::create(['name' => 'create sk']);
        Permission::create(['name' => 'create pak detail']);
        Permission::create(['name' => 'apply individual score']);

        // create admin role
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        // this can be done as separate statements
        //create applicant role
        $role = Role::create(['name' => 'applicant']);
        $role->givePermissionTo('submission');

        // or may be done by chaining
        // create verificator role and chaining permission
        $role = Role::create(['name' => 'verificator'])
            ->givePermissionTo(['accept applicant', 'reject applicant','sees applicant']);

            // this can be done as separate statements
            //create biro umum role
        $role = Role::create(['name' => 'biro umum']);
        $role->givePermissionTo('record submission bu');

        // create kepegawaian role
        $role = Role::create(['name' => 'tu kepegawaian'])
            ->givePermissionTo(['administration check', 'record submission tu','accept submission tu','reject submission tu','create disposition','notif applicant']);

        // this can be done as separate statements
        // create asesmen role
        $role = Role::create(['name' => 'asesmen']);
        $role->givePermissionTo('record submission as');    

        // this can be done as separate statements
        // create jft role
        $role = Role::create(['name' => 'jft']);
        $role->givePermissionTo('record submission jf');   

        // or may be done by chaining
        //konseptor role
        $role = Role::create(['name' => 'konseptor'])
            ->givePermissionTo(['record submission ko', 'create supeng ko','create sk']);
        
        // or may be done by chaining
        // kesekretariatan role
        $role = Role::create(['name' => 'kesekretariatan'])
        ->givePermissionTo(['record submission se', 'file check','accept submission se','reject submission se','create supeng se','create pak']);

        // or may be done by chaining
        // ketua tim role
        $role = Role::create(['name' => 'ketua tim'])
            ->givePermissionTo(['create team', 'apply team']);

            // or may be done by chaining
            // tim penilai role
        $role = Role::create(['name' => 'tim penilai'])
        ->givePermissionTo(['apply individual score', 'apply score','create pak detail']);


    }
}
