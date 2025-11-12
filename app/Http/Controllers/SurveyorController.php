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
            ['nama' => 'Richard Barus', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Robbi Sugara Ginting', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Firdaus Ginting', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Amri Simbolon', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Fajar Hariyadi', 'nohp' => '0821-7894-1175', 'status' => 'Cuti'],
            ['nama' => 'Jasmani Ginting', 'nohp' => '0853-4568-9845', 'status' => 'Aktif'],
            ['nama' => 'Santo Cornelius Ginting', 'nohp' => '0853-4568-9845', 'status' => 'Aktif'],
            ['nama' => 'Pretty Balerina Br Bangun', 'nohp' => '0813-8841-2781', 'status' => 'Aktif'],
            ['nama' => 'Benhur Sumanraja Sembiring', 'nohp' => '0877-9547-0175', 'status' => 'Aktif'],
            ['nama' => 'Elma Agnes Silitonga', 'nohp' => '0822-7844-1947', 'status' => 'Aktif'],
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

    

    public function workingPaper()
    {
        return view('surveyor.workingpaper');
    }

    public function laporanPenilaian()
{
    $laporanPenilaian = [
        [
            'nomor_laporan' => 'LP/001/SP/2025',
            'klien' => 'PT Sinar Properti',
            'jenis_aset' => 'Tanah dan Bangunan',
            'nilai_penilaian' => 1500000000,
            'tgl_laporan' => '01 Nov 2025',
            'status' => 'Final'
        ],
        [
            'nomor_laporan' => 'LP/002/BCA/2025',
            'klien' => 'Bank BCA',
            'jenis_aset' => 'Rumah Tinggal',
            'nilai_penilaian' => 850000000,
            'tgl_laporan' => '02 Nov 2025',
            'status' => 'Disetujui'
        ],
        [
            'nomor_laporan' => 'LP/003/MND/2025',
            'klien' => 'Bank Mandiri',
            'jenis_aset' => 'Ruko 2 Lantai',
            'nilai_penilaian' => 1200000000,
            'tgl_laporan' => '03 Nov 2025',
            'status' => 'Draft'
        ],
        [
            'nomor_laporan' => 'LP/004/DEL/2025',
            'klien' => 'PT Delta Energi',
            'jenis_aset' => 'Pabrik & Mesin',
            'nilai_penilaian' => 3400000000,
            'tgl_laporan' => '04 Nov 2025',
            'status' => 'Final'
        ],
        [
            'nomor_laporan' => 'LP/005/BTN/2025',
            'klien' => 'Bank BTN',
            'jenis_aset' => 'Apartemen',
            'nilai_penilaian' => 2300000000,
            'tgl_laporan' => '05 Nov 2025',
            'status' => 'Disetujui'
        ],
        [
            'nomor_laporan' => 'LP/006/GS/2025',
            'klien' => 'PT Graha Sentosa',
            'jenis_aset' => 'Tanah Kosong',
            'nilai_penilaian' => 670000000,
            'tgl_laporan' => '06 Nov 2025',
            'status' => 'Final'
        ],
    ];

    return view('surveyor.laporanPenilaian', compact('laporanPenilaian'));
}

public function updateProyek()
{
    // Proyek Berjalan
    $proyekBerjalan = [
        ['nama' => 'Penilaian Gedung Perkantoran', 'lokasi' => 'Jakarta', 'surveyor' => 'Firdaus Ginting', 'tanggal' => '15 Okt 2025', 'status' => 'On Progress'],
        ['nama' => 'Survey Rumah Komersial', 'lokasi' => 'Bandung', 'surveyor' => 'Fajar Hariyadi', 'tanggal' => '22 Okt 2025', 'status' => 'On Progress'],
        ['nama' => 'Evaluasi Tanah Kosong', 'lokasi' => 'Medan', 'surveyor' => 'Jasmani Ginting', 'tanggal' => '30 Okt 2025', 'status' => 'Review'],
    ];

    // Proyek Selesai
    $proyekSelesai = [
        ['nama' => 'Survey Tanah Rumah', 'lokasi' => 'Jakarta', 'user' => 'Firdaus Ginting', 'status' => 'Selesai'],
        ['nama' => 'Survey Lahan Kosong', 'lokasi' => 'Bogor', 'user' => 'Fajar Hariyadi', 'status' => 'Selesai'],
        ['nama' => 'Survey Bangunan', 'lokasi' => 'Bekasi', 'user' => 'Jasmani Ginting', 'status' => 'Selesai'],
    ];

    // Tugas Tertunda
    $tugasTertunda = [
        ['nama' => 'Survey Tanah Kosong', 'lokasi' => 'Depok', 'deadline' => '10 Nov 2025', 'status' => 'Pending'],
        ['nama' => 'Survey Rumah', 'lokasi' => 'Cikarang', 'deadline' => '15 Nov 2025', 'status' => 'Pending'],
        ['nama' => 'Survey Jalan Raya', 'lokasi' => 'Tangerang', 'deadline' => '20 Nov 2025', 'status' => 'Pending'],
    ];

    return view('surveyor.updateProyek', compact('proyekBerjalan', 'proyekSelesai', 'tugasTertunda'));
}


}
