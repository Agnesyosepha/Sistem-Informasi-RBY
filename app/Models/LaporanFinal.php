<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanFinal extends Model
{
    protected $fillable = [
        'pemberi_tugas',
        'jenis_penilaian',
        'pengirim',
        'nomor_laporan',
        'status_pengiriman',
        'softcopy',
        'hardcopy'
    ];
}
