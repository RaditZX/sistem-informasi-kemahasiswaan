<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\PenerimaBeasiswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaddingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();

        // Fetch data
        $newestBeasiswa = $this->getNewestBeasiswa($today);
        $upcomingBeasiswa = $this->getUpcomingBeasiswa($today);
        $newestMahasiswaAccepted = $this->getMahasiswaAccepted();

        return view('pages.Madding.madding', compact('newestBeasiswa', 'upcomingBeasiswa', 'newestMahasiswaAccepted'));
    }

    /**
     * Get newest Beasiswa (ongoing or started).
     */
    private function getNewestBeasiswa($today)
    {
        $beasiswa = Beasiswa::leftJoin('jenjang_pendidikan', 'jenjang_pendidikan.beasiswa_id', '=', 'beasiswa.id')
            ->leftJoin('poster_beasiswa', 'poster_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->select(
                'poster_beasiswa.link_poster',
                'beasiswa.id',
                'beasiswa.nama_beasiswa',
                'beasiswa.deskripsi',
                'beasiswa.tipe_beasiswa',
                'beasiswa.jenis_beasiswa',
                'beasiswa.kuota',
                'beasiswa.sumber',
                'beasiswa.tanggal_mulai',
                'beasiswa.tanggal_berakhir',
                DB::raw("COALESCE(array_agg(jenjang_pendidikan.jenjang) FILTER (WHERE jenjang_pendidikan.jenjang IS NOT NULL), ARRAY['All Jenjang Pendidikan']) AS jenjang_list")
            )
            ->where('beasiswa.tanggal_mulai', '<=', $today)
            ->where('beasiswa.tanggal_berakhir', '>=', $today)
            ->groupBy('beasiswa.id', 'beasiswa.nama_beasiswa', 'beasiswa.tanggal_mulai', 'poster_beasiswa.link_poster')
            ->orderBy('beasiswa.tanggal_mulai', 'desc')
            ->take(7)
            ->get();

        return $this->transformBeasiswa($beasiswa);
    }

    /**
     * Get upcoming Beasiswa.
     */
    private function getUpcomingBeasiswa($today)
    {
        $beasiswa = Beasiswa::leftJoin('jenjang_pendidikan', 'jenjang_pendidikan.beasiswa_id', '=', 'beasiswa.id')
            ->leftJoin('poster_beasiswa', 'poster_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->select(
                'poster_beasiswa.link_poster',
                'beasiswa.id',
                'beasiswa.nama_beasiswa',
                'beasiswa.deskripsi',
                'beasiswa.tipe_beasiswa',
                'beasiswa.jenis_beasiswa',
                'beasiswa.kuota',
                'beasiswa.sumber',
                'beasiswa.tanggal_mulai',
                'beasiswa.tanggal_berakhir',
                DB::raw("COALESCE(array_agg(jenjang_pendidikan.jenjang) FILTER (WHERE jenjang_pendidikan.jenjang IS NOT NULL), ARRAY['All Jenjang Pendidikan']) AS jenjang_list")
            )
            ->where('beasiswa.tanggal_mulai', '>', $today)
            ->groupBy('beasiswa.id', 'beasiswa.nama_beasiswa', 'beasiswa.tanggal_mulai', 'poster_beasiswa.link_poster')
            ->orderBy('beasiswa.tanggal_mulai', 'desc')
            ->take(7)
            ->get();

        return $this->transformBeasiswa($beasiswa);
    }

    /**
     * Get newest Mahasiswa who were accepted for Beasiswa.
     */
    private function getMahasiswaAccepted()
    {
        return PenerimaBeasiswa::join('beasiswa', 'beasiswa.id', '=', 'penerima_beasiswa.beasiswa_id')
            ->join('mahasiswa', 'mahasiswa.nim', '=', 'penerima_beasiswa.nim')
            ->join('users', 'mahasiswa.user_id', '=', 'users.id')
            ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id')
            ->join('jurusan', 'prodi.jurusan_id', '=', 'jurusan.id')
            ->select(
                'users.foto',
                'users.nama_depan',
                'users.nama_belakang',
                'mahasiswa.angkatan',
                'beasiswa.nama_beasiswa',
                'beasiswa.tanggal_mulai',
                'beasiswa.tanggal_berakhir',
                'prodi.*',
                'penerima_beasiswa.*'
            )
            ->whereMonth('penerima_beasiswa.created_at', now()->month)
            ->whereYear('penerima_beasiswa.created_at', now()->year)
            ->orderByRaw('RANDOM()')
            ->take(12)
            ->paginate(4);
    }

    /**
     * Transform Beasiswa: Add short_description and process jenjang_list.
     */
    private function transformBeasiswa($beasiswaCollection)
    {
        return $beasiswaCollection->transform(function ($item) {
            $item->short_description = Str::limit($item->deskripsi, 100, '...');
            $item->jenjang_list = $this->processJenjangList($item->jenjang_list);
            return $item;
        });
    }

    /**
     * Process jenjang_list into an array.
     */
    private function processJenjangList($jenjangList)
    {
        $jenjangArray = explode(',', trim($jenjangList, '{}'));
        return array_map(fn($jenjang) => trim($jenjang, '"'), $jenjangArray);
    }
}