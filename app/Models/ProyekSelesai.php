<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyekSelesai extends Model
{
    protected $table = 'proyek_selesai';

    protected $fillable = [
        'noppjp',
        'debitur',
        'lokasi',
        'surveyor',
        'tgl_selesai',
        'progres',
    ];
}
