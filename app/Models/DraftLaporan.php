<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DraftLaporan extends Model
{
    protected $fillable = [
        'pemberi_tugas',
        'nomor_ppjp',
        'tgl_proposal',
        'tgl_pengiriman',
        'status'
    ];
}
