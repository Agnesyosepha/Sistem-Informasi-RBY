<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DraftResume extends Model
{
    protected $fillable = [
        'pemberi_tugas',
        'objek_penilaian',
        'nilai_pasar',
        'nilai_wajar',
        'nilai_likuidasi',
        'tanggal',
        'tanggal_pengiriman',
        'status'
    ];
}
