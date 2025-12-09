<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Proposal;
use App\Models\User;
use App\Models\Adendum;
use App\Models\SuratTugas;
use App\Models\DraftResume;
use App\Models\DraftLaporan;
use App\Models\TugasHarian;
use App\Models\TugasHarianFile;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use App\Services\NotificationService;

class AdminController extends Controller
{
   public function index()
    {
        $jumlahProposal = Proposal::count();
        
        // Filter untuk Tugas Harian
        $query = TugasHarian::where('is_final_report', 0);
        
        // Filter berdasarkan pencarian
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('pemberi_tugas', 'like', "%$search%")
                ->orWhere('debitur', 'like', "%$search%")
                ->orWhere('no_ppjp', 'like', "%$search%")
                ->orWhere('tim_lapangan', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
            });
        }
        
        // Filter berdasarkan bulan
        if (request('bulan')) {
            $query->whereMonth('tanggal_survei', request('bulan'));
        }
        
        $tugasHarian = $query->with('files')->orderBy('id', 'desc')->get();
        $jumlahTugasHarian = TugasHarian::where('is_final_report', 0)->count();
        
        $laporanFinal = TugasHarian::where('is_final_report', 1)->get();
        
        // Tambahkan variabel untuk menandai tugas yang harus dibuka
        $openTaskId = request('task_id');
        $openTask = request('open') === 'true' ? $openTaskId : null;

        return view('layouts.admin', compact(
            'jumlahProposal', 
            'tugasHarian', 
            'laporanFinal', 
            'jumlahTugasHarian',
            'openTask'
        ));
    }
    
    // Tugas Harian
    public function SAtugasHarian()
    {
        $tugasHarian = TugasHarian::where('is_final_report', 0)
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.SAtugasHarian', compact('tugasHarian'));
    }

    public function storeSAtugasHarian(Request $request)
    {
        $tugasHarian = TugasHarian::create($request->all());

        NotificationService::sendToDivision(
            'Admin',
            'Tahapan 1 - Pengumpulan Data', // Lebih spesifik
            "Tugas baru dengan No. PPJP: {$tugasHarian->no_ppjp} untuk debitur {$tugasHarian->debitur} telah ditambahkan. Silakan upload file untuk tahapan 1 (Pengumpulan Data).",
            'info',
            $tugasHarian
        );

        return back()->with('success', 'Tugas berhasil ditambahkan');
    }

    

    public function updateStatusTugas(Request $request, $id)
    {
        $task = TugasHarian::findOrFail($id);
        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Status updated']);
    }

    public function destroyTugas($id)
    {
        TugasHarian::findOrFail($id)->delete();
        return back()->with('success', 'Tugas berhasil dihapus');
    }

    // Tambahkan method untuk update tahapan
    public function updateTahapan(Request $request, $id)
    {
        $task = TugasHarian::findOrFail($id);
        $task->tahapan = $request->tahapan;
        $task->save();

        return response()->json(['message' => 'Tahapan berhasil diperbarui']);
    }

    public function uploadFile(Request $request, $tugasId, $tahapanId)
    {
        \Log::info('Upload request:', [
            'tugasId' => $tugasId,
            'tahapanId' => $tahapanId,
            'hasFile' => $request->hasFile('file'),
            'isRevision' => $request->input('is_revision', 0),
            'allFiles' => $request->allFiles()
        ]);

        $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        $tugas = TugasHarian::findOrFail($tugasId);
        $file = $request->file('file');
        $isRevision = $request->input('is_revision', 0);

        // Simpan file
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('tugas-harian', $fileName, 'public');

        TugasHarianFile::updateOrCreate(
            [
                'tugas_harian_id' => $tugasId,
                'tahapan_id' => $tahapanId,
                'is_revision' => $isRevision,
            ],
            [
                'filename' => $file->getClientOriginalName(),
                'path' => $filePath,
            ]
        );

        // Kirim notifikasi hanya jika bukan file revisi
        if (!$isRevision) {
            NotificationService::fileUploaded($tugas, $tahapanId);
        }

        if ($tahapanId == 15) {
            $total = TugasHarianFile::where('tugas_harian_id', $tugasId)
                        ->where('is_revision', 0)
                        ->count();

            if ($total >= 15) {
                $tugas->status = 'Selesai';
                $tugas->tahapan = 'Pengiriman Dokumen';
                $tugas->is_final_report = 1;
                $tugas->save();

                \Log::info("Tugas {$tugasId} selesai (15 tahapan lengkap).");
            }
        }

        return response()->json([
            'success' => true, 
            'message' => $isRevision ? 'File revisi berhasil diupload!' : 'File berhasil diupload!',
            'file_url' => Storage::url($filePath)
        ]);
    }

    public function downloadFile($fileId)
    {
        $tugasFile = TugasHarianFile::findOrFail($fileId);
        $filePath = storage_path('app/public/' . $tugasFile->path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        return response()->download($filePath, $tugasFile->filename);
    }

    public function laporanTugasHarian()
    {
        $bulan = request('bulan');
        $search = request('search');

        // QUERY DASAR
        $query = \App\Models\TugasHarian::with('files')
                    ->where('is_final_report', 1);

        // FILTER SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pemberi_tugas', 'like', "%$search%")
                ->orWhere('debitur', 'like', "%$search%")
                ->orWhere('no_ppjp', 'like', "%$search%")
                ->orWhere('tim_lapangan', 'like', "%$search%")
                ->orWhere('tanggal_survei', 'like', "%$search%");
            });
        }

        // FILTER BULAN
        if ($bulan) {
            $query->whereMonth('tanggal_survei', $bulan);
        }

        // HASIL FINAL
        $tugasFinal = $query->orderBy('id', 'desc')->get();

        return view('admin.laporanTugasHarian', compact('tugasFinal'));
    }

