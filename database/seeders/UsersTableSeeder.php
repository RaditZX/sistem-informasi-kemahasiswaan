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
                'name' => 'John Doe',
                'email' => 'john.doe@polban.ac.id',
                'email_verified_at' => now(),
                'jenis_kelamin' => 'Pria',
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>2,
                'name' => 'Jane Smith',
                'email' => 'jane.smith@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'jenis_kelamin' => 'Pria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>3,
                'name' => 'James Johnson',
                'email' => 'james.johnson@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'jenis_kelamin' => 'Pria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=>4,
                'name' => 'Alice Williams',
                'email' => 'alice.williams@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'jenis_kelamin' => 'Pria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
