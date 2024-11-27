<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBeasiswa extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan konvensi Laravel
    protected $table = 'pengajuan_beasiswa';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['beasiswa_id','nim','tanggal_pengajuan','status', 'komentar'];


    public function Beasiswa()
    {
        return $this->hasMany(Beasiswa::class);
    }

    public function Mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function PengajuanDokumen()
    {
        return $this->hasMany(PengajuanDokumen::class);
    }
}
