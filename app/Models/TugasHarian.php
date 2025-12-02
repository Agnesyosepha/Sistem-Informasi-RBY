<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasHarian extends Model
{
    protected $fillable = [
        'pemberi_tugas',
        'debitur',
        'no_ppjp',
        'tanggal_survei',
        'tim_lapangan',
        'status',
        'tahapan',
        'is_final_report' 
    ];

    public function files()
    {
        return $this->hasMany(TugasHarianFile::class);
    }

    public function isComplete()
    {
        $fileUtama = $this->files()->where('is_revision', 0)->count();

        return $fileUtama >= 12;
    }
}
