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
    protected $fillable = ['nama_beasiswa', 'deskripsi', 'jenis_waktu_beasiswa', 'jenis_beasiswa', 'tipe_beasiswa','kuota', 'sumber', 'tanggal_mulai', 'tanggal_berakhir','link_poster_1'];


    // Relasi satu ke banyak dengan SyaratBeasiswa
    public function syaratBeasiswa()
    {
        return $this->hasMany(SyaratBeasiswa::class);
    }

    // Relasi satu ke banyak dengan BenefitBeasiswa
    public function benefitBeasiswa()
    {
        return $this->hasMany(BenefitBeasiswa::class);
    }

    // Relasi satu ke banyak dengan SyaratDokumen
    public function syaratDokumen()
    {
        return $this->hasMany(SyaratDokumen::class);
    }
    public function jenjangPendidikan()
    {
        return $this->hasMany(jenjangPendidikan::class);
    }
    public function pengajuanBeasiswa()
    {
        return $this->hasMany(PengajuanBeasiswa::class);
    }
}
