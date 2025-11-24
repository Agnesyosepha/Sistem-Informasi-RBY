<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenFinal extends Model
{
    protected $fillable = [
        'nama', 
        'tanggal', 
        'reviewer', 
        'status'
    ];
}