// Surat Tugas
    public function SAsuratTugas()
    {
        $suratTugas = SuratTugas::orderBy('id', 'desc')->get();
        
        // Ambil surveyor dari database
        $tim = User::where('divisi', 'Surveyor')
                ->where('status', 'Aktif')
                ->get(['id', 'nama', 'status']);

        return view('admin.SAsuratTugas', compact('suratTugas', 'tim'));
    }

    public function storeSuratTugas(Request $request)
    {
    SuratTugas::create([
        'no_ppjp'           => $request->no_ppjp,
        'tanggal_survey'    => $request->tanggal_survey,
        'lokasi'            => $request->lokasi,
        'objek_penilaian'   => $request->objek_penilaian,
        'pemberi_tugas'     => $request->pemberi_tugas,
        'nama_penilai'      => $request->nama_penilai,
        'adendum'           => $request->adendum,
        'status'            => $request->status,
    ]);

    return redirect()->route('superadmin.admin.SAsuratTugas')
        ->with('success', 'Surat Tugas berhasil ditambahkan!');
    }

    public function suratTugasAdmin()
{
    $query = SuratTugas::query();
    
    // Hitung total data untuk ditampilkan di footer tabel
    $totalSuratTugas = SuratTugas::count();
    
    // Filter berdasarkan pencarian
    if (request('search')) {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('no_ppjp', 'like', "%$search%")
              ->orWhere('lokasi', 'like', "%$search%")
              ->orWhere('objek_penilaian', 'like', "%$search%")
              ->orWhere('pemberi_tugas', 'like', "%$search%")
              ->orWhere('nama_penilai', 'like', "%$search%");
        });
    }
    
    // Filter berdasarkan bulan
    if (request('bulan')) {
        $query->whereMonth('tanggal_survey', request('bulan'));
    }
    
    // Urutkan data dari yang terbaru ke yang terlama
    $suratTugas = $query->orderBy('id', 'desc')->get();
    
    return view('admin.suratTugas', compact('suratTugas', 'totalSuratTugas'));
}

