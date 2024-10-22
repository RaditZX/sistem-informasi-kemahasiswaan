<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDokumen extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan konvensi Laravel
    protected $table = 'pengajuan_dokumen';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['pengajuan_beasiswa_id','nama_dokumen','link_dokumen'];


    public function pengajuanBeasiswa(){
        return $this->hasOne(pengajuanBeasiswa::class);
    }
}
