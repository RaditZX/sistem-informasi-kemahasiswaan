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
        DB::table('role')->insert([
            [
                'id' => 1,
                'role_name' => 'Staff Kemahasiswaan',
            ],
            [
                'id' => 2,
                'role_name' => 'Kepala Jurusan'
            ],
            [
                'id' => 3,
                'role_name' => 'Koordinator Layanan Eksternal'
            ],
            [
                'id' => 4,
                'role_name' => 'Wakil Direktur 3'
            ],
        ]);

        DB::table('users')->insert([
            [
                'id'=>1,
                'nama_depan' => 'John',
                'nama_belakang' => 'Doe',
                'email' => 'john.doe@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'email_verified_at'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>2,
                'nama_depan' => 'Jane',
                'nama_belakang' => 'Smith',
                'email' => 'jane.smith@polban.ac.id',
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'email_verified_at'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>3,
                'nama_depan' => 'Staff Kemahasiswaan',
                'nama_belakang' => 'Satu',
                'email' => 'staffkema.satu@polban.ac.id',
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'email_verified_at'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>4,
                'nama_depan' => 'Kepala Jurusan',
                'nama_belakang' => 'Satu',
                'email' => 'kajur.satu@polban.ac.id',
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
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
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
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
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
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
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
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
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'email_verified_at'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('reviewer')->insert([
            [
                'user_id' => 3,
                'nip' => '12345678901234567890',
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nip' => '09876543210987654321',
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'nip' => '09876543210987654322',
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'nip' => '09876543210987654323',
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'nip' => '09876543210987654324',
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'nip' => '09876543210987654325',
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