// Agar route /surat-tugas tetap bisa dipakai
public function suratTugas()
{
    return $this->suratTugasAdmin();
}

    public function updateSuratTugas(Request $request, $id)
    {
        $suratTugas = \App\Models\SuratTugas::findOrFail($id);
        $oldStatus = $suratTugas->status;
        $suratTugas->status = $request->status;
        $suratTugas->save();

        // Jika status diubah menjadi "Survey" dan sebelumnya bukan "Survey"
        if ($request->status == 'survey' && $oldStatus != 'survey') {
            // Cek apakah data sudah ada di jadwal_surveyors untuk menghindari duplikasi
            $existingJadwal = \App\Models\JadwalSurveyor::where('surat_tugas_id', $suratTugas->id)->first();
            
            if (!$existingJadwal) {
                \App\Models\JadwalSurveyor::create([
                    'surat_tugas_id' => $suratTugas->id, // Menyimpan ID surat tugas asli untuk referensi
                    'no_ppjp' => $suratTugas->no_ppjp,
                    'tanggal_survey' => $suratTugas->tanggal_survey,
                    'lokasi' => $suratTugas->lokasi,
                    'objek_penilaian' => $suratTugas->objek_penilaian,
                    'pemberi_tugas' => $suratTugas->pemberi_tugas,
                    'nama_penilai' => $suratTugas->nama_penilai,
                    'adendum' => $suratTugas->adendum,
                    'status' => 'Survey', // Status awal di jadwal surveyor adalah Survey
                ]);
            }
            
            // Kirim notifikasi ke surveyor yang dipilih
            $this->sendNotificationToSurveyor($suratTugas->nama_penilai, $suratTugas);
        }

        return response()->json(['message' => 'Status updated']);
    } 

    private function sendNotificationToSurveyor($surveyorName, $suratTugas)
    {
        // Cari user surveyor berdasarkan nama
        $surveyor = User::where('nama', $surveyorName)->where('divisi', 'Surveyor')->first();
        
        if ($surveyor) {
            // Buat notifikasi untuk surveyor
            Notification::create([
                'user_id' => $surveyor->id,
                'surat_tugas_id' => $suratTugas->id,
                'title' => 'Surat Tugas Baru',
                'message' => "Anda telah ditugaskan untuk survey pada {$suratTugas->tanggal_survey} di lokasi {$suratTugas->lokasi}. Objek penilaian: {$suratTugas->objek_penilaian}.",
                'type' => 'info',
            ]);
        }
    }

// Daftar Proposal
    public function proposal()
    {
        $query = Proposal::query();

    // Search 
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                ->orWhere('pengaju', 'like', "%$search%");
            });
        }

    // Filter Bulan Pengajuan
        if (request('bulan')) {
            $query->whereMonth('tanggal_pengajuan', request('bulan'));
        }

    // Urutkan data dari yang terbaru ke yang terlama
        $proposal = $query->orderBy('id', 'desc')->get();
        $jumlahProposal = $proposal->count();

    // Hitung deadline
        foreach ($proposal as &$p) {
            if ($p->tanggal_disetujui && $p->tanggal_berakhir) {
                $tgl1 = Carbon::parse($p->tanggal_disetujui);
                $tgl2 = Carbon::parse($p->tanggal_berakhir);
                $p->deadline = $tgl1->diffInDays($tgl2) . ' hari';
            } else {
                $p->deadline = '-';
            }
        }

        return view('admin.proposal', compact('proposal', 'jumlahProposal'));
    }

    public function storeProposal(Request $request)
    {
        Proposal::create([
            'judul'              => $request->judul,
            'pengaju'            => $request->pengaju,
            'tanggal_pengajuan'  => $request->tanggal,
            'tanggal_disetujui'  => $request->tgl_disetujui,
            'deadline'           => $request->deadline,
            'tanggal_berakhir'   => $request->tgl_berakhir,
            'status'             => $request->status,
        ]);

        return redirect()->route('superadmin.admin.SAproposal')->with('success', 'Proposal berhasil ditambahkan!');
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
        $proposal = Proposal::orderBy('id', 'desc')->get();
        $jumlahProposal = Proposal::count();

        foreach ($proposal as $p) {
            if ($p->tanggal_disetujui && $p->tanggal_berakhir) {
                $tgl1 = Carbon::parse($p->tanggal_disetujui);
                $tgl2 = Carbon::parse($p->tanggal_berakhir);
                $p->deadline = $tgl1->diffInDays($tgl2) . ' hari';
            } else {
                $p->deadline = '-';
            }
        }

        return view('admin.SAproposal', compact('proposal', 'jumlahProposal'));
    }

    public function destroy($id)
    {
        $proposal = \App\Models\Proposal::findOrFail($id);
        $proposal->delete();

        return redirect()->back()->with('success', 'Proposal berhasil dihapus!');
    }



// Adendum
public function adendum()
{
    $query = Adendum::query();
    
    // Hitung total data untuk ditampilkan di footer tabel
    $totalAdendum = Adendum::count();
    
    // Filter berdasarkan pencarian
    if (request('search')) {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('nomor', 'like', "%$search%")
              ->orWhere('proyek', 'like', "%$search%")
              ->orWhere('deskripsi', 'like', "%$search%");
        });
    }
    
    // Filter berdasarkan bulan
    if (request('bulan')) {
        $query->whereMonth('tanggal', request('bulan'));
    }
    
    // Urutkan data dari yang terbaru ke yang terlama
    $adendum = $query->orderBy('id', 'desc')->get();
    
        return view('admin.adendum', compact('adendum', 'totalAdendum'));
    }

