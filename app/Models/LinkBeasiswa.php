<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkBeasiswa extends Model
{
    protected $table = 'link_beasiswa';
    protected $fillable = ['beasiswa_id', 'link_beasiswa'];

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
