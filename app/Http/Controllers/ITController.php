<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ITController extends Controller
{
    // Halaman form peminjaman
    public function formPeminjaman()
    {
        return view('it.formpeminjaman');
    }

    public function laporanPenilaian()
    {
        return view('it.laporanPenilaian');
    }

    public function aset()
    {
        $asets = [
            ['nama' => 'Server Dell PowerEdge R740', 'kategori' => 'Server', 'lokasi' => 'Ruang Server', 'status' => 'Aktif'],
            ['nama' => 'Laptop Lenovo Intell(R) Celeron(R) N4020', 'kategori' => 'Laptop', 'lokasi' => 'Divisi Finance', 'status' => 'Aktif'],
            ['nama' => 'PC Asus ExpertCenter', 'kategori' => 'Komputer', 'lokasi' => 'Divisi EDP', 'status' => 'Aktif'],
            ['nama' => 'Switch Cisco 2960', 'kategori' => 'Jaringan', 'lokasi' => 'Ruang IT', 'status' => 'Aktif'],
            ['nama' => 'Printer Canon LBP6030', 'kategori' => 'Printer', 'lokasi' => 'Divisi Surveyor', 'status' => 'Rusak'],
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
            ['nama' => 'Laptop-01', 'pengguna' => 'Elise', 'lokasi' => 'Kantor Utama', 'status' => 'Aktif'],
            ['nama' => 'Laptop-02', 'pengguna' => 'Kenji', 'lokasi' => 'Finance', 'status' => 'Aktif'],
            ['nama' => 'Laptop-03', 'pengguna' => 'Rika', 'lokasi' => 'HRD', 'status' => 'Perbaikan'],
            ['nama' => 'Laptop-04', 'pengguna' => 'Tomi', 'lokasi' => 'IT Support', 'status' => 'Aktif'],
            ['nama' => 'Laptop-05', 'pengguna' => 'Nana', 'lokasi' => 'Marketing', 'status' => 'Aktif'],
        ];

        return view('it.totalLaptop', compact('laptops'));
    }

    public function uploadFormPage()
    {
        // Ambil semua file yang sudah diupload dari storage/app/formpeminjaman
        $files = [];
        $dir = storage_path('app/formpeminjaman');
        if(is_dir($dir)){
            foreach(scandir($dir) as $file){
                if($file === '.' || $file === '..') continue;
                $files[] = ['nama' => $file, 'tanggal' => date('Y-m-d H:i:s', filemtime($dir.'/'.$file))];
            }
        }
        return view('it.uploadForm', compact('files'));
    }

    // Aksi Upload Form
    public function uploadFormStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();

        // Simpan di folder storage/app/formpeminjaman
        $file->move(storage_path('app/formpeminjaman'), $filename);

        return back()->with('success', 'File berhasil diunggah!');
    }

    public function tim()
    {
        // Data staff IT (sementara hardcode)
        $staffIT = [
            [
                'nama' => 'Aldi Jhon Travolta',
                'jabatan' => 'IT Sstaff',
                'email' => 'aldi@company.com',
            ],
            [
                'nama' => 'Rachman Nainggolan',
                'jabatan' => 'IT Support',
                'email' => 'rachman@company.com',
            ]
        ];

        return view('it.timIT', compact('staffIT'));
    }

}
