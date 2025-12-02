<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasHarianFile extends Model
{
    protected $table = 'tugas_harian_files';

    protected $fillable = [
        'tugas_harian_id',
        'tahapan_id',
        'filename',
        'path',
        'is_revision',
    ];

    public function tugasHarian()
    {
        return $this->belongsTo(TugasHarian::class);
    }
}
