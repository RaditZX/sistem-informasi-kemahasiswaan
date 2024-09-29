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
        // Data untuk tabel beasiswa
        $beasiswaData = [
            [
                'nama_beasiswa' => 'Beasiswa LPDP',
                'deskripsi' => 'Beasiswa Lembaga Pengelola Dana Pendidikan (LPDP) ditujukan bagi mahasiswa Indonesia yang ingin melanjutkan pendidikan di jenjang S2 dan S3. Program ini tidak hanya menyediakan pembiayaan penuh untuk biaya pendidikan, tetapi juga biaya hidup, dan asuransi kesehatan. Beasiswa ini bertujuan untuk menciptakan sumber daya manusia yang unggul di Indonesia melalui pendidikan yang berkualitas.',
                'jenis_waktu_beasiswa' => 'upcoming',
                'tipe_beasiswa' => 'ekonomi',
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
                'tipe_beasiswa' => 'prestasi',
                'jenis_beasiswa' => 'full',
                'kuota' => 30,
                'sumber' => 'USAID',
                'tanggal_mulai' => '2024-02-01',
                'tanggal_berakhir' => '2024-05-31',
            ],
            [
                'nama_beasiswa' => 'Beasiswa Chevening',
                'deskripsi' => 'Beasiswa Chevening adalah program beasiswa pemerintah Inggris yang ditujukan untuk mahasiswa internasional yang ingin menempuh pendidikan pascasarjana di Inggris. Beasiswa ini memberikan dana untuk biaya kuliah, biaya hidup, dan perjalanan. Program ini bertujuan untuk mengembangkan kepemimpinan global dan memperkuat hubungan internasional melalui pendidikan.',
                'jenis_waktu_beasiswa' => 'last',
                'tipe_beasiswa' => 'ekonomi',
                'jenis_beasiswa' => 'full',
                'kuota' => 50,
                'sumber' => 'UK Government',
                'tanggal_mulai' => '2024-03-01',
                'tanggal_berakhir' => '2024-06-15',
            ],
            [
                'nama_beasiswa' => 'Beasiswa Erasmus+',
                'deskripsi' => 'Beasiswa Erasmus+ adalah program Uni Eropa yang mendukung mobilitas pelajar untuk belajar di luar negeri. Program ini menawarkan kesempatan bagi mahasiswa untuk mengikuti program pertukaran dan mendalami budaya negara-negara Eropa. Beasiswa ini mencakup biaya kuliah, biaya hidup, dan dukungan untuk perjalanan. Fokus utamanya adalah pengembangan kompetensi dan keterampilan internasional.',
                'jenis_waktu_beasiswa' => 'upcoming',
                'tipe_beasiswa' => 'prestasi',
                'jenis_beasiswa' => 'setengah',
                'kuota' => 150,
                'sumber' => 'Erasmus+',
                'tanggal_mulai' => '2024-05-01',
                'tanggal_berakhir' => '2024-09-01',
            ],
            [
                'nama_beasiswa' => 'Beasiswa MEXT',
                'deskripsi' => 'Beasiswa MEXT adalah program yang ditawarkan oleh pemerintah Jepang untuk pelajar internasional yang ingin melanjutkan studi di universitas di Jepang. Beasiswa ini mencakup biaya pendidikan, biaya hidup, serta tiket pesawat pulang-pergi. MEXT bertujuan untuk memperkuat pertukaran budaya dan meningkatkan kerjasama internasional dalam bidang pendidikan.',
                'jenis_waktu_beasiswa' => 'current',
                'tipe_beasiswa' => 'ekonomi',
                'jenis_beasiswa' => 'full',
                'kuota' => 80,
                'sumber' => 'Ministry of Education, Japan',
                'tanggal_mulai' => '2024-01-15',
                'tanggal_berakhir' => '2024-04-15',
            ],
            [
                'nama_beasiswa' => 'Beasiswa DAAD',
                'deskripsi' => 'Beasiswa DAAD (Deutscher Akademischer Austauschdienst) menawarkan peluang bagi mahasiswa internasional untuk belajar di Jerman. Beasiswa ini mencakup biaya kuliah, biaya hidup, dan asuransi kesehatan. DAAD mendukung program-program yang bertujuan untuk meningkatkan kerjasama pendidikan internasional serta promosi bahasa dan budaya Jerman.',
                'jenis_waktu_beasiswa' => 'upcoming',
                'tipe_beasiswa' => 'ekonomi',
                'jenis_beasiswa' => 'setengah',
                'kuota' => 60,
                'sumber' => 'DAAD',
                'tanggal_mulai' => '2024-07-01',
                'tanggal_berakhir' => '2024-10-30',
            ],
            [
                'nama_beasiswa' => 'Beasiswa Sampoerna',
                'deskripsi' => 'Beasiswa Sampoerna adalah program yang ditawarkan oleh PT Sampoerna untuk mahasiswa yang berprestasi dan membutuhkan dukungan finansial. Program ini tidak hanya menyediakan pembiayaan pendidikan tetapi juga bimbingan karier dan pelatihan soft skills. Beasiswa ini ditujukan untuk mahasiswa yang berkomitmen untuk berkontribusi pada masyarakat.',
                'jenis_waktu_beasiswa' => 'last',
                'tipe_beasiswa' => 'ekonomi',
                'jenis_beasiswa' => 'full',
                'kuota' => 40,
                'sumber' => 'Sampoerna Foundation',
                'tanggal_mulai' => '2024-03-01',
                'tanggal_berakhir' => '2024-08-01',
            ],
            [
                'nama_beasiswa' => 'Beasiswa Mastercard Foundation',
                'deskripsi' => 'Beasiswa Mastercard Foundation ditujukan bagi mahasiswa yang berasal dari keluarga kurang mampu tetapi memiliki potensi akademis. Program ini memberikan dukungan penuh untuk biaya pendidikan, serta biaya hidup. Selain itu, penerima beasiswa akan mendapatkan akses ke pelatihan kepemimpinan dan pengembangan keterampilan.',
                'jenis_waktu_beasiswa' => 'upcoming',
                'tipe_beasiswa' => 'ekonomi',
                'jenis_beasiswa' => 'full',
                'kuota' => 120,
                'sumber' => 'Mastercard Foundation',
                'tanggal_mulai' => '2024-05-01',
                'tanggal_berakhir' => '2024-10-01',
            ],
            [
                'nama_beasiswa' => 'Beasiswa Australian Awards',
                'deskripsi' => 'Beasiswa Australian Awards memberikan kesempatan bagi mahasiswa internasional untuk belajar di Australia. Beasiswa ini mencakup biaya pendidikan, biaya hidup, dan dukungan untuk perjalanan. Program ini bertujuan untuk membangun hubungan dan kerja sama yang lebih baik antara Australia dan negara-negara lain.',
                'jenis_waktu_beasiswa' => 'current',
                'tipe_beasiswa' => 'ekonomi',
                'jenis_beasiswa' => 'full',
                'kuota' => 70,
                'sumber' => 'Australian Government',
                'tanggal_mulai' => '2024-01-01',
                'tanggal_berakhir' => '2024-06-30',
            ],
            [
                'nama_beasiswa' => 'Beasiswa Konrad Adenauer Stiftung',
                'deskripsi' => 'Beasiswa Konrad Adenauer Stiftung ditujukan bagi mahasiswa yang memiliki prestasi akademis yang baik dan aktif dalam kegiatan sosial. Beasiswa ini memberikan dukungan finansial penuh dan pelatihan dalam kepemimpinan. Program ini bertujuan untuk mendukung generasi muda dalam mencapai tujuan pendidikan mereka dan membangun jaringan profesional.',
                'jenis_waktu_beasiswa' => 'upcoming',
                'tipe_beasiswa' => 'prestasi',
                'jenis_beasiswa' => 'setengah',
                'kuota' => 50,
                'sumber' => 'Konrad Adenauer Stiftung',
                'tanggal_mulai' => '2024-04-01',
                'tanggal_berakhir' => '2024-08-01',
            ],
        ];

        // Simpan data beasiswa dan ambil id yang disimpan
        foreach ($beasiswaData as $beasiswa) {
            $beasiswaEntry = Beasiswa::create($beasiswa);

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
            ]);
            BenefitBeasiswa::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'benefit' => 'Biaya hidup selama masa studi.',
            ]);

            // Data untuk tabel syarat_dokumen
            SyaratDokumen::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'dokumen' => 'Fotokopi ijazah terakhir.',
            ]);
            SyaratDokumen::create([
                'beasiswa_id' => $beasiswaEntry->id,
                'dokumen' => 'Surat rekomendasi.',
            ]);
        }
    }
}
