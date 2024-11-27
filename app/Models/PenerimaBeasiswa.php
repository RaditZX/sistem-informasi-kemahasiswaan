<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaBeasiswa extends Model
{
     // Tentukan nama tabel jika berbeda dengan konvensi Laravel
     protected $table = 'penerima_beasiswa';

     // Tentukan kolom yang bisa diisi secara massal
     protected $fillable = ['nim','beasiswa_id'];
}
