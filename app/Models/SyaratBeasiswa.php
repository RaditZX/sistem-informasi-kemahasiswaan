<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'syarat_beasiswa';

    protected $fillable = ['beasiswa_id', 'syarat'];

    // Relasi ke Beasiswa (many to many)
    public function beasiswa()
    {
        return $this->belongsToMany(Beasiswa::class, 'beasiswa_syarat_beasiswa');
    }
}

