<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosterBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'poster_beasiswa';

    protected $fillable = ['beasiswa_id', 'link_poster'];

    public $incrementing = false; // Karena tidak menggunakan auto-increment ID
    
    protected $primaryKey = ['beasiswa_id', 'link_poster']; // Menggunakan composite key

    // Relasi ke Beasiswa (many to one)
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
