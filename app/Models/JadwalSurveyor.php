<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSurveyor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'surat_tugas_id',
        'no_ppjp',
        'tanggal_survey',
        'lokasi',
        'objek_penilaian',
        'pemberi_tugas',
        'nama_penilai',
        'adendum',
        'status',
    ];
    
    public function suratTugas()
    {
        return $this->belongsTo(SuratTugas::class);
    }
}