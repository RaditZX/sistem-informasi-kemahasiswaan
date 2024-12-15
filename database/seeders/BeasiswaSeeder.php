<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beasiswa;
use App\Models\SyaratBeasiswa;
use App\Models\BenefitBeasiswa;
use App\Models\SyaratDokumen;
use App\Models\JenjangPendidikan;
use Carbon\Carbon;

class BeasiswaSeeder extends Seeder
{
    public function run()
    {
        $currentTime = Carbon::now();

        // Buat data beasiswa
        $beasiswa = Beasiswa::create([
            'id' => 1,
            'nama_beasiswa' => 'Beasiswa LPDP',
            'deskripsi' => 'Beasiswa Lembaga Pengelola Dana Pendidikan (LPDP)...',
            'tipe_beasiswa' => 'eksternal',
            'jenis_beasiswa' => 'full',
            'kuota' => 100,
            'sumber' => 'KEMENDIKBUD',
            'tanggal_mulai' => '2024-01-01',
            'tanggal_berakhir' => '2024-04-30',
        ]);

        // Buat data syarat beasiswa
        $syarat1 = SyaratBeasiswa::create(['syarat' => 'Memiliki ijazah S1 yang diakui.']);
        $syarat2 = SyaratBeasiswa::create(['syarat' => 'Mendaftar dalam waktu yang ditentukan.']);

        // Attach ke pivot table beasiswa_syarat_beasiswa dengan timestamps
        $beasiswa->syaratBeasiswa()->attach([
            $syarat1->id => ['created_at' => $currentTime, 'updated_at' => $currentTime],
            $syarat2->id => ['created_at' => $currentTime, 'updated_at' => $currentTime],
        ]);

        // Buat data benefit beasiswa
        $benefit1 = BenefitBeasiswa::create(['benefit' => 'Biaya pendidikan penuh.']);
        $benefit2 = BenefitBeasiswa::create(['benefit' => 'Biaya hidup selama masa studi.']);

        // Attach ke pivot table beasiswa_benefit dengan timestamps
        $beasiswa->benefitBeasiswa()->attach([
            $benefit1->id => ['created_at' => $currentTime, 'updated_at' => $currentTime],
            $benefit2->id => ['created_at' => $currentTime, 'updated_at' => $currentTime],
        ]);

        // Buat data syarat dokumen
        $dokumen1 = SyaratDokumen::create(['dokumen' => 'Fotokopi ijazah terakhir.']);
        $dokumen2 = SyaratDokumen::create(['dokumen' => 'Surat rekomendasi.']);

        // Attach ke pivot table beasiswa_syarat_dokumen dengan timestamps
        $beasiswa->syaratDokumen()->attach([
            $dokumen1->id => ['created_at' => $currentTime, 'updated_at' => $currentTime],
            $dokumen2->id => ['created_at' => $currentTime, 'updated_at' => $currentTime],
        ]);

        // Buat data jenjang pendidikan
        $jenjang = JenjangPendidikan::create(['jenjang' => 'D4', 'jurusan' => 1]);

        // Attach ke pivot table beasiswa_jenjang_pendidikan dengan timestamps
        $beasiswa->jenjangPendidikan()->attach([
            $jenjang->id => ['created_at' => $currentTime, 'updated_at' => $currentTime],
        ]);
    }
}
