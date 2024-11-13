<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'nim'; // Custom primary key

    // Tentukan nama tabel jika berbeda dengan konvensi Laravel
    protected $table = 'mahasiswa';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['nim','semester','tgl_lahir','no_hp','jurusan_id','prodi_id','angkatan','user_id'];

    public function pengajuanBeasiswa()
    {
        return $this->hasMany(PengajuanBeasiswa::class);
    }
}
