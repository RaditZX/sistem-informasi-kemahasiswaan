<?php

namespace Database\Seeders;

use App\Models\JenjangPendidikan;
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
        // Data untuk tabel beasiswa
        $beasiswaData = [
            [
                'nama_beasiswa' => 'Beasiswa LPDP',
                'deskripsi' => 'Beasiswa Lembaga Pengelola Dana Pendidikan (LPDP) ditujukan bagi mahasiswa Indonesia yang ingin melanjutkan pendidikan di jenjang S2 dan S3. Program ini tidak hanya menyediakan pembiayaan penuh untuk biaya pendidikan, tetapi juga biaya hidup, dan asuransi kesehatan. Beasiswa ini bertujuan untuk menciptakan sumber daya manusia yang unggul di Indonesia melalui pendidikan yang berkualitas.',
                'jenis_waktu_beasiswa' => 'upcoming',
                'tipe_beasiswa' => 'kipk',
                'jenis_beasiswa' => 'full',
                'kuota' => 100,
                'sumber' => 'KEMENDIKBUD',
                'tanggal_mulai' => '2024-01-01',
                'tanggal_berakhir' => '2024-04-30',
            ],
            [
                'nama_beasiswa' => 'Beasiswa Fulbright',
                'deskripsi' => 'Program Beasiswa Fulbright merupakan inisiatif dari pemerintah Amerika Serikat untuk memberikan kesempatan kepada mahasiswa internasional, termasuk dari Indonesia, untuk belajar di universitas terkemuka di AS. Beasiswa ini mencakup biaya kuliah, biaya hidup, tiket pesawat, dan biaya asuransi kesehatan. Beasiswa Fulbright mendukung penelitian dan pengembangan kapasitas di bidang akademis dan profesional.',
                'jenis_waktu_beasiswa' => 'current',
                'tipe_beasiswa' => 'eksternal',
                'jenis_beasiswa' => 'full',
                'kuota' => 30,
                'sumber' => 'USAID',
                'tanggal_mulai' => '2024-02-01',
                'tanggal_berakhir' => '2024-05-31',
            ],
        ];

        // Simpan data beasiswa dan ambil id yang disimpan
        foreach ($beasiswaData as $beasiswa) {
            $beasiswaEntry = Beasiswa::create($beasiswa);

            $jenjang_pendidikan = [
                ['beasiswa_id' => $beasiswaEntry->id, 'jenjang' => 'D3']
            ];
            
            foreach ($jenjang_pendidikan as $jenjang) {
                JenjangPendidikan::create($jenjang);
            }

            // Data untuk tabel syarat_beasiswa
            SyaratBeasiswa::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'syarat' => 'Memiliki ijazah S1 yang diakui.',

            ]);
            SyaratBeasiswa::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'syarat' => 'Mendaftar dalam waktu yang ditentukan.',
            ]);

            // Data untuk tabel benefit_beasiswa
            BenefitBeasiswa::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'benefit' => 'Biaya pendidikan penuh.',
                'deskripsi_benefit' => 'Menanggung seluruh biaya kuliah selama masa studi hingga selesai.',
            ]);
            BenefitBeasiswa::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'benefit' => 'Biaya hidup selama masa studi.',
                'deskripsi_benefit' => 'Menanggung biaya akomodasi, makanan, dan kebutuhan hidup sehari-hari.',
            ]);

            // Data untuk tabel syarat_dokumen
            SyaratDokumen::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'dokumen' => 'Fotokopi ijazah terakhir.',
                'deskripsi_dokumen' => 'Ijazah yang dilegalisir oleh lembaga pendidikan terkait.',
            ]);
            SyaratDokumen::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'dokumen' => 'Surat rekomendasi.',
                'deskripsi_dokumen' => 'Surat rekomendasi dari dosen atau atasan sebagai pendukung aplikasi beasiswa.',
            ]);

        }
    }
}
