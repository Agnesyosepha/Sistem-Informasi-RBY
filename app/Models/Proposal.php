<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'judul',
        'pengaju',
        'tanggal_pengajuan',
        'tanggal_disetujui',
        'tanggal_berakhir',
        'status'
    ];
}