public function SAadendum()
{
    $query = Adendum::query();
    
    // Hitung total data untuk ditampilkan di footer tabel
    $totalAdendum = Adendum::count();
    
    // Filter berdasarkan pencarian
    if (request('search')) {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('nomor', 'like', "%$search%")
              ->orWhere('proyek', 'like', "%$search%")
              ->orWhere('deskripsi', 'like', "%$search%");
        });
    }
    
    // Filter berdasarkan bulan
    if (request('bulan')) {
        $query->whereMonth('tanggal', request('bulan'));
    }
    
    // Urutkan data dari yang terbaru ke yang terlama
    $adendum = $query->orderBy('id', 'desc')->get();
    
    return view('admin.SAadendum', compact('adendum', 'totalAdendum'));
}

public function storeAdendum(Request $request)
{
    $validated = $request->validate([
        'nomor' => 'required|string|max:255',
        'proyek' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string',
        'status' => 'required|string',  // <-- TAMBAHKAN VALIDASI
    ]);

    Adendum::create([
        'nomor' => $validated['nomor'],
        'proyek' => $validated['proyek'],
        'tanggal' => $validated['tanggal'],
        'deskripsi' => $validated['deskripsi'],
        'status' => $validated['status'], // <-- TAMBAHKAN INI
    ]);

    return redirect()->back()->with('success', 'Adendum berhasil ditambahkan!');
}

// Draft Resume
public function draftResume()
{
    $query = DraftResume::query();
    
    // Hitung total data untuk ditampilkan di footer tabel
    $totalResume = DraftResume::count();
    
    // Filter berdasarkan pencarian
    if (request('search')) {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('pemberi_tugas', 'like', "%$search%")
              ->orWhere('objek_penilaian', 'like', "%$search%");
        });
    }
    
    // Filter berdasarkan bulan
    if (request('bulan')) {
        $query->where(function($q) {
            $q->whereMonth('tanggal', request('bulan'))
              ->orWhereMonth('tanggal_pengiriman', request('bulan'));
        });
    }
    
    // Urutkan data dari yang terbaru ke yang terlama
    $resume = $query->orderBy('id', 'desc')->get();
    
    return view('admin.draftResume', compact('resume', 'totalResume'));
}

    public function SAdraftResume()
    {
        $resume = \App\Models\DraftResume::orderBy('id', 'desc')->get();
        return view('admin.SAdraftResume', compact('resume'));
    }

    public function SAdraftResumeStore(Request $request)
    {
        \App\Models\DraftResume::create([
            'pemberi_tugas' => $request->pemberi_tugas,
            'objek_penilaian' => $request->objek_penilaian,
            'nilai_pasar' => $request->nilai_pasar,
            'nilai_wajar' => $request->nilai_wajar,
            'nilai_likuidasi' => $request->nilai_likuidasi,
            'tanggal' => $request->tanggal,
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Draft Resume berhasil ditambahkan!');
    }

    public function updateStatusDraftResume(Request $request, $id)
    {
        $proposal = \App\Models\DraftResume::findOrFail($id);
        $proposal->status = $request->status;
        $proposal->save();

        return response()->json(['message' => 'Status updated']);
    }



// Draft Laporan
public function draftLaporan()
{
    $query = DraftLaporan::query();
    
    // Hitung total data untuk ditampilkan di footer tabel
    $totalLaporan = DraftLaporan::count();
    
    // Filter berdasarkan pencarian
    if (request('search')) {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('pemberi_tugas', 'like', "%$search%")
              ->orWhere('nomor_ppjp', 'like', "%$search%");
        });
    }
    
    // Filter berdasarkan bulan
    if (request('bulan')) {
        $query->where(function($q) {
            $q->whereMonth('tgl_proposal', request('bulan'))
              ->orWhereMonth('tgl_pengiriman', request('bulan'));
        });
    }
    
    // Urutkan data dari yang terbaru ke yang terlama
    $laporan = $query->orderBy('id', 'desc')->get();
    
    return view('admin.draftLaporan', compact('laporan', 'totalLaporan'));
}

    public function SAdraftLaporan()
    {
        $laporan = \App\Models\DraftLaporan::orderBy('id', 'desc')->get();

        return view('admin.SAdraftLaporan', compact('laporan'));
    }

    public function storeSAdraftLaporan(Request $request)
    {
    // Validasi
        $request->validate([
            'pemberi_tugas' => 'required|string',
            'nomor_ppjp' => 'required|string',
            'tgl_proposal' => 'required|date',
            'tgl_pengiriman' => 'required|date',
            'status' => 'required|string',
        ]);

    // Simpan ke database
        \App\Models\DraftLaporan::create([
            'pemberi_tugas' => $request->pemberi_tugas,
            'nomor_ppjp' => $request->nomor_ppjp,
            'tgl_proposal' => $request->tgl_proposal,
            'tgl_pengiriman' => $request->tgl_pengiriman,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data draft laporan berhasil ditambahkan!');
    }

    public function updateDraftStatus(Request $request, $id)
    {
        $laporan = DraftLaporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return response()->json(['success' => true]);
    }


// Laporan Final
    public function laporanFinal()
    {
        $query = \App\Models\LaporanFinal::query();

        if (request('search')) {
            $search = request('search');

            $query->where(function($q) use ($search) {
                $q->where('pemberi_tugas', 'like', "%$search%")
                ->orWhere('jenis_penilaian', 'like', "%$search%")
                ->orWhere('pengirim', 'like', "%$search%")
                ->orWhere('nomor_laporan', 'like', "%$search%");
            });
        }

        $laporanFinal = $query->get();

        return view('admin.laporanFinal', compact('laporanFinal'));
    }

    public function SAlaporanFinal()
    {
        $laporanFinal = \App\Models\LaporanFinal::all();
        return view('admin.SAlaporanFinal', compact('laporanFinal'));
    }

    public function storeSAlaporanFinal(Request $request)
    {
        $request->validate([
            'pemberi_tugas' => 'required|string',
            'jenis_penilaian' => 'required|string',
            'pengirim' => 'required|string',
            'nomor_laporan' => 'required|string',
            'status_pengiriman' => 'required|string',
            'softcopy' => 'nullable|boolean',
            'hardcopy' => 'nullable|boolean',
        ]);

        \App\Models\LaporanFinal::create([
            'pemberi_tugas' => $request->pemberi_tugas,
            'jenis_penilaian' => $request->jenis_penilaian,
            'pengirim' => $request->pengirim,
            'nomor_laporan' => $request->nomor_laporan,
            'status_pengiriman' => $request->status_pengiriman,
            'softcopy' => $request->softcopy ? true : false,
            'hardcopy' => $request->hardcopy ? true : false
        ]);

        return redirect()->back()->with('success', 'Data laporan final berhasil ditambahkan!');
    }
    public function updateLaporanFinal(Request $request, $id)
{
    $laporan = \App\Models\LaporanFinal::findOrFail($id);

    $field = $request->field;
    $value = $request->value;

    // Validasi field agar aman
    if (!in_array($field, ['status_pengiriman', 'softcopy', 'hardcopy'])) {
        return response()->json(['error' => 'Field tidak valid'], 400);
    }

    // Update field
    $laporan->$field = $value;
    $laporan->save();

    return response()->json(['success' => true]);
}

    // Anggota Admin
    public function tim()
        {
            $tim = [
                ['nama' => 'Shafa Az-zahra Eriana', 
                'nohp' => '0895-3121-80247', 
                'email' => 'shafaeriana@gmail.com', 
                'status' => 'Aktif'],
                ['nama' => 'Mieke Dearni Br Tarigan', 
                'nohp' => '0822-8850-8800', 
                'email' => 'mieketarigan@gmail.com', 
                'status' => 'Aktif'],
            ];

            return view('admin.timAdmin', compact('tim'));
        }
    
    private function getSurveyorList()
    {
        return collect([
            ['nama' => 'Richard Barus', 'status' => 'Aktif'],
            ['nama' => 'Robbi Sugara Ginting', 'status' => 'Aktif'],
            ['nama' => 'Firdaus Ginting', 'status' => 'Aktif'],
            ['nama' => 'Amri Simbolon', 'status' => 'Aktif'],
            ['nama' => 'Fajar Hariyadi', 'status' => 'Aktif'],
            ['nama' => 'Jasmani Ginting', 'status' => 'Aktif'],
            ['nama' => 'Santo Cornelius Ginting', 'status' => 'Aktif'],
            ['nama' => 'Pretty Balerina Br Bangun', 'status' => 'Aktif'],
            ['nama' => 'Benhur Sumanraja Sembiring', 'status' => 'Aktif'],
            ['nama' => 'Elma Agnes Silitonga', 'status' => 'Aktif'],
        ]);
    }
        


}
