<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'no_ppjp',
        'pemberi_tugas',
        'lokasi',
        'tanggal_survey',
        'pelaksana_inspeksi',
        'pengguna_laporan',
        'total_biaya',
        'status',
    ];
}
