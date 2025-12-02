<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSurveyor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'no_ppjp',
        'tanggal_survey',
        'lokasi',
        'objek_penilaian',
        'pemberi_tugas',
        'nama_penilai',
        'adendum',
        'status',
    ];
    
    public function laporanJadwal()
    {
        return $this->hasOne(LaporanJadwal::class, 'jadwal_id');
    }
}
