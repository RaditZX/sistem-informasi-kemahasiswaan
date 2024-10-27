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
                'nama_prodi' => 'Sistem Informasi',
                'jurusan_id' => 1, // Assuming 1 is the ID for 'Teknik Informatika' from the JurusanSeeder
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>2,
                'nama_prodi' => 'Teknik Komputer',
                'jurusan_id' => 1, // Assuming 1 is the ID for 'Teknik Informatika'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>3,
                'nama_prodi' => 'Elektronika',
                'jurusan_id' => 2, // Assuming 2 is the ID for 'Teknik Elektro'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>4,
                'nama_prodi' => 'Mesin Produksi',
                'jurusan_id' => 3, // Assuming 3 is the ID for 'Teknik Mesin'
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
