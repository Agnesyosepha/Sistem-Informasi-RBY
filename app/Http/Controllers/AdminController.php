<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index'); // Halaman utama dashboard admin
    }

    public function suratTugas()
    {
        $suratTugas = [
            ['nomor' => 'ST-001', 'tanggal' => '01 Sep 2025', 'penanggung_jawab' => 'Dazai', 'status' => 'Selesai'],
            ['nomor' => 'ST-002', 'tanggal' => '03 Sep 2025', 'penanggung_jawab' => 'Ranpo', 'status' => 'Proses'],
            ['nomor' => 'ST-003', 'tanggal' => '06 Sep 2025', 'penanggung_jawab' => 'Naomi', 'status' => 'Dijadwalkan'],
            ['nomor' => 'ST-004', 'tanggal' => '10 Sep 2025', 'penanggung_jawab' => 'Chuuya', 'status' => 'Selesai'],
        ];

        return view('admin.suratTugas', compact('suratTugas'));
    }
}
