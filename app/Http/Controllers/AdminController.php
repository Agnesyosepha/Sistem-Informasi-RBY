<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
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
            [
                'no_ppjp' => '00166/RBY-PPJP/BKS/VIII/2024',
                'tanggal' => '17 Agustus 2024',
                'pemberi_tugas' => 'PT Caturkarda Depo Bangunan, Tbk',
                'nama_penilai' => 'Fajar',
                'adendum' => 'Adendum #11',
                'status' => 'Selesai'
            ],
            [
                'no_ppjp' => '01026/RBY-PPJP/BKS/VII/2024',
                'tanggal' => '24 Juli 2024',
                'pemberi_tugas' => 'Port Mori Corporation',
                'nama_penilai' => 'Jasmani',
                'adendum' => 'Adendum #01',
                'status' => 'Proses'
            ],
            [
                'no_ppjp' => '00199/RBY-PPJP/BKS/VI/2024',
                'tanggal' => '08 Oktober 2025',
                'pemberi_tugas' => 'PT Bahagia Biru',
                'nama_penilai' => 'Santo',
                'adendum' => 'Adendum #51',
                'status' => 'Pending'
            ],
        ];

        return view('admin.suratTugas', compact('suratTugas'));
    }
    

    public function proposal()
{
    $proposal = Proposal::all();

    // Hitung deadline otomatis
    foreach ($proposal as &$p) {
        if ($p->tanggal_disetujui && $p->tanggal_berakhir) {
            $tgl1 = Carbon::parse($p->tanggal_disetujui);
            $tgl2 = Carbon::parse($p->tanggal_berakhir);
            $p->deadline = $tgl1->diffInDays($tgl2) . ' hari';
        } else {
            $p->deadline = '-';
        }
    }

    
    return view('admin.proposal', compact('proposal'));
}
public function storeProposal(Request $request)
{
    Proposal::create([
        'judul'              => $request->judul,
        'pengaju'            => $request->pengaju,
        'tanggal_pengajuan'  => $request->tanggal,
        'tanggal_disetujui'      => $request->tgl_disetujui,
        'deadline'           => $request->deadline,
        'tanggal_berakhir'       => $request->tgl_berakhir,
        'status'             => $request->status,
    ]);

    return redirect()->route('admin.proposal')->with('success', 'Proposal berhasil ditambahkan!');
}
public function updateStatus(Request $request, $id)
{
    $proposal = Proposal::findOrFail($id);
    $proposal->status = $request->status;
    $proposal->save();

    return response()->json(['message' => 'Status updated']);
}
public function SAproposal()
{
    $proposal = Proposal::all();

    foreach ($proposal as $p) {
        if ($p->tanggal_disetujui && $p->tanggal_berakhir) {
            $tgl1 = Carbon::parse($p->tanggal_disetujui);
            $tgl2 = Carbon::parse($p->tanggal_berakhir);
            $p->deadline = $tgl1->diffInDays($tgl2) . ' hari';
        } else {
            $p->deadline = '-';
        }
    }

    return view('admin.SAproposal', compact('proposal'));
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
            'jenis_penilaian' => 'Rumah Tinggal',
            'pengirim' => 'Fajar',
            'nomor_laporan' => 'LAP/010/SP/2025',
            'status_pengiriman' => 'Sudah Dikirim',
            'softcopy' => true,
            'hardcopy' => true
        ],
        [
            'pemberi_tugas' => 'Bank BCA',
            'jenis_penilaian' => 'Tanah & Bangunan',
            'pengirim' => 'Jasmani',
            'nomor_laporan' => 'LAP/011/BCA/2025',
            'status_pengiriman' => 'Sudah Dikirim',
            'softcopy' => true,
            'hardcopy' => false
        ],
        [
            'pemberi_tugas' => 'PT Delta Energi',
            'jenis_penilaian' => 'Gudang',
            'pengirim' => 'Santo',
            'nomor_laporan' => 'LAP/012/DEL/2025',
            'status_pengiriman' => 'Belum Dikirim',
            'softcopy' => false,
            'hardcopy' => false
        ],
        [
            'pemberi_tugas' => 'Bank Mandiri',
            'jenis_penilaian' => 'Tanah Kosong',
            'pengirim' => 'Rania',
            'nomor_laporan' => 'LAP/013/MND/2025',
            'status_pengiriman' => 'Sudah Dikirim',
            'softcopy' => true,
            'hardcopy' => true
        ],
    ];

    return view('admin.laporanFinal', compact('laporanFinal'));
}


public function tim()
    {
        $tim = [
            ['nama' => 'Shafa Az-zahra Eriana', 'username' => 'shamin', 'email' => 'shazamm@delcom.org', 'status' => 'Aktif'],
            ['nama' => 'Mieke Dearni Br Tarigan', 'username' => 'jonadmin', 'email' => 'jon@delcom.org', 'status' => 'Cuti'],
        ];

        return view('admin.timAdmin', compact('tim'));
    }


}
