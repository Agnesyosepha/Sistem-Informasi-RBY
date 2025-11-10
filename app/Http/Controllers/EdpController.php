<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdpController extends Controller
{
  public function staff()
  {
      $staff = [
          ['nama' => 'Aprilius Ginting', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Michael Brema Pinem', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Yohanes Kroll Koten', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
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
    // contoh data sementara
    $dataAktif = [
        [
            'tanggal' => '10 Nov 2025',
            'jenis' => 'Lelang',
            'pemberi' => 'PT Mandiri Tbk',
            'pengguna' => 'PT Mandiri Tbk',
            'status' => 'Proses'
        ],
        [
            'tanggal' => '11 Nov 2025',
            'jenis' => 'Laporan Keuangan',
            'pemberi' => 'PT BNI',
            'pengguna' => 'PT BNI',
            'status' => 'Selesai'
        ],
        [
            'tanggal' => '12 Nov 2025',
            'jenis' => 'Penjaminan Utang',
            'pemberi' => 'PT Bank Pan Indonesia Tbk',
            'pengguna' => 'PT Bank Pan Indonesia Tbk',
            'status' => 'Gagal'
        ],
    ];

    return view('EDP.dataAktif', compact('dataAktif'));
}
}