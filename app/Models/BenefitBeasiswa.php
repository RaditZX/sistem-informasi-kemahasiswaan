<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenefitBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'benefit_beasiswa';

    protected $fillable = ['beasiswa_id', 'benefit'];

    // Relasi ke Beasiswa (many to one)
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
