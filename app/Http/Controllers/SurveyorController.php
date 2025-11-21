<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiSurvei;

class SurveyorController extends Controller
{
    public function index()
    {
        return view('surveyor.index');
    }

    public function tim()
    {
        $tim = [
            [
                'nama' => 'Richard Barus', 
                'nohp' => '0812-8636-5116', 
                'email' => 'richard.barus33@gmail.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Robbi Sugara Ginting', 
                'nohp' => '0821-2358-0669',
                'email' => 'ragaforex88@gmail.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Firdaus Ginting', 
                'nohp' => '0813-1246-7274',
                'email' => 'dausgtg02@gmail.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Amri Simbolon', 
                'nohp' => '0811-1214-890',
                'email' => 'cbnex13@gmail.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Fajar Hariyadi', 
                'nohp' => '0838-7009-5867',
                'email' => '20nya.fajartambunan@gmail.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Jasmani Ginting', 
                'nohp' => '0813-6293-0556',
                'email' => 'jasmanig97@gmail.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Santo Cornelius Ginting', 
                'nohp' => '0811-6511-109',
                'email' => 'antocornelius.g@gmail.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Pretty Balerina Br Bangun', 
                'nohp' => '0857-8207-8806',
                'email' => 'prettybalerina@icloud.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Benhur Sumanraja Sembiring', 
                'nohp' => '0858-3097-6179',
                'email' => 'benhurpopuler2002@gmail.com',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Elma Agnes Silitonga', 
                'nohp' => '0812-8858-1609',
                'email' => 'elmaagnes02@gmail.com',
                'status' => 'Aktif'
            ],
        ];

        return view('surveyor.timsurveyor', compact('tim'));
    }


    public function lokasiSurvei()
    {
        $lokasi = LokasiSurvei::all();  
        return view('surveyor.lokasisurvei', compact('lokasi'));
    }

    public function lokasiSurveiAdmin()
    {
        $lokasi = LokasiSurvei::all();
        return view('surveyor.SAlokasisurvei', compact('lokasi'));
    }

    public function storeLokasiSurveiAdmin(Request $request)
    {
        $request->validate([
            'surveyor' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'nama_objek' => 'required|string',
            'status' => 'required|in:Proses,Selesai',
        ]);

        LokasiSurvei::create($request->only('surveyor','tanggal','lokasi','nama_objek','status'));

        return back()->with('success', 'Lokasi survei berhasil ditambahkan.');
    }

    public function updateStatusAdmin(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Proses,Selesai',
        ]);

        $lokasi = LokasiSurvei::findOrFail($id);
        $lokasi->status = $request->status;
        $lokasi->save();

        return response()->json(['success' => true, 'status' => $lokasi->status]);
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
        [
            'noppjp' => 'PPJP-001',
            'debitur' => 'PT Nusantara Properti',
            'lokasi' => 'Jakarta Selatan',
            'surveyor' => 'Firdaus Ginting',
            'tgl_inspeksi' => '2025-10-15',
            'progres' => 'On Progress'
        ],
        [
            'noppjp' => 'PPJP-002',
            'debitur' => 'CV Sejahtera Makmur',
            'lokasi' => 'Jakarta',
            'surveyor' => 'Fajar Hariyadi	',
            'tgl_inspeksi' => '2025-10-20',
            'progres' => 'Review'
        ],
        [
            'noppjp' => 'PPJP-003',
            'debitur' => 'Bpk. Antonius',
            'lokasi' => 'Bandung',
            'surveyor' => 'Jasmani Ginting',
            'tgl_inspeksi' => '2025-10-25',
            'progres' => 'On Progress'
        ],
    ];

    // Proyek Selesai
    $proyekSelesai = [
    [
        'noppjp' => 'PPJP-001',
        'debitur' => 'PT Sumber Makmur',
        'lokasi' => 'Jakarta',
        'surveyor' => 'Santo Cornelius Ginting',
        'tgl_selesai' => '2025-08-10',
        'progres' => 'Selesai'
    ],
    [
        'noppjp' => 'PPJP-001',
        'debitur' => 'PT Sumber Makmur',
        'lokasi' => 'Tangerang',
        'surveyor' => 'Robbi Sugara Ginting',
        'tgl_selesai' => '2025-08-12',
        'progres' => 'Selesai'
    ],
    [
        'noppjp' => 'PPJP-002',
        'debitur' => 'CV Andalan',
        'lokasi' => 'Jakarta',
        'surveyor' => 'Pretty Balerina Br Bangun',
        'tgl_selesai' => '2025-07-29',
        'progres' => 'Selesai'
    ]
];


    // Proyek Pending
    $proyekPending = [
    [
        'noppjp' => 'PPJP-010',
        'debitur' => 'PT Cahaya Baru',
        'lokasi' => 'Bekasi',
        'surveyor' => 'Robbi Sugara Ginting',
        'tgl_inspeksi' => '2025-08-14',
        'alasan' => 'Menunggu konfirmasi dari klien',
        'progres' => 'Pending'
    ],
    [
        'noppjp' => 'PPJP-011',
        'debitur' => 'CV Nusantara Jaya',
        'lokasi' => 'Jakarta',
        'surveyor' => 'Pretty Balerina Br Bangun',
        'tgl_inspeksi' => '2025-08-16',
        'alasan' => 'Cuaca tidak memungkinkan',
        'progres' => 'Pending'
    ]
];


    return view('surveyor.updateProyek', compact('proyekBerjalan', 'proyekSelesai', 'proyekPending'));
}


}
