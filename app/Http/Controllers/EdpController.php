<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class EdpController extends Controller
{
  public function staff()
    {
        $staff = [
            ['nama' => 'Aprilius Ginting', 'nohp' => '0821-2230-2387', 'email' => 'rutsahanayasembiring@gmail.com', 'status' => 'Aktif'],
            ['nama' => 'Michael Brema Pinem', 'nohp' => '0895-3387-33453', 'email' => 'michaelbp3105@gmail.com', 'status' => 'Aktif'],
            ['nama' => 'Yohanes Kroll Koten', 'nohp' => '0896-7574-0893', 'email' => 'yohaneskrollkoten@gmail.com', 'status' => 'Aktif'],
        ];

        return view('EDP.edp', compact('staff'));
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
    
    public function dataAktif()
{
    $dataAktif = [
        [
            'tanggal' => '10 Nov 2025',
            'jenis' => 'Lelang',
            'pemberi' => 'PT Mandiri Tbk',
            'pengguna' => 'PT Mandiri Tbk',
            'surveyor' => 'Aprilius Ginting',
            'lokasi' => 'Jakarta Selatan',
            'objek' => 'Gedung Perkantoran',
            'status_progres' => 'Proses'
        ],
        [
            'tanggal' => '11 Nov 2025',
            'jenis' => 'Laporan Keuangan',
            'pemberi' => 'PT BNI',
            'pengguna' => 'PT BNI',
            'surveyor' => 'Michael Brema Pinem',
            'lokasi' => 'Medan',
            'objek' => 'Kantor Cabang',
            'status_progres' => 'Selesai'
        ],
        [
            'tanggal' => '12 Nov 2025',
            'jenis' => 'Penjaminan Utang',
            'pemberi' => 'PT Bank Pan Indonesia Tbk',
            'pengguna' => 'PT Bank Pan Indonesia Tbk',
            'surveyor' => 'Yohanes Kroll Koten',
            'lokasi' => 'Surabaya',
            'objek' => 'Pabrik',
            'status_progres' => 'Reviewer'
        ],
    ];

    return view('EDP.dataAktif', compact('dataAktif'));
}


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



}