<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyekPending extends Model
{
    protected $table = 'proyek_pending';

    protected $fillable = [
        'noppjp',
        'debitur',
        'lokasi',
        'surveyor',
        'tgl_inspeksi',
        'alasan',
        'progres',
    ];
}
