<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratDokumen extends Model
{
    use HasFactory;

    protected $table = 'syarat_dokumen';

    protected $fillable = ['beasiswa_id', 'dokumen'];

    public $incrementing = false; // Karena tidak menggunakan auto-increment ID

    protected $primaryKey = ['beasiswa_id', 'dokumen']; // Menggunakan composite key

    // Relasi ke Beasiswa (many to one)
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
