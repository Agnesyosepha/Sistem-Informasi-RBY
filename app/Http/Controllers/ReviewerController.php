<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index()
    {
        return view('reviewer.index');
    }

    public function tim()
    {
        $timReviewer = [
            ['nama' => 'Mega Br Ginting', 'jabatan' => 'Koordinator Reviewer', 'email' => 'mega@edp.com', 'status' => 'Aktif'],
        ];

        return view('reviewer.timReviewer', compact('timReviewer'));
    }

    public function dokumenRevisi()
    {
        $dokumenRevisi = [
            [
                'nama' => 'Laporan Audit Sistem 2025.pdf',
                'tanggal' => '10 November 2025',
                'reviewer' => 'Jonathan Pardede',
                'status' => 'Dalam Revisi'
            ],
            [
                'nama' => 'Dokumen Evaluasi Infrastruktur.docx',
                'tanggal' => '08 November 2025',
                'reviewer' => 'Jonathan Pardede',
                'status' => 'Selesai'
            ],
            [
                'nama' => 'Rencana Pengujian Sistem.xlsx',
                'tanggal' => '07 November 2025',
                'reviewer' => 'Jonathan Pardede',
                'status' => 'Ditolak'
            ],
        ];

        return view('reviewer.dokumenRevisi', compact('dokumenRevisi'));
    }

    public function dokumenFinal()
{
    $dokumenFinal = [
        ['nama' => 'Laporan Bulanan EDP', 'tanggal' => '09 Nov 2025', 'reviewer' => 'EDP-01', 'status' => 'Final'],
        ['nama' => 'Analisis Data Keuangan', 'tanggal' => '07 Nov 2025', 'reviewer' => 'EDP-02', 'status' => 'Final'],
        ['nama' => 'Dokumen Backup Server', 'tanggal' => '05 Nov 2025', 'reviewer' => 'EDP-01', 'status' => 'Final'],
    ];

    return view('reviewer.dokumenFinal', compact('dokumenFinal'));
}

}
