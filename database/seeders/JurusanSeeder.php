<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusan')->insert([
            [
                'id'=>1,
                'nama_jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>2,
                'nama_jurusan' => 'Teknik Elektro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>3,
                'nama_jurusan' => 'Teknik Mesin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
