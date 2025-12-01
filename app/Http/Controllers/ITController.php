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
            ['nama' => 'Motor Beat', 'kategori' => 'Kendaraan', 'lokasi' => 'Di Luar Kantor', 'status' => 'Aktif'],
            ['nama' => 'Mobil Xenia', 'kategori' => 'Kendaraan', 'lokasi' => 'Di Luar Kantor', 'status' => 'Aktif'],
            ['nama' => 'CCTV', 'kategori' => 'Keamanan', 'lokasi' => 'Kantor', 'status' => 'Aktif'],
            ['nama' => 'Printer', 'kategori' => 'Perangkat Kantor', 'lokasi' => 'Kantor', 'status' => 'Aktif'],
            ['nama' => 'Dispenser', 'kategori' => 'Perangkat Kantor', 'lokasi' => 'Kantor', 'status' => 'Aktif'],
        ];

        return view('it.asetIT', compact('asets'));
    }

    public function server()
    {
        $servers = [
            ['nama' => 'Server 1', 'lokasi' => 'Bekasi', 'status' => 'Aktif', 'ip' => '192.168.18.88'],
            ['nama' => 'Hook / Switch', 'lokasi' => 'Bekasi', 'status' => 'Aktif', 'ip' => '192.168.18.10'],
            ['nama' => 'Router MikroTik', 'lokasi' => 'Bekasi', 'status' => 'Aktif', 'ip' => '192.168.18.11'],
            ['nama' => 'Converter USB LAN', 'lokasi' => 'Bekasi', 'status' => 'Aktif', 'ip' => '192.168.18.12'],
        ];

        return view('it.server', compact('servers'));
    }

    public function totalKomputer()
    {
        $komputers = [
            ['nama' => 'WINDOWS-RHT6GIB', 'pengguna' => 'Shafa Az-zahra Eriana', 'lokasi' => 'Divisi Admin Lt 1', 'status' => 'Aktif'],
            ['nama' => 'Lius-X', 'pengguna' => 'Aprilius Ginting', 'lokasi' => 'Divisi EDP Lt 1', 'status' => 'Aktif'],
            ['nama' => 'DEKSTOP-BVN2D0E', 'pengguna' => 'Yohanes Kroll Koten', 'lokasi' => 'Divisi EDP Lt 1', 'status' => 'Aktif'],
            ['nama' => 'DEKSTOP-EMLBD32', 'pengguna' => 'Michael Brema Pinem', 'lokasi' => 'Divisi EDP Lt 1', 'status' => 'Aktif'],
        ];

        return view('it.totalKomputer', compact('komputers'));
    }

    public function totalLaptop()
    {
        $laptops = [
            ['nama' => 'Administrasi-Mieke', 'pengguna' => 'Mieke Dearni Br Tarigan	', 'lokasi' => 'Divisi Admin Lt 1', 'status' => 'Aktif'],
            ['nama' => 'Laptop-3SR1NBHO', 'pengguna' => 'Matta Ega', 'lokasi' => 'Divisi Finance Lt 2', 'status' => 'Aktif'],
            ['nama' => 'Laptop-PMQLBLTH', 'pengguna' => 'Pretty Balerina Br Bangun', 'lokasi' => 'Divisi Surveyor Lt 2', 'status' => 'Aktif'],
            ['nama' => 'Laptop-PMQLBLTH', 'pengguna' => 'Mega Permata Sari Br Ginting', 'lokasi' => 'Divisi Reviewer Lt 2', 'status' => 'Aktif'],
            ['nama' => 'Laptop-PMQLBLTH', 'pengguna' => 'Amri Simbolon', 'lokasi' => 'Divisi Surveyor Lt 2', 'status' => 'Aktif'],
            ['nama' => 'Laptop-PMQLBLTH', 'pengguna' => 'Santo Cornelius Ginting', 'lokasi' => 'Divisi Surveyor Lt 3', 'status' => 'Aktif'],
            ['nama' => 'Laptop-PMQLBLTH', 'pengguna' => 'Fajar Hariyadi', 'lokasi' => 'Divisi Surveyor Lt 3', 'status' => 'Aktif'],
            ['nama' => 'Laptop-PMQLBLTH', 'pengguna' => 'Richard Barus', 'lokasi' => 'Divisi Surveyor Lt 3', 'status' => 'Aktif'],
            ['nama' => 'Laptop-PMQLBLTH', 'pengguna' => 'Firdaus Ginting', 'lokasi' => 'Divisi Surveyor Lt 3', 'status' => 'Aktif'],
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
                'nohp' => '0821-1326-6662',
                'email' => 'aldijhont@gmail.com',
                'status' => 'Aktif',
            ],
        ];

        return view('it.timIT', compact('staffIT'));
    }

}
