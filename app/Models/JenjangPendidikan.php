<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    use HasFactory;

    protected $table = 'jenjang_pendidikan';

    protected $fillable = ['jenjang', 'jurusan'];

    // Relasi ke Beasiswa (many to one)
    public function beasiswa()
    {
        return $this->belongsToMany(Beasiswa::class, 'beasiswa_jenjang_pendidikan');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan');
    }
}
