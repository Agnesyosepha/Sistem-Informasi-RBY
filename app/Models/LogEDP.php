<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogEDP extends Model
{
    protected $table = 'log_edps';

    protected $fillable = [
        'no_laporan',
        'tanggal',
        'pemberi_tugas',
        'penilai',
        'staff',
        'status',
    ];
            
}
