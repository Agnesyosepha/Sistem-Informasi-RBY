<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAktif extends Model
{
    protected $fillable = [
        'tanggal',
        'jenis',
        'pemberi',
        'pengguna',
        'surveyor',
        'lokasi',
        'objek',
        'status_progres'
    ];
}
