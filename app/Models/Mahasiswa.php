<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan konvensi Laravel
    protected $table = 'mahasiswa';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['nim','semester','tgl_lahir','jurusan_id','prodi_id','angkatan'];

    public function pengajuanBeasiswa()
    {
        return $this->hasMany(PengajuanBeasiswa::class);
    }

    // Model Mahasiswa
    public function penerimaBeasiswa()
    {
        return $this->hasMany(PenerimaBeasiswa::class, 'nim', 'nim');
    }
}
