<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratDokumen extends Model
{
    use HasFactory;

    protected $table = 'syarat_dokumen';

    protected $fillable = ['dokumen'];

    // Relasi ke Beasiswa (many to one)
    public function beasiswa()
    {
        return $this->belongsToMany(Beasiswa::class, 'beasiswa_syarat_dokumen');
    }
}
