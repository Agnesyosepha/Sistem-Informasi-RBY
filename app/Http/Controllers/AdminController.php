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
    public function tugasHarian()
    {
      $tugasHarian = [
        ['role' => 'Admin Utama', 'tugas' => 'Memverifikasi data surveyor', 'status' => 'Selesai', 'tanggal' => '10 Nov 2025'],
        ['role' => 'Surveyor', 'tugas' => 'Melakukan survey lapangan di Bekasi', 'status' => 'Proses', 'tanggal' => '10 Nov 2025'],
        ['role' => 'EDP', 'tugas' => 'Backup database dan update sistem', 'status' => 'Proses', 'tanggal' => '09 Nov 2025'],
        ['role' => 'Keuangan', 'tugas' => 'Menyiapkan laporan pembayaran surveyor', 'status' => 'Belum Mulai', 'tanggal' => '11 Nov 2025'],
        ['role' => 'Manager', 'tugas' => 'Meninjau laporan proyek mingguan', 'status' => 'Selesai', 'tanggal' => '08 Nov 2025'],
      ];

      return view('admin.tugasHarian', compact('tugasHarian'));
    }

}
