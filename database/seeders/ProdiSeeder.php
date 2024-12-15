<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodi')->insert([
            [
                'id'=>1,
                'nama_prodi' => 'Teknik Informatika',
                'jurusan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>2,
                'nama_prodi' => 'Konstruksi Sipil',
                'jurusan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>3,
                'nama_prodi' => 'Teknik Kimia Produksi Bersih',
                'jurusan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>4,
                'nama_prodi' => 'Analis Kimia',
                'jurusan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
