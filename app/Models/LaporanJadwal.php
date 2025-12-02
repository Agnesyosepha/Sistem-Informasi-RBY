<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanJadwal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'jadwal_id',
        'no_ppjp',
        'tanggal_survey',
        'lokasi',
        'objek_penilaian',
        'pemberi_tugas',
        'nama_penilai',
        'adendum',
        'status',
    ];
}