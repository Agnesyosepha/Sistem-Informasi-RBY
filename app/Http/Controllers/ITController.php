<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ITController extends Controller
{
    // Halaman form peminjaman
    public function formPeminjaman()
    {
        return view('it.formpeminjaman');
    }


// Laporan Penilaian
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


// Server
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


 // Komputer   
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


// Lapotop    
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


// Form Peminjaman
    public function uploadFormPage()
    {
        // ambil list file dari disk 'public' pada folder formpeminjaman
        $files = [];
        if (Storage::disk('public')->exists('formpeminjaman')) {
            $list = Storage::disk('public')->files('formpeminjaman'); // array nama file
            // map ke struktur yang view Anda pakai, ambil lastModified untuk tanggal
            foreach ($list as $filePath) {
                $files[] = [
                    'nama' => basename($filePath),
                    'tanggal' => date('Y-m-d H:i:s', Storage::disk('public')->lastModified($filePath))
                ];
            }
        }
        // optional: urutkan terbaru dulu (lastModified desc)
        usort($files, function($a, $b){
            return strtotime($b['tanggal']) <=> strtotime($a['tanggal']);
        });

        return view('it.uploadForm', compact('files'));
    }

    public function uploadFormStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();

        // Simpan di disk public -> storage/app/public/formpeminjaman
        Storage::disk('public')->putFileAs('formpeminjaman', $file, $filename);

        return redirect()->route('it.uploadForm.page') // ganti nama route sesuai route Anda
                         ->with('success', 'File berhasil diunggah!');
    }

    
// Tim
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
