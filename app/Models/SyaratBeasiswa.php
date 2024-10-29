<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'syarat_beasiswa';

    protected $fillable = ['beasiswa_id', 'syarat'];

    public $incrementing = false; // Karena tidak menggunakan auto-increment ID
    
    protected $primaryKey = ['beasiswa_id', 'syarat']; // Menggunakan composite key

    // Relasi ke Beasiswa (many to one)
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
