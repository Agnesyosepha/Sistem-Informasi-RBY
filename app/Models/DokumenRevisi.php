<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenRevisi extends Model
{
    protected $fillable = [
        'tanggal',
        'jenis',
        'pemberi',
        'pengguna',
        'surveyor',
        'lokasi',
        'objek',
        'reviewer',
        'status'
    ];
}

