<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\DataAktif;
use App\Models\LogEDP;
use App\Models\DokumenRevisi;
use App\Models\LaporanPenilaian;

class EdpController extends Controller
{
  public function tim()
    {
        $staff = [
            ['nama' => 'Aprilius Ginting', 'nohp' => '0821-2230-2387', 'email' => 'rutsahanayasembiring@gmail.com', 'status' => 'Aktif'],
            ['nama' => 'Michael Brema Pinem', 'nohp' => '0895-3387-33453', 'email' => 'michaelbp3105@gmail.com', 'status' => 'Aktif'],
            ['nama' => 'Yohanes Kroll Koten', 'nohp' => '0896-7574-0893', 'email' => 'yohaneskrollkoten@gmail.com', 'status' => 'Aktif'],
        ];

        return view('EDP.timEdp', compact('staff'));
    }
  
    public function dataMentah()
    {
        // ambil list file yang sudah diupload
        $files = \Storage::files('edp_data');

        return view('EDP.dataMentah', compact('files'));
    }

    public function uploadData(Request $request)
    {
        $request->validate([
            'data_zip' => 'required|mimes:zip|max:20480', // max 20MB
        ]);

        $file = $request->file('data_zip');
        $originalName = $file->getClientOriginalName();

        $file->storeAs('edp_data', $originalName);

        return redirect()->route('edp.dataMentah')->with('success', 'Data berhasil diupload.');
    }
    
    
// Data Aktif
    public function dataAktif(Request $request)
    {
    $search = $request->search;
    $bulan = $request->bulan;

    $dataAktif = DataAktif::when($search, function ($query) use ($search) {
            $query->where('tanggal', 'like', "%$search%")
                ->orWhere('jenis', 'like', "%$search%")
                ->orWhere('pemberi', 'like', "%$search%")
                ->orWhere('pengguna', 'like', "%$search%")
                ->orWhere('surveyor', 'like', "%$search%")
                ->orWhere('lokasi', 'like', "%$search%")
                ->orWhere('objek', 'like', "%$search%")
                ->orWhere('status_progres', 'like', "%$search%");
        })
        ->when($bulan, function ($query) use ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        })
        ->orderBy('id', 'desc')
        ->get();

    return view('EDP.dataAktif', compact('dataAktif'));
    }

    public function SAdataAktif()
    {
        $dataAktif = DataAktif::all();
        return view('EDP.SAdataAktif', compact('dataAktif'));
    }

    public function storeDataAktif(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|string',
            'pemberi' => 'required|string',
            'pengguna' => 'required|string',
            'surveyor' => 'required|string',
            'lokasi' => 'required|string',
            'objek' => 'required|string',
            'status_progres' => 'required|string',
        ]);

        DataAktif::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $data = DataAktif::findOrFail($id);

        $data->update([
            'status_progres' => $request->status_progres
        ]);

        if ($request->status_progres === 'Reviewer') {

            DokumenRevisi::create([
                'tanggal'  => $data->tanggal,
                'jenis'    => $data->jenis, 
                'pemberi'  => $data->pemberi,
                'pengguna' => $data->pengguna,
                'surveyor' => $data->surveyor,
                'lokasi'   => $data->lokasi,
                'objek'    => $data->objek,
                'reviewer' => null,
                'status'   => 'Dalam Revisi'
            ]);

            $data->delete();
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }



// Dokumen Final
    public function dokumenFinal(Request $request)
    {
        // Ambil file dari storage/app/public/dokumen_final
            $files = Storage::disk('public')->files('dokumen_final');

        // Buat daftar file dengan tanggal upload
            $dokumenFinal = collect($files)->map(function ($file) {
                return [
                    'nama' => $file,
                    'tanggal' => Carbon::createFromTimestamp(Storage::disk('public')->lastModified($file)),
                ];
            });

        // Filter berdasarkan search
            if ($request->filled('search')) {
                $dokumenFinal = $dokumenFinal->filter(function ($item) use ($request) {
                    return stripos(basename($item['nama']), $request->search) !== false;
                });
            }

        // Filter berdasarkan bulan
            if ($request->filled('bulan')) {
                $dokumenFinal = $dokumenFinal->filter(function ($item) use ($request) {
                    return Carbon::parse($item['tanggal'])->month == $request->bulan;
                });
            }

        // Urutkan berdasarkan tanggal terbaru
            $dokumenFinal = $dokumenFinal->sortByDesc('tanggal')->values();

            return view('EDP.dokumenFinal', ['dokumenFinal' => $dokumenFinal]);
    }

    public function uploadDokumenFinal(Request $request)
    {
        $request->validate([
            'data_zip' => 'required|mimes:zip|max:20480', // max 20MB
        ]);

        $file = $request->file('data_zip');
        $originalName = $file->getClientOriginalName();

        // Simpan ke storage/app/public/dokumen_final
        $file->storeAs('dokumen_final', $originalName, 'public');

        return redirect()->route('edp.dokumenFinal')->with('success', 'Dokumen berhasil diupload.');
    }

    public function deleteDokumenFinal($filename)
    {
        $path = 'dokumen_final/' . $filename;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return redirect()->route('edp.dokumenFinal')->with('success', 'Dokumen berhasil dihapus.');
        }

        return redirect()->route('edp.dokumenFinal')->with('error', 'Dokumen tidak ditemukan.');
    }

