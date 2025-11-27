<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas'; // nama tabel
    
    protected $fillable = [
        'no_laporan',
        'tanggal',
        'pemberi_tugas',
        'staff_edp',
        'objek_penilaian',
        'status'
    ];
}
