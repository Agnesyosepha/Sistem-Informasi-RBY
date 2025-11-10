<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyorController extends Controller
{
    public function index()
    {
        return view('surveyor.index');
    }

    public function tim()
    {
        $tim = [
            ['nama' => 'Dazai', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Ranpo', 'nohp' => '0821-7894-1175', 'status' => 'Cuti'],
            ['nama' => 'Naomi', 'nohp' => '0853-4568-9845', 'status' => 'Aktif'],
            ['nama' => 'Chuuya', 'nohp' => '0813-8841-2781', 'status' => 'Aktif'],
        ];

        return view('surveyor.timsurveyor', compact('tim'));
    }

    public function lokasiSurvei()
    {
        $lokasi = [
            ['nama' => 'Perumahan Del Vista', 'kota' => 'Medan', 'tanggal' => '02 Okt 2025', 'keterangan' => 'Survey Bangunan Rumah'],
            ['nama' => 'Ruko Simanjuntak', 'kota' => 'Balige', 'tanggal' => '10 Okt 2025', 'keterangan' => 'Survey Properti Komersial'],
            ['nama' => 'Taman Hijau Indah', 'kota' => 'Jakarta', 'tanggal' => '20 Okt 2025', 'keterangan' => 'Survey Lahan Kosong'],
        ];

        return view('surveyor.lokasisurvei', compact('lokasi'));
    }

    public function proyekBerjalan()
    {
        $proyek = [
            ['nama' => 'Penilaian Gedung Perkantoran', 'lokasi' => 'Jakarta', 'surveyor' => 'Dazai', 'tanggal_mulai' => '15 Okt 2025', 'progress' => 'On Progress'],
            ['nama' => 'Survey Rumah Komersial', 'lokasi' => 'Bandung', 'surveyor' => 'Ranpo', 'tanggal_mulai' => '22 Okt 2025', 'progress' => 'On Progress'],
            ['nama' => 'Evaluasi Tanah Kosong', 'lokasi' => 'Medan', 'surveyor' => 'Naomi', 'tanggal_mulai' => '30 Okt 2025', 'progress' => 'Done'],
        ];

        return view('surveyor.proyekberjalan', compact('proyek'));
    }

    public function proyekSelesai()
    {
        $proyek = [
            ['nama' => 'Survey Tanah Rumah', 'lokasi' => 'Jakarta', 'user' => 'Dazai'],
            ['nama' => 'Survey Lahan Kosong', 'lokasi' => 'Bogor', 'user' => 'Ranpo'],
            ['nama' => 'Survey Bangunan', 'lokasi' => 'Bekasi', 'user' => 'Naomi'],
            ['nama' => 'Survey Jalan Raya', 'lokasi' => 'Bandung', 'user' => 'Chuuya'],
        ];

        return view('surveyor.proyekselesai', compact('proyek'));
    }
    public function tugasTertunda()
    {
        $tasks = [
            ['nama' => 'Survey Tanah Kosong', 'lokasi' => 'Depok', 'deadline' => '10 Nov 2025'],
            ['nama' => 'Survey Rumah', 'lokasi' => 'Cikarang', 'deadline' => '15 Nov 2025'],
            ['nama' => 'Survey Jalan Raya', 'lokasi' => 'Tangerang', 'deadline' => '20 Nov 2025'],
        ];

        return view('surveyor.tugastertunda', compact('tasks'));
    }

    public function workingPaper()
{
    $workingPapers = [
        ['judul' => 'Analisis Properti Jakarta Selatan', 'tanggal' => '05 Sep 2025', 'status' => 'Selesai'],
        ['judul' => 'Evaluasi Bangunan Bandung Barat', 'tanggal' => '12 Okt 2025', 'status' => 'Proses'],
        ['judul' => 'Studi Lahan Bekasi', 'tanggal' => '20 Okt 2025', 'status' => 'Selesai'],
        ['judul' => 'Laporan Survey Perumahan Depok', 'tanggal' => '01 Nov 2025', 'status' => 'Proses'],
    ];

    return view('surveyor.workingpaper', compact('workingPapers'));
}


}
