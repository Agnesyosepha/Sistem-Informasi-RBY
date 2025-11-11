<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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
        ['pemberitugas' => 'Admin Utama', 'debitur' => 'Memverifikasi data surveyor', 'noppjp' => 'Selesai', 'tanggal' => '10 Nov 2025', 'timlapangan' => 'Tim PM'],
        ['pemberitugas' => 'Surveyor', 'debitur' => 'Melakukan survey lapangan di Bekasi', 'noppjp' => 'Proses', 'tanggal' => '10 Nov 2025', 'timlapangan' => 'Tim PM'],
        ['pemberitugas' => 'EDP', 'debitur' => 'Backup database dan update sistem', 'noppjp' => 'Proses', 'tanggal' => '09 Nov 2025', 'timlapangan' => 'Tim PM'],
        ['pemberitugas' => 'Keuangan', 'debitur' => 'Menyiapkan laporan pembayaran surveyor', 'noppjp' => 'Belum Mulai', 'tanggal' => '11 Nov 2025', 'timlapangan' => 'Tim PM'],
        ['pemberitugas' => 'Manager', 'debitur' => 'Meninjau laporan proyek mingguan', 'noppjp' => 'Selesai', 'tanggal' => '08 Nov 2025', 'timlapangan' => 'Tim PM'],
      ];

      return view('admin.tugasHarian', compact('tugasHarian'));
    }

    public function proposal()
{
    $proposal = [
        [
            'judul' => 'Penilaian Gedung Utama',
            'pengaju' => 'Surveyor A',
            'tanggal' => '01 Nov 2025',
            'tgl_disetujui' => '03 Nov 2025',
            'tgl_berakhir' => '10 Nov 2025',
            'status' => 'Disetujui'
        ],
        [
            'judul' => 'Survey Lahan Perumahan',
            'pengaju' => 'Surveyor B',
            'tanggal' => '04 Nov 2025',
            'tgl_disetujui' => '06 Nov 2025',
            'tgl_berakhir' => '13 Nov 2025',
            'status' => 'Menunggu Review'
        ],
        [
            'judul' => 'Penilaian Properti Komersial',
            'pengaju' => 'Surveyor C',
            'tanggal' => '05 Nov 2025',
            'tgl_disetujui' => '07 Nov 2025',
            'tgl_berakhir' => '14 Nov 2025',
            'status' => 'Direvisi'
        ],
        [
            'judul' => 'Evaluasi Gudang Logistik',
            'pengaju' => 'Surveyor D',
            'tanggal' => '06 Nov 2025',
            'tgl_disetujui' => '08 Nov 2025',
            'tgl_berakhir' => '15 Nov 2025',
            'status' => 'Disetujui'
        ],
        [
            'judul' => 'Proposal Penilaian Aset Kantor Cabang',
            'pengaju' => 'Surveyor E',
            'tanggal' => '08 Nov 2025',
            'tgl_disetujui' => '09 Nov 2025',
            'tgl_berakhir' => '16 Nov 2025',
            'status' => 'Menunggu Review'
        ],
    ];

    // Hitung deadline otomatis (selisih hari dari disetujui ke berakhir)
    foreach ($proposal as &$p) {
        $tgl1 = \Carbon\Carbon::parse($p['tgl_disetujui']);
        $tgl2 = \Carbon\Carbon::parse($p['tgl_berakhir']);
        $selisih = $tgl1->diffInDays($tgl2);
        $p['deadline'] = $selisih . ' hari';
    }

    return view('admin.proposal', compact('proposal'));
}


public function adendum()
{
    $adendum = [
        ['nomor' => 'AD-001', 'proyek' => 'Penilaian Gedung A', 'tanggal' => '01 Nov 2025', 'deskripsi' => 'Perpanjangan waktu proyek hingga 30 Nov 2025', 'status' => 'Disetujui'],
        ['nomor' => 'AD-002', 'proyek' => 'Survey Tanah Kosong', 'tanggal' => '03 Nov 2025', 'deskripsi' => 'Penambahan area survey di Bekasi', 'status' => 'Menunggu Persetujuan'],
        ['nomor' => 'AD-003', 'proyek' => 'Analisis Properti Komersial', 'tanggal' => '05 Nov 2025', 'deskripsi' => 'Revisi nilai appraisal sesuai data baru', 'status' => 'Direvisi'],
        ['nomor' => 'AD-004', 'proyek' => 'Penilaian Aset Pabrik', 'tanggal' => '07 Nov 2025', 'deskripsi' => 'Perubahan tim surveyor lapangan', 'status' => 'Disetujui'],
        ['nomor' => 'AD-005', 'proyek' => 'Evaluasi Bangunan Kantor', 'tanggal' => '09 Nov 2025', 'deskripsi' => 'Penambahan waktu laporan final', 'status' => 'Proses'],
    ];

    return view('admin.adendum', compact('adendum'));
}

