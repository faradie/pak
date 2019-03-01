<?php

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
        // create role dan admin ketika menjalankan aplikasi
        
        $this->call(RoleTableSeeder::class);
        $this->call(unitSeeder::class);
        $this->call(positionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(itemSeeder::class);
        $this->call(AdministrationSeeder::class);
    }
}
