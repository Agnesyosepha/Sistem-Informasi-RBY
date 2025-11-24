<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenRevisi extends Model
{
    protected $fillable = [
        'nama',
        'tanggal',
        'reviewer',
        'status'
    ];
}
