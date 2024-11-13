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
                'user_id' => 1,
                'nama_depan' => 'John Doe',
                'nama_belakang' => 'ujang',
                'email' => 'john.doe@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'email_verified_at'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nama_depan' => 's',
                'nama_belakang' => 'ujang',
                'email' => 'jane.smith@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'email_verified_at'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nama_depan' => 'Daffa',
                'nama_belakang' => 'Alghifari',
                'email' => 'james.johnson@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'email_verified_at'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nama_depan' => 'John',
                'nama_belakang' => 'sheena',
                'email' => 'alice.williams@polban.ac.id',
                'jenis_kelamin' => 'Pria',
                'foto' => 'example.jpg',
                'email_verified_at'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
