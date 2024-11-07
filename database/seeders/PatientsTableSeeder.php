<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'name' => 'John Doe',
            'address' => '123 Maple St, Cityville',
            'phone' => '111-222-3333',
            'hospital_id' => 1,
        ]);

        Patient::create([
            'name' => 'Jane Smith',
            'address' => '456 Oak St, Townsville',
            'phone' => '444-555-6666',
            'hospital_id' => 2,
        ]);

        Patient::create([
            'name' => 'Alice Johnson',
            'address' => '789 Pine St, Metropolis',
            'phone' => '777-888-9999',
            'hospital_id' => 3,
        ]);

        Patient::create([
            'name' => 'Bob Williams',
            'address' => '321 Cedar St, Cityville',
            'phone' => '000-111-2222',
            'hospital_id' => 1,
        ]);
    }
}
