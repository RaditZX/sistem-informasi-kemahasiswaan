<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewerSeeder extends Seeder
{
    public function run()
    {
        DB::table('reviewer')->insert([
            [
                'user_id' => 3,
                'nip' => 'NIP' . rand(1000000000, 9999999999),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nip' => 'NIP' . rand(1000000000, 9999999999),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'nip' => 'NIP' . rand(1000000000, 9999999999),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}