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
                'no_hp' => '213113123',
                'semester' => 5,
                'tgl_lahir' => '2000-05-15',
                'prodi_id' => 1,
                'angkatan' => 2020,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nim' => '911654321',
                'semester' => 3,
                'no_hp' => '2133213123',
                'tgl_lahir' => '2001-07-20',
                'prodi_id' => 2,
                'angkatan' => 2021,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 16,
                'nim' => '231511062',
                'semester' => 3,
                'no_hp' => '08812345678',
                'tgl_lahir' => '2001-07-20',
                'prodi_id' => 24,
                'angkatan' => 2023,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 17,
                'nim' => '987654321',
                'semester' => 3,
                'no_hp' => '213313123',
                'tgl_lahir' => '2001-07-20',
                'prodi_id' => 24,
                'angkatan' => 2023,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 18,
                'nim' => '987124321',
                'semester' => 3,
                'no_hp' => '133213123',
                'tgl_lahir' => '2001-07-20',
                'prodi_id' => 24,
                'angkatan' => 2023,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 19,
                'nim' => '982344321',
                'semester' => 3,
                'no_hp' => '23213123',
                'tgl_lahir' => '2001-07-20',
                'prodi_id' => 24,
                'angkatan' => 2023,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 20,
                'nim' => '987324321',
                'semester' => 3,
                'no_hp' => '213122123',
                'tgl_lahir' => '2001-07-20',
                'prodi_id' => 24,
                'angkatan' => 2023,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}