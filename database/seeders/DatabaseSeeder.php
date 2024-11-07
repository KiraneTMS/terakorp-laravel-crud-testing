<?php

namespace Database\Seeders;

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
        $this->call([
            HospitalsTableSeeder::class,
            PatientsTableSeeder::class,
            UserSeeder::class,
        ]);
    }
}
