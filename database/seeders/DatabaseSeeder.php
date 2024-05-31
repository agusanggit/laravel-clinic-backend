<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ServiceMedicines;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //otomatis
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //manual
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'bahri@fic15.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
            'phone' => '12345678'
        ]);

        //manual
        \App\Models\ProfileClinic::factory()->create([
            'name' => 'Klinik Winahyusaras',
            'address' => 'Jl. Tarumanegara III No.57, RT.04/RW.06, Banyuanyar, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57137',
            'phone' => '+6282226055090',
            'email' => 'winahyusaras@winahyu.com',
            'doctor_name' => 'Dr Cahyo',
            'uniqe_code' => '123456',
        ]);

        //call
        $this->call([
            DoctorSeeder::class,
            DoctorScheduleSeeder::class,
            PatientSeeder::class,
            ServiceMedicinesSeeder::class,
            PatientScheduleSeeder::class,
        ]);
    }
}