// Log Aktivitas
    public function index(Request $request) // Tambahkan Request $request
    {
        // Ambil data log aktivitas (kode asli Anda)
        $logAktivitas = LogEDP::orderBy('tanggal', 'desc')->get();

        // --- TAMBAHKAN KODE INI ---
        // Ambil data Data Aktif dengan filter, sama seperti di method dataAktif()
        $search = $request->search;
        $bulan = $request->bulan;

        $dataAktif = DataAktif::when($search, function ($query) use ($search) {
                $query->where('tanggal', 'like', "%$search%")
                    ->orWhere('jenis', 'like', "%$search%")
                    ->orWhere('pemberi', 'like', "%$search%")
                    ->orWhere('pengguna', 'like', "%$search%")
                    ->orWhere('surveyor', 'like', "%$search%")
                    ->orWhere('lokasi', 'like', "%$search%")
                    ->orWhere('objek', 'like', "%$search%")
                    ->orWhere('status_progres', 'like', "%$search%");
            })
            ->when($bulan, function ($query) use ($bulan) {
                $query->whereMonth('tanggal', $bulan);
            })
            ->orderBy('id', 'desc')
            ->get();
        // --- AKHIR KODE TAMBAHAN ---

        // Kirim kedua data (logAktivitas dan dataAktif) ke view
        return view('layouts.edp', compact('logAktivitas', 'dataAktif'));
    }

    public function SAlogEDP()
    {
        $logAktivitas = LogEDP::all();
        return view('EDP.SAlogEDP', compact('logAktivitas'));
    }

    public function storeLogEDP(Request $request)
    {
        $request->validate([
            'no_laporan' => 'required',
            'tanggal' => 'required|date',
            'pemberi_tugas' => 'required',
            'penilai' => 'required',
            'staff' => 'required',
            'status' => 'required',
        ]);

        LogEDP::create([
            'no_laporan' => $request->no_laporan,
            'tanggal' => $request->tanggal,
            'pemberi_tugas' => $request->pemberi_tugas,
            'penilai' => $request->penilai,
            'staff' => $request->staff,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('superadmin.edp.SAlogEDP')
            ->with('success', 'Data Log Aktivitas berhasil ditambahkan!');
    }

    public function updateLogEDP(Request $request, $id)
    {
    $request->validate([
        'status' => 'required'
    ]);

    $log = LogEDP::findOrFail($id);
    $log->status = $request->status;
    $log->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    

// Laporan Penilaian Final
    public function laporanPenilaianUser()
    {
    $search = request('search');
    $bulan  = request('bulan'); // <-- ambil bulan dari request

    $laporanPenilaian = LaporanPenilaian::query()

        // FILTER SEARCH
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tanggal', 'like', "%$search%")
                    ->orWhere('jenis', 'like', "%$search%")
                    ->orWhere('pemberi', 'like', "%$search%")
                    ->orWhere('pengguna', 'like', "%$search%")
                    ->orWhere('surveyor', 'like', "%$search%")
                    ->orWhere('lokasi', 'like', "%$search%")
                    ->orWhere('objek', 'like', "%$search%")
                    ->orWhere('reviewer', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%");
            });
        })

        // FILTER BULAN
        ->when($bulan, function ($query) use ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        })

        ->orderBy('id', 'desc')
        ->get();

    return view('EDP.laporanPenilaian', compact('laporanPenilaian'));
    }


    public function laporanPenilaianAdmin()
    {
    $search = request('search');
    $bulan = request('bulan');

    $laporanPenilaian = LaporanPenilaian::when($search, function ($query) use ($search) {
            $query->where('tanggal', 'like', "%$search%")
                ->orWhere('jenis', 'like', "%$search%")
                ->orWhere('pemberi', 'like', "%$search%")
                ->orWhere('pengguna', 'like', "%$search%")
                ->orWhere('surveyor', 'like', "%$search%")
                ->orWhere('lokasi', 'like', "%$search%")
                ->orWhere('objek', 'like', "%$search%")
                ->orWhere('reviewer', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
        })
        ->when($bulan, function ($query) use ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        })
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('EDP.SAlaporanpenilaianfinal', compact('laporanPenilaian'));
    }

    public function storeLaporanPenilaian(Request $request)
    {
    $request->validate([
        'tanggal' => 'required|date',
        'jenis' => 'required|string',
        'pemberi' => 'required|string',
        'pengguna' => 'required|string',
        'surveyor' => 'required|string',
        'lokasi' => 'required|string',
        'objek' => 'required|string',
        'reviewer' => 'nullable|string',
        'status' => 'required|string',
        'softcopy' => 'nullable|file|mimes:pdf',
    ]);

    $laporan = new LaporanPenilaian();
    $laporan->tanggal = $request->tanggal;
    $laporan->jenis = $request->jenis;
    $laporan->pemberi = $request->pemberi;
    $laporan->pengguna = $request->pengguna;
    $laporan->surveyor = $request->surveyor;
    $laporan->lokasi = $request->lokasi;
    $laporan->objek = $request->objek;
    $laporan->reviewer = $request->reviewer;
    $laporan->status = $request->status;

    if ($request->hasFile('softcopy')) {
        $file = $request->file('softcopy');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('laporan', $filename, 'public');
        $laporan->softcopy = $filename;
    }

    $laporan->save();

    return back()->with('success', 'Laporan penilaian berhasil ditambahkan.');
}

public function editLaporanPenilaian($id)
{
    $laporan = LaporanPenilaian::findOrFail($id);
    return response()->json($laporan);
}

public function updateLaporanPenilaian(Request $request, $id)
{
    $request->validate([
        'tanggal' => 'required|date',
        'jenis' => 'required|string',
        'pemberi' => 'required|string',
        'pengguna' => 'required|string',
        'surveyor' => 'required|string',
        'lokasi' => 'required|string',
        'objek' => 'required|string',
        'reviewer' => 'nullable|string',
        'status' => 'required|string',
    ]);

    $laporan = LaporanPenilaian::findOrFail($id);
    $laporan->tanggal = $request->tanggal;
    $laporan->jenis = $request->jenis;
    $laporan->pemberi = $request->pemberi;
    $laporan->pengguna = $request->pengguna;
    $laporan->surveyor = $request->surveyor;
    $laporan->lokasi = $request->lokasi;
    $laporan->objek = $request->objek;
    $laporan->reviewer = $request->reviewer;
    $laporan->status = $request->status;

    $laporan->save();

    return response()->json(['success' => true, 'message' => 'Laporan penilaian berhasil diperbarui.']);
}


public function destroyLaporanPenilaian($id)
{
    $laporan = LaporanPenilaian::findOrFail($id);
    $laporan->delete();
    
    return response()->json(['success' => true, 'message' => 'Laporan penilaian berhasil dihapus.']);
}

public function uploadSoftcopy(Request $request, $id)
    {
        $request->validate([
        'softcopy' => 'required|file|mimes:pdf|max:10240', // max 10MB
        ]);

        $laporan = LaporanPenilaian::findOrFail($id);

    // Hapus file lama jika ada
        if ($laporan->softcopy && Storage::disk('public')->exists('laporan/'.$laporan->softcopy)) {
            Storage::disk('public')->delete('laporan/'.$laporan->softcopy);
        }

    // Upload file baru
        if ($request->hasFile('softcopy')) {
            $file = $request->file('softcopy');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('laporan', $filename, 'public');
            $laporan->softcopy = $filename;
            $laporan->save();
        }

        return back()->with('success', 'File berhasil diupload.');
    }
    public function destroyDataAktif($id)
    {
        $data = DataAktif::findOrFail($id);
        $data->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }


}