<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            [
                'user_id'=>2,
                'nim' => '123456789',
                'semester' => 5,
                'tgl_lahir' => Carbon::create('2000', '05', '15')->toDateString(), // Use Carbon to handle dates
                'prodi_id' => 1, // Assuming this is the ID of an existing prodi
                'angkatan' => 2019,
                'no_hp' => '082131231232',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'=> 1,
                'nim' => '987654321',
                'semester' => 3,
                'tgl_lahir' => Carbon::create('2001', '10', '25')->toDateString(),
                'prodi_id' => 2,
                'no_hp' => '082131231212',
                'angkatan' => 2020,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
