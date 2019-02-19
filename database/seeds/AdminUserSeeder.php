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

        // create each user and each role

        // admin role
        $user = User::create([
            'id' => 'admindupak',
            'nama' => 'SysAdmin',
            'email' => 'SysAdmin@kemenag.go.id',
            'password'=> bcrypt('admindupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2',
            'credit'=> 999
        ]);

        $user->assignRole('admin');
        // $user->save();

        //pemohon role
        $user = User::create([
            'id' => 'pemohondupak',
            'nama' => 'Pemohon',
            'email' => 'Pemohon@kemenag.go.id',
            'password'=> bcrypt('pemohondupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('applicant');


        // verificator role
        $user = User::create([
            'id' => 'verificatordupak',
            'nama' => 'Verificator',
            'email' => 'Verificator@kemenag.go.id',
            'password'=> bcrypt('verificatordupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('verificator','applicant');


        // biro umum role
        $user = User::create([
            'id' => 'biroumumdupak',
            'nama' => 'Biro Umum',
            'email' => 'BiroUmum@kemenag.go.id',
            'password'=> bcrypt('biroumumdupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('biro umum','applicant');


        // tu kepegawaian role
        $user = User::create([
            'id' => 'kepegawaiandupak',
            'nama' => 'TU Kepegawaian',
            'email' => 'kepegawaian@kemenag.go.id',
            'password'=> bcrypt('kepegawaiandupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('tu kepegawaian','applicant');


        // asesmen role
        $user = User::create([
            'id' => 'asesmendupak',
            'nama' => 'Asesmen',
            'email' => 'asesmen@kemenag.go.id',
            'password'=> bcrypt('asesmendupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('asesmen','applicant');

        // jft role
        $user = User::create([
            'id' => 'jftdupak',
            'nama' => 'JFT',
            'email' => 'jft@kemenag.go.id',
            'password'=> bcrypt('jftdupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('jft','applicant');

        // konseptor role
        $user = User::create([
            'id' => 'konseptordupak',
            'nama' => 'Konseptor',
            'email' => 'konseptor@kemenag.go.id',
            'password'=> bcrypt('konseptordupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('konseptor','applicant');

        // kesekretariatan role
        $user = User::create([
            'id' => 'kesekretariatandupak',
            'nama' => 'Kesekretariatan',
            'email' => 'kesekretariatan@kemenag.go.id',
            'password'=> bcrypt('kesekretariatandupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('kesekretariatan','applicant');

        // ketua tim role
        $user = User::create([
            'id' => 'ketuatimdupak',
            'nama' => 'Ketua Tim',
            'email' => 'ketuatim@kemenag.go.id',
            'password'=> bcrypt('ketuatimdupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('ketua tim','applicant');


        // tim penilai role
        $user = User::create([
            'id' => 'timpenilaidupak',
            'nama' => 'Tim Penilai',
            'email' => 'timpenilai@kemenag.go.id',
            'password'=> bcrypt('timpenilaidupak'),
            'address'=>'Jakarta Pusat',
            'is_approved'=>'1',
            'credit'=> 999,
            'CardSerialNumber' => 'CardSerialNumber',
            'lastSKUrl'=> null,
            'pkPosition' => '1',
            'birth_place'=>'birth_place',
            'birth_date'=>null,
            'gender'=>'gender',
            'unit'=>'2'
        ]);

        $user->assignRole('tim penilai','applicant');

    }
}
