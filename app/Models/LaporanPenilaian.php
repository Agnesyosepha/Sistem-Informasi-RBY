<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenilaian extends Model
{
    use HasFactory;

    protected $table = 'laporan_penilaian'; // optional, kalau nama tabel sesuai konvensi Laravel bisa dihapus

    protected $fillable = [
        'tanggal',
        'jenis',
        'pemberi',
        'pengguna',
        'surveyor',
        'lokasi',
        'objek',
        'reviewer',
        'status',
        'softcopy'
    ];
}
