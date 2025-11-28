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
        'tahapan'
    ];
}
