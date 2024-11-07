<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hospital::create([
            'name' => 'General Hospital',
            'address' => '123 Main St, Cityville',
            'email' => 'contact@generalhospital.com',
            'phone' => '123-456-7890',
        ]);

        Hospital::create([
            'name' => 'City Hospital',
            'address' => '456 Broad St, Townsville',
            'email' => 'info@cityhospital.com',
            'phone' => '987-654-3210',
        ]);

        Hospital::create([
            'name' => 'Regional Medical Center',
            'address' => '789 Elm St, Metropolis',
            'email' => 'support@regionalmc.com',
            'phone' => '555-123-4567',
        ]);
    }
}
