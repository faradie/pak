<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id' => 'admindupak',
            'nama' => 'SysAdmin',
            'email' => 'SysAdmin@kemenag.go.id',
            'password'=> bcrypt('admindupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999
        ]);

        $user->assignRole('admin');
        // $user->save();

        $user = User::create([
            'id' => 'alfindupak',
            'nama' => 'Alfin',
            'email' => 'Alfin@kemenag.go.id',
            'password'=> bcrypt('alfindupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999
        ]);

        $user->assignRole('applicant');

    }
}
