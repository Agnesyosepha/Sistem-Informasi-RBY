<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    protected $fillable = [
        'no_ppjp',
        'tanggal',
        'pemberi_tugas',
        'nama_penilai',
        'adendum',
        'status',
    ];
}
