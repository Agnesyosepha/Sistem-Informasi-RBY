<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenRevisi;
use App\Models\DokumenFinal;
use App\Models\LogAktivitas;

class ReviewerController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::orderBy('tanggal', 'desc')->get();
        return view('layouts.reviewer', compact('logs'));
    }
    public function SAlog()
    {
        $logs = LogAktivitas::orderBy('tanggal', 'desc')->get();
        $totalLog = LogAktivitas::count();

        return view('reviewer.SAlogaktivitas', compact('logs', 'totalLog'));
    }
    public function storeSAlog(Request $request)
    {
        $request->validate([
            'no_laporan' => 'required|string',
            'tanggal' => 'required|date',
            'pemberi_tugas' => 'required|string',
            'staff_edp' => 'required|string',
            'objek_penilaian' => 'required|string',
            'status' => 'required|string',
        ]);

        LogAktivitas::create($request->all());

        return redirect()->route('superadmin.reviewer.SAlog')
                     ->with('success', 'Log aktivitas berhasil ditambahkan!');
}

    // Anggota Reviewer
    public function tim()
    {
        $timReviewer = [
            ['nama' => 'Mega Permata Sari Br Ginting', 
            'nohp' => '0823-7881-6319', 
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
        $dokumenFinal = \App\Models\DokumenFinal::all();
        return view('reviewer.dokumenFinal', compact('dokumenFinal'));
    }

    public function SAdokumenFinal()
    {
        $dokumenFinal = \App\Models\DokumenFinal::all();
        return view('reviewer.SAdokumenFinal', compact('dokumenFinal'));
    }

    public function storeDokumenFinal(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'reviewer' => 'required|string',
            'status' => 'required|string'
        ]);

        \App\Models\DokumenFinal::create($request->all());

        return redirect()->back()->with('success', 'Dokumen final berhasil ditambahkan!');
    }

}