public function draftResume()
{
    $resume = [
        [
            'pemberi_tugas' => 'PT Nusantara Properti',
            'objek_penilaian' => 'Gedung Perkantoran Jakarta',
            'nilai_pasar' => 12500000000,
            'nilai_wajar' => 12000000000,
            'nilai_likuidasi' => 9500000000,
            'tanggal' => '01 Nov 2025',
            'tanggal_pengiriman' => '05 Nov 2025',
            'status' => 'Terkirim'
        ],
        [
            'pemberi_tugas' => 'Bank Mandiri Tbk',
            'objek_penilaian' => 'Tanah & Bangunan Komersial',
            'nilai_pasar' => 8900000000,
            'nilai_wajar' => 8700000000,
            'nilai_likuidasi' => 7300000000,
            'tanggal' => '02 Nov 2025',
            'tanggal_pengiriman' => '06 Nov 2025',
            'status' => 'Final'
        ],
        [
            'pemberi_tugas' => 'PT Delta Energi',
            'objek_penilaian' => 'Gudang & Peralatan Industri',
            'nilai_pasar' => 6500000000,
            'nilai_wajar' => 6200000000,
            'nilai_likuidasi' => 5000000000,
            'tanggal' => '03 Nov 2025',
            'tanggal_pengiriman' => '07 Nov 2025',
            'status' => 'Pending'
        ],
        [
            'pemberi_tugas' => 'Bank BRI',
            'objek_penilaian' => 'Rumah Tinggal Premium',
            'nilai_pasar' => 3200000000,
            'nilai_wajar' => 3100000000,
            'nilai_likuidasi' => 2500000000,
            'tanggal' => '05 Nov 2025',
            'tanggal_pengiriman' => '09 Nov 2025',
            'status' => 'Disetujui'
        ],
    ];

    return view('admin.draftResume', compact('resume'));
}


public function draftLaporan()
{
    $laporan = [
        [
            'pemberi_tugas' => 'PT Nusantara Properti',
            'nomor_ppjp' => 'PPJP/001/NP/2025',
            'tgl_proposal' => '01 Nov 2025',
            'tgl_pengiriman' => '05 Nov 2025',
            'status' => 'Pending'
        ],
        [
            'pemberi_tugas' => 'Bank Mandiri Tbk',
            'nomor_ppjp' => 'PPJP/002/MND/2025',
            'tgl_proposal' => '02 Nov 2025',
            'tgl_pengiriman' => '06 Nov 2025',
            'status' => 'Final'
        ],
        [
            'pemberi_tugas' => 'PT Delta Energi',
            'nomor_ppjp' => 'PPJP/003/DELTA/2025',
            'tgl_proposal' => '03 Nov 2025',
            'tgl_pengiriman' => '07 Nov 2025',
            'status' => 'Disetujui'
        ],
        [
            'pemberi_tugas' => 'Bank BRI',
            'nomor_ppjp' => 'PPJP/004/BRI/2025',
            'tgl_proposal' => '04 Nov 2025',
            'tgl_pengiriman' => '09 Nov 2025',
            'status' => 'Ditolak'
        ],
    ];

    return view('admin.draftLaporan', compact('laporan'));
}

public function laporanFinal()
{
    $laporanFinal = [
        [
            'pemberi_tugas' => 'PT Sinar Properti',
            'nomor_ppjp' => 'PPJP/010/SP/2025',
            'tgl_pengiriman' => '01 Nov 2025',
            'jenis_penilaian' => 'Properti Komersial',
            'status' => 'Disetujui'
        ],
        [
            'pemberi_tugas' => 'Bank BCA',
            'nomor_ppjp' => 'PPJP/011/BCA/2025',
            'tgl_pengiriman' => '02 Nov 2025',
            'jenis_penilaian' => 'Tanah & Bangunan',
            'status' => 'Disetujui'
        ],
        [
            'pemberi_tugas' => 'PT Delta Energi',
            'nomor_ppjp' => 'PPJP/012/DEL/2025',
            'tgl_pengiriman' => '03 Nov 2025',
            'jenis_penilaian' => 'Mesin Industri',
            'status' => 'Direvisi'
        ],
        [
            'pemberi_tugas' => 'Bank Mandiri',
            'nomor_ppjp' => 'PPJP/013/MND/2025',
            'tgl_pengiriman' => '04 Nov 2025',
            'jenis_penilaian' => 'Aset Kantor',
            'status' => 'Arsip'
        ],
        [
            'pemberi_tugas' => 'PT Graha Sentosa',
            'nomor_ppjp' => 'PPJP/014/GS/2025',
            'tgl_pengiriman' => '05 Nov 2025',
            'jenis_penilaian' => 'Kendaraan Operasional',
            'status' => 'Disetujui'
        ],
        [
            'pemberi_tugas' => 'Bank BTN',
            'nomor_ppjp' => 'PPJP/015/BTN/2025',
            'tgl_pengiriman' => '07 Nov 2025',
            'jenis_penilaian' => 'Rumah Tapak',
            'status' => 'Disetujui'
        ],
    ];

    return view('admin.laporanFinal', compact('laporanFinal'));
}



}
