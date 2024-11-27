<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeStatus extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan konvensi Laravel
    protected $table = 'kode_status';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['id_status', 'isi_status'];


    // public function Beasiswa()
    // {
    //     return $this->hasMany(Beasiswa::class);
    // }

    // public function Mahasiswa()
    // {
    //     return $this->hasMany(Mahasiswa::class);
    // }

    // public function PengajuanDokumen()
    // {
    //     return $this->hasMany(PengajuanDokumen::class);
    // }
}
