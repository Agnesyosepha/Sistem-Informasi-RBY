<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\DataAktif;
use App\Models\LogEDP;
use App\Models\DokumenRevisi;

class EdpController extends Controller
{
  public function tim()
    {
        $staff = [
            ['nama' => 'Aprilius Ginting', 'nohp' => '0821-2230-2387', 'email' => 'rutsahanayasembiring@gmail.com', 'status' => 'Aktif'],
            ['nama' => 'Michael Brema Pinem', 'nohp' => '0895-3387-33453', 'email' => 'michaelbp3105@gmail.com', 'status' => 'Aktif'],
            ['nama' => 'Yohanes Kroll Koten', 'nohp' => '0896-7574-0893', 'email' => 'yohaneskrollkoten@gmail.com', 'status' => 'Aktif'],
        ];

        return view('EDP.timEdp', compact('staff'));
    }
  
    public function dataMentah()
    {
        // ambil list file yang sudah diupload
        $files = \Storage::files('edp_data');

        return view('EDP.dataMentah', compact('files'));
    }

    public function uploadData(Request $request)
    {
        $request->validate([
            'data_zip' => 'required|mimes:zip|max:20480', // max 20MB
        ]);

        $file = $request->file('data_zip');
        $originalName = $file->getClientOriginalName();

        $file->storeAs('edp_data', $originalName);

        return redirect()->route('edp.dataMentah')->with('success', 'Data berhasil diupload.');
    }
    

    // Data Aktif
    public function dataAktif()
{
    $dataAktif = DataAktif::all();
    return view('EDP.dataAktif', compact('dataAktif'));
}

    public function SAdataAktif()
    {
        $dataAktif = DataAktif::all();
        return view('EDP.SAdataAktif', compact('dataAktif'));
    }

    public function storeDataAktif(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|string',
            'pemberi' => 'required|string',
            'pengguna' => 'required|string',
            'surveyor' => 'required|string',
            'lokasi' => 'required|string',
            'objek' => 'required|string',
            'status_progres' => 'required|string',
        ]);

        DataAktif::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $data = DataAktif::findOrFail($id);

        $data->update([
            'status_progres' => $request->status_progres
        ]);

        if ($request->status_progres === 'Reviewer') {

            DokumenRevisi::create([
                'tanggal'  => $data->tanggal,
                'jenis'    => $data->jenis, 
                'pemberi'  => $data->pemberi,
                'pengguna' => $data->pengguna,
                'surveyor' => $data->surveyor,
                'lokasi'   => $data->lokasi,
                'objek'    => $data->objek,
                'reviewer' => 'Menunggu Reviewer',
                'status'   => 'Dalam Revisi'
            ]);

            $data->delete();
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }



// Dokumen Final
    public function dokumenFinal(Request $request)
    {
        // Ambil file dari storage/app/public/dokumen_final
            $files = Storage::disk('public')->files('dokumen_final');

        // Buat daftar file dengan tanggal upload
            $dokumenFinal = collect($files)->map(function ($file) {
                return [
                    'nama' => $file,
                    'tanggal' => Carbon::createFromTimestamp(Storage::disk('public')->lastModified($file)),
                ];
            });

        // Filter berdasarkan search
            if ($request->filled('search')) {
                $dokumenFinal = $dokumenFinal->filter(function ($item) use ($request) {
                    return stripos(basename($item['nama']), $request->search) !== false;
                });
            }

        // Filter berdasarkan bulan
            if ($request->filled('bulan')) {
                $dokumenFinal = $dokumenFinal->filter(function ($item) use ($request) {
                    return Carbon::parse($item['tanggal'])->month == $request->bulan;
                });
            }

        // Urutkan berdasarkan tanggal terbaru
            $dokumenFinal = $dokumenFinal->sortByDesc('tanggal')->values();

            return view('EDP.dokumenFinal', ['dokumenFinal' => $dokumenFinal]);
    }

    public function uploadDokumenFinal(Request $request)
    {
        $request->validate([
            'data_zip' => 'required|mimes:zip|max:20480', // max 20MB
        ]);

        $file = $request->file('data_zip');
        $originalName = $file->getClientOriginalName();

        // Simpan ke storage/app/public/dokumen_final
        $file->storeAs('dokumen_final', $originalName, 'public');

        return redirect()->route('edp.dokumenFinal')->with('success', 'Dokumen berhasil diupload.');
    }

    public function deleteDokumenFinal($filename)
    {
        $path = 'dokumen_final/' . $filename;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return redirect()->route('edp.dokumenFinal')->with('success', 'Dokumen berhasil dihapus.');
        }

        return redirect()->route('edp.dokumenFinal')->with('error', 'Dokumen tidak ditemukan.');
    }

    // Log Aktivitas
    public function index()
    {
        $logAktivitas = LogEDP::all();
        return view('layouts.edp', compact('logAktivitas'));
    }

    public function SAlogEDP()
    {
        $logAktivitas = LogEDP::all();
        return view('EDP.SAlogEDP', compact('logAktivitas'));
    }

    public function storeLogEDP(Request $request)
    {
        $request->validate([
            'no_laporan' => 'required',
            'tanggal' => 'required|date',
            'pemberi_tugas' => 'required',
            'penilai' => 'required',
            'staff' => 'required',
            'status' => 'required',
        ]);

        LogEDP::create([
            'no_laporan' => $request->no_laporan,
            'tanggal' => $request->tanggal,
            'pemberi_tugas' => $request->pemberi_tugas,
            'penilai' => $request->penilai,
            'staff' => $request->staff,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('superadmin.edp.SAlogEDP')
            ->with('success', 'Data Log Aktivitas berhasil ditambahkan!');
    }

    public function updateLogEDP(Request $request, $id)
{
    $request->validate([
        'status' => 'required'
    ]);

    $log = LogEDP::findOrFail($id);
    $log->status = $request->status;
    $log->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui!');
}




}