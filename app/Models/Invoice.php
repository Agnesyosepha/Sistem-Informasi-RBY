<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'tanggal_pembuat',
        'no_invoice',
        'no_ppjp',
        'nama_klien',
        'pemberi_tugas',
        'pengguna_laporan',
        'status',
        'checked'
    ];
}
