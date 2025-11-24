<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenRevisi;

class ReviewerController extends Controller
{
    public function index()
    {
        return view('reviewer.index');
    }

    // Anggota Reviewer
    public function tim()
    {
        $timReviewer = [
            ['nama' => 'Mega Permata Sari Br Ginting', 
            'nohp' => '082378816319', 
            'email' => 'MegaPermataSari400@gmail.com', 
            'status' => 'Aktif'],
        ];

        return view('reviewer.timReviewer', compact('timReviewer'));
    }


    // Dokumen Revisi
    public function dokumenRevisi()
    {
        $dokumenRevisi = \App\Models\DokumenRevisi::all();
        return view('reviewer.dokumenRevisi', compact('dokumenRevisi'));
    }

    public function SAdokumenRevisi()
{
    $dokumenRevisi = \App\Models\DokumenRevisi::all();
    return view('reviewer.SAdokumenRevisi', compact('dokumenRevisi'));
}

public function storeDokumenRevisi(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'tanggal' => 'required|date',
        'reviewer' => 'required|string',
        'status' => 'required|string'
    ]);

    \App\Models\DokumenRevisi::create($request->all());

    return redirect()->back()->with('success', 'Dokumen revisi berhasil ditambahkan!');
}


    // Dokumen Final
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
