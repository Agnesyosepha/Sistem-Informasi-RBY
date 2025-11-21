<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiSurvei extends Model
{
   protected $table = 'lokasi_survei';
   
    protected $fillable = [
        'surveyor',
        'tanggal',
        'lokasi',
        'nama_objek',
        'status',
    ];
}
