<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanJadwal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'jadwal_id',
        'nama_surveyor',
        'tanggal',
        'lokasi',
        'deskripsi',
        'status'
    ];
    
    // Relasi ke model JadwalSurveyor
    public function jadwalSurveyor()
    {
        return $this->belongsTo(JadwalSurveyor::class, 'jadwal_id');
    }
}