<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    use HasFactory;

    protected $table = 'jenjang_pendidikan';

    protected $fillable = ['beasiswa_id','jenjang'];

    // Relasi ke Beasiswa (many to one)
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
