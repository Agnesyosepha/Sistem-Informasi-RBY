<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tanggal_pembuat',
        'no_invoice',
        'no_ppjp',
        'nama_klien',
        'pemberi_tugas',
        'pengguna_laporan',
        'status',
        'checked',
        'termin',
        'biaya_jasa',
        'bukti_dp',
        'bukti_dp_2',
        'bukti_pelunasan'
    ];
    
    protected $casts = [
        'tanggal_pembuat' => 'date',
        'biaya_jasa' => 'decimal:2',
        'checked' => 'boolean'
    ];
}
