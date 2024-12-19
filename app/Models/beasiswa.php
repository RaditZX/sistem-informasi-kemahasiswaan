<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beasiswa extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan konvensi Laravel
    protected $table = 'beasiswa';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['id','nama_beasiswa', 'deskripsi', 'jenis_beasiswa', 'tipe_beasiswa','kuota', 'sumber', 'tanggal_mulai', 'tanggal_berakhir'];


    // Relasi satu ke banyak dengan SyaratBeasiswa
    public function syaratBeasiswa()
    {
        return $this->belongsToMany(SyaratBeasiswa::class,'beasiswa_syarat_beasiswa');
    }

    // Relasi satu ke banyak dengan BenefitBeasiswa
    public function benefitBeasiswa()
    {
        return $this->belongsToMany(BenefitBeasiswa::class, 'beasiswa_benefit');
    }

    // Relasi satu ke banyak dengan SyaratDokumen
    public function syaratDokumen()
    {
        return $this->belongsToMany(SyaratDokumen::class,'beasiswa_syarat_dokumen');
    }

    public function jenjangPendidikan()
    {
        return $this->hasMany(JenjangPendidikan::class);
    }

    public function pengajuanBeasiswa()
    {
        return $this->hasMany(PengajuanBeasiswa::class);
    }
    public function posterBeasiswa()
    {
        return $this->hasMany(PosterBeasiswa::class);
    }
}