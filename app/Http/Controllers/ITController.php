<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ITController extends Controller
{
    public function formPeminjaman()
    {
        return view('IT.formpeminjaman');
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

    return view('it.laporanPenilaian', compact('laporanPenilaian'));
}

    public function aset()
    {
        $asets = [
            ['nama' => 'Server Dell PowerEdge R740', 'kategori' => 'Server', 'lokasi' => 'Ruang Server', 'status' => 'Aktif'],
            ['nama' => 'Laptop Lenovo Intell(R) Celeron(R) N4020', 'kategori' => 'Laptop', 'lokasi' => 'Divisi Keuangan', 'status' => 'Aktif'],
            ['nama' => 'PC Asus ExpertCenter', 'kategori' => 'Komputer', 'lokasi' => 'Divisi HRD', 'status' => 'Aktif'],
            ['nama' => 'Switch Cisco 2960', 'kategori' => 'Jaringan', 'lokasi' => 'Ruang IT', 'status' => 'Aktif'],
            ['nama' => 'Printer Canon LBP6030', 'kategori' => 'Printer', 'lokasi' => 'Divisi Umum', 'status' => 'Rusak'],
        ];

        return view('it.asetIT', compact('asets'));
    }

    public function server()
    {
        $servers = [
            ['nama' => 'Server 1', 'lokasi' => 'Jakarta', 'status' => 'Aktif', 'ip' => '192.168.0.10'],
            ['nama' => 'Server 2', 'lokasi' => 'Bandung', 'status' => 'Maintenance', 'ip' => '192.168.0.11'],
            ['nama' => 'Server 3', 'lokasi' => 'Medan', 'status' => 'Aktif', 'ip' => '192.168.0.12'],
            ['nama' => 'Server 4', 'lokasi' => 'Surabaya', 'status' => 'Aktif', 'ip' => '192.168.0.13'],
            ['nama' => 'Server 5', 'lokasi' => 'Balige', 'status' => 'Nonaktif', 'ip' => '192.168.0.14'],
        ];

        return view('it.server', compact('servers'));
    }

    public function totalKomputer()
    {
        $komputers = [
            ['nama' => 'PC-01', 'pengguna' => 'Elise', 'lokasi' => 'Kantor Utama', 'status' => 'Aktif'],
            ['nama' => 'PC-02', 'pengguna' => 'Kenji', 'lokasi' => 'Finance', 'status' => 'Aktif'],
            ['nama' => 'PC-03', 'pengguna' => 'Rika', 'lokasi' => 'HRD', 'status' => 'Perbaikan'],
            ['nama' => 'PC-04', 'pengguna' => 'Tomi', 'lokasi' => 'IT Support', 'status' => 'Aktif'],
            ['nama' => 'PC-05', 'pengguna' => 'Nana', 'lokasi' => 'Marketing', 'status' => 'Aktif'],
        ];

        return view('it.totalKomputer', compact('komputers'));
    }

    public function totalLaptop()
    {
        $laptops = [
            ['nama' => 'PC-01', 'pengguna' => 'Elise', 'lokasi' => 'Kantor Utama', 'status' => 'Aktif'],
            ['nama' => 'PC-02', 'pengguna' => 'Kenji', 'lokasi' => 'Finance', 'status' => 'Aktif'],
            ['nama' => 'PC-03', 'pengguna' => 'Rika', 'lokasi' => 'HRD', 'status' => 'Perbaikan'],
            ['nama' => 'PC-04', 'pengguna' => 'Tomi', 'lokasi' => 'IT Support', 'status' => 'Aktif'],
            ['nama' => 'PC-05', 'pengguna' => 'Nana', 'lokasi' => 'Marketing', 'status' => 'Aktif'],
        ];

        return view('it.totalLaptop', compact('laptops'));
    }
}
