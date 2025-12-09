<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
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
    
    public function penilai()
    {
        return $this->belongsTo(User::class, 'nama_penilai', 'nama');
    }

    public function jadwalSurveyor()
    {
        return $this->hasOne(JadwalSurveyor::class);
    }
    
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}