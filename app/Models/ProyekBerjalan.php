<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyekBerjalan extends Model
{
    protected $table = 'proyek_berjalan';

    protected $fillable = [
        'noppjp',
        'debitur',
        'lokasi',
        'surveyor',
        'tgl_inspeksi',
        'progres',
    ];
}
