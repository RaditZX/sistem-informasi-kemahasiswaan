<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotifikasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kode_status')->insert([
            ['id_status'=>1, 'isi_status' => 'Diajukan'],
            ['id_status'=>2, 'isi_status' => 'Diproses oleh Staff Kemahasiswaan'],
            ['id_status'=>3, 'isi_status' => 'Direvisi pada Pengecekan Staff Kemahasiswaan'],
            ['id_status'=>4, 'isi_status' => 'Diproses oleh Ketua Jurusan'],
            ['id_status'=>5, 'isi_status' => 'Direvisi pada Ketua Jurusan'],
            ['id_status'=>6, 'isi_status' => 'Diproses oleh Koordinator Layanan Eksternal'],
            ['id_status'=>7, 'isi_status' => 'Direvisi pada Koordinator Layanan Eksternal'],
            ['id_status'=>8, 'isi_status' => 'Diproses oleh Wakil Direktur 3'],
            ['id_status'=>9, 'isi_status' => 'Direvisi pada Wakil Direktur 3'],
            ['id_status'=>10, 'isi_status' => 'Diterima'],
            ['id_status'=>11, 'isi_status' => 'Ditolak'],
        ]);
    }
}
