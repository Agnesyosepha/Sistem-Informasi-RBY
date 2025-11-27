<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    protected $fillable = [
        'no_ppjp',
        'pemberi_tugas',
        'lokasi',
        'tanggal_survey',
        'pelaksana_inspeksi',
        'total_biaya',
        'status',
    ];
}
