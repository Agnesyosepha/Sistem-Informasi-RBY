<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adendum extends Model
{
    protected $fillable = [
        'nomor', 
        'proyek', 
        'tanggal', 
        'deskripsi', 
        'status'
    ];
}
