<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenRevisi;
use App\Models\DokumenFinal;
use App\Models\LogAktivitas;

class ReviewerController extends Controller
{
    // ===========================
    // DASHBOARD REVIEWER
    // ===========================
    public function index()
    {
        $logs = LogAktivitas::orderBy('tanggal', 'desc')->get();
        return view('layouts.reviewer', compact('logs'));
    }

    // ===========================
    // LOG AKTIVITAS - SUPERADMIN
    // ===========================
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

        return redirect()
            ->route('superadmin.reviewer.SAlog')
            ->with('success', 'Log aktivitas berhasil ditambahkan!');
    }

    // ===========================
    // ANGGOTA REVIEWER
    // ===========================
    public function tim()
    {
        $timReviewer = [
            [
                'nama' => 'Mega Permata Sari Br Ginting',
                'nohp' => '0823-7881-6319',
                'email' => 'MegaPermataSari400@gmail.com',
                'status' => 'Aktif'
            ],
        ];

        return view('reviewer.timReviewer', compact('timReviewer'));
    }

    // ===========================
    // DOKUMEN REVISI (REVIEWER)
    // ===========================
    public function dokumenRevisi(Request $request)
    {
        $search = $request->search;

        $dokumenRevisi = DokumenRevisi::when($search, function ($q) use ($search) {
            $q->where('tanggal', 'like', "%$search%")
                ->orWhere('jenis', 'like', "%$search%")
                ->orWhere('pemberi', 'like', "%$search%")
                ->orWhere('pengguna', 'like', "%$search%")
                ->orWhere('surveyor', 'like', "%$search%")
                ->orWhere('lokasi', 'like', "%$search%")
                ->orWhere('objek', 'like', "%$search%")
                ->orWhere('reviewer', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
        })
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('reviewer.dokumenRevisi', compact('dokumenRevisi'));
    }

    // ============================
    // UBAH STATUS REVISI → SELESAI
    // ============================
    
    public function updateStatusRevisi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'reviewer' => 'nullable|string'
        ]);

        $revisi = DokumenRevisi::findOrFail($id);

        if ($request->status === 'Selesai') {
            DokumenFinal::create([
                'tanggal'  => $revisi->tanggal,
                'jenis'    => $revisi->jenis,
                'pemberi'  => $revisi->pemberi,
                'pengguna' => $revisi->pengguna,
                'surveyor' => $revisi->surveyor,
                'lokasi'   => $revisi->lokasi,
                'objek'    => $revisi->objek,
                'reviewer' => $request->reviewer ?? $revisi->reviewer,
                'status'   => 'Selesai'
            ]);

            $revisi->delete();

            return redirect()->back()->with('success', 'Dokumen berhasil dipindahkan ke Dokumen Final!');
        }

        $revisi->update([
            'reviewer' => $request->reviewer ?? $revisi->reviewer,
            'status'   => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status dokumen berhasil diperbarui!');
    }

    public function SAdokumenRevisi()
    {
        $dokumenRevisi = DokumenRevisi::orderBy('tanggal', 'desc')->get();
        return view('reviewer.SAdokumenRevisi', compact('dokumenRevisi'));
    }

    public function dokumenFinal()
    {
        $dokumenFinal = DokumenFinal::orderBy('tanggal', 'desc')->get();
        return view('reviewer.dokumenFinal', compact('dokumenFinal'));
    }

    public function SAdokumenFinal()
    {
        $dokumenFinal = DokumenFinal::orderBy('tanggal', 'desc')->get();
        return view('reviewer.SAdokumenFinal', compact('dokumenFinal'));
    }
    
}
