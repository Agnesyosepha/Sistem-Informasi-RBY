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

    return view('it.laporanPenilaian');
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
