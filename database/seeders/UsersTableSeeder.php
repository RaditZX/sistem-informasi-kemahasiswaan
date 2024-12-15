<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            [
                'id'=>1,
                'nama_depan' => 'John',
                'nama_belakang' => 'Doe',
                'email' => 'john.doe@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>2,
                'nama_depan' => 'Jane',
                'nama_belakang' => 'Smith',
                'email' => 'jane.smith@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>3,
                'nama_depan' => 'Staff Kemahasiswaan',
                'nama_belakang' => 'Satu',
                'email' => 'yani.rahmawati.tif23@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>4,
                'nama_depan' => 'Kepala Jurusan',
                'nama_belakang' => 'Satu',
                'email' => 'kajur.satu@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>5,
                'nama_depan' => 'Kepala Jurusan',
                'nama_belakang' => 'Dua',
                'email' => 'kajur.dua@polban.ac.id',
                'jenis_kelamin' => 'Wanita',
                'foto' => 'example.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>6,
                'nama_depan' => 'Kepala Jurusan',
                'nama_belakang' => 'Tiga',
                'email' => 'kajur.tiga@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>7,
                'nama_depan' => 'Koordinator Layanan Eksternal',
                'nama_belakang' => 'Satu',
                'email' => 'kle.satu@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>8,
                'nama_depan' => 'Wakil Direktur',
                'nama_belakang' => 'Tiga',
                'email' => 'wd.tiga@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
