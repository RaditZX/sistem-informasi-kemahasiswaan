<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $data = DB::table('beasiswa as b')
            ->selectRaw('
        COUNT(DISTINCT b.id) AS total_beasiswa,
        COUNT(DISTINCT CASE WHEN now() < b.tanggal_berakhir THEN b.id END) AS beasiswa_on_going,
        COUNT(CASE WHEN pb.status = \'diproses\' THEN 1 END) AS pengajuan_diproses,
        COUNT(CASE WHEN pb.status = \'ditolak\' THEN 1 END) AS pengajuan_ditolak,
        COUNT(CASE WHEN pb.status = \'diterima\' THEN 1 END) AS pengajuan_diterima,
        COUNT(CASE WHEN pb.status = \'direvisi\' THEN 1 END) AS pengajuan_direvisi,
        COUNT(pb.id) AS total_pengajuan,
        SUM(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = EXTRACT(YEAR FROM CURRENT_DATE) THEN 1 ELSE 0 END) AS pengajuan_tahun_ini,
        SUM(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = EXTRACT(YEAR FROM CURRENT_DATE) - 1 THEN 1 ELSE 0 END) AS pengajuan_tahun_lalu,
        SUM(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = EXTRACT(YEAR FROM CURRENT_DATE) - 2 THEN 1 ELSE 0 END) AS pengajuan_2_tahun_lalu,
        SUM(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = EXTRACT(YEAR FROM CURRENT_DATE) - 3 THEN 1 ELSE 0 END) AS pengajuan_3_tahun_lalu,
        SUM(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = EXTRACT(YEAR FROM CURRENT_DATE) - 4 THEN 1 ELSE 0 END) AS pengajuan_4_tahun_lalu
    ')
            ->leftJoin('pengajuan_beasiswa as pb', 'b.id', '=', 'pb.beasiswa_id')
            ->first();


        $jurusan = $request->input('nama_jurusan')
            ? $request->input('nama_jurusan')
            : DB::table('jurusan')->selectRaw('nama_jurusan')->first()->nama_jurusan;

        $currentYear = now()->year;


        $data1 = DB::table('pengajuan_beasiswa as pb')
            ->selectRaw("
                    COUNT(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = ? THEN 1 END) as jumlah_tahun_sekarang,
                    COUNT(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = ? THEN 1 END) as jumlah_tahun_lalu,
                    COUNT(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = ? THEN 1 END) as jumlah_2_tahun_lalu,
                    COUNT(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = ? THEN 1 END) as jumlah_3_tahun_lalu,
                    COUNT(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = ? THEN 1 END) as jumlah_4_tahun_lalu,
                    COUNT(CASE WHEN EXTRACT(YEAR FROM pb.tanggal_pengajuan) = ? THEN 1 END) as jumlah_5_tahun_lalu
                ", [
                $currentYear,
                $currentYear - 1,
                $currentYear - 2,
                $currentYear - 3,
                $currentYear - 4,
                $currentYear - 5
            ])
            ->leftJoin('mahasiswa as m', 'm.nim', '=', 'pb.nim')
            ->leftJoin('prodi as p', 'p.id', '=', 'm.prodi_id')
            ->leftJoin('jurusan as j', 'j.id', '=', 'p.jurusan_id')
            ->where('j.nama_jurusan', '=', $jurusan)
            ->first();



        $beasiswa = Beasiswa::where('tanggal_berakhir', '>', now())
            ->where('tanggal_mulai', '<', now())
            ->paginate(6);

        $jurusan = DB::table('jurusan')->selectRaw('nama_jurusan')->get();



        return view('pages.Beasiswa.dashboard', compact('data', 'beasiswa', 'data1', 'jurusan'));
    }
}
