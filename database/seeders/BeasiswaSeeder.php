<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beasiswa;
use App\Models\SyaratBeasiswa;
use App\Models\BenefitBeasiswa;
use App\Models\SyaratDokumen;

class BeasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat 10 beasiswa dengan data palsu
        \App\Models\Beasiswa::factory(10)->create()->each(function($beasiswa) {
            // Setiap beasiswa akan memiliki 3 syarat beasiswa
            for ($i = 0; $i < 3; $i++) {
                SyaratBeasiswa::create([
                    'beasiswa_id' => $beasiswa->id,
                    'syarat' => 'Syarat ' . ($i + 1) . ' untuk ' . $beasiswa->nama_beasiswa
                ]);
            }

            // Setiap beasiswa akan memiliki 2 benefit beasiswa
            for ($i = 0; $i < 2; $i++) {
                BenefitBeasiswa::create([
                    'beasiswa_id' => $beasiswa->id,
                    'benefit' => 'Benefit ' . ($i + 1) . ' untuk ' . $beasiswa->nama_beasiswa
                ]);
            }

            // Setiap beasiswa akan memiliki 2 syarat dokumen
            for ($i = 0; $i < 2; $i++) {
                SyaratDokumen::create([
                    'beasiswa_id' => $beasiswa->id,
                    'dokumen' => 'Dokumen ' . ($i + 1) . ' untuk ' . $beasiswa->nama_beasiswa
                ]);
            }
        });
    }
}
