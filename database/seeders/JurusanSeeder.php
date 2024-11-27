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
                'nama_jurusan' => 'Teknik Komputer dan Informatika',
                'kajur_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>2,
                'nama_jurusan' => 'Teknik Sipil',
                'kajur_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>3,
                'nama_jurusan' => 'Teknik Kimia',
                'kajur_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
