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
}