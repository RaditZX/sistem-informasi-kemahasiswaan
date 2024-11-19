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
    protected $fillable = ['user_id','nim','semester','tgl_lahir','prodi_id','angkatan'];

    public function pengajuanBeasiswa()
    {
        return $this->hasMany(PengajuanBeasiswa::class, 'beasiswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
