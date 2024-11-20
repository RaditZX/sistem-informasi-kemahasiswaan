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
                'user_id' => 1,
                'nim' => '123456789',
                'no_hp' => '213123213123',
                'semester' => 5,
                'tgl_lahir' => '2000-05-15',
                'prodi_id' => 1,
                'angkatan' => 2020,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nim' => '987654321',
                'semester' => 3,
                'no_hp' => '2133213123',
                'tgl_lahir' => '2001-07-20',
                'prodi_id' => 2,
                'angkatan' => 2021,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}