<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Proposal;
use App\Models\Adendum;
use App\Models\SuratTugas;
use App\Models\DraftResume;
use App\Models\DraftLaporan;
use App\Models\TugasHarian;
use App\Models\TugasHarianFile;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function index()
    {
        $jumlahProposal = Proposal::count();
        $tugasHarian = TugasHarian::all();
        $laporanFinal = TugasHarian::where('is_final_report', 1)->get();

        return view('layouts.admin', compact('jumlahProposal', 'tugasHarian', 'laporanFinal'));
    }
    
    // Tugas Harian
    public function SAtugasHarian()
    {
        $tugasHarian = TugasHarian::all();
        return view('admin.SAtugasHarian', compact('tugasHarian'));
    }

    public function storeSAtugasHarian(Request $request)
    {
        TugasHarian::create($request->all());
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

        if ($tahapanId == 12) {
            // Hitung jumlah tahapan yang sudah ada file utamanya
            $total = TugasHarianFile::where('tugas_harian_id', $tugasId)
                        ->where('is_revision', 0)
                        ->count();

            if ($total >= 12) {

                // === 1. UPDATE STATUS TUGAS JADI FINAL ===
                $tugas->status = 'Selesai';
                $tugas->tahapan = 'Pengiriman Dokumen';
                $tugas->is_final_report = 1;
                $tugas->save();

                // === 2. PINDAHKAN KE LAPORAN PENILAIAN (opsional) ===
                LaporanPenilaian::create([
                    'tugas_harian_id' => $tugasId,
                    'debitur' => $tugas->debitur,
                    'no_ppjp' => $tugas->no_ppjp,
                    'tanggal_survei' => $tugas->tanggal_survei,
                    'tim_lapangan' => $tugas->tim_lapangan,
                ]);

                \Log::info("Tugas {$tugasId} selesai dan dipindahkan ke laporan penilaian.");
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

        $query = \App\Models\TugasHarian::with('files')
                    ->where('is_final_report', 1);

        if ($bulan) {
            $query->whereMonth('tanggal_survei', $bulan);
        }

        // ✔ GUNAKAN QUERY YANG SUDAH DIFILTER
        $tugasFinal = $query->get();

        return view('admin.laporanTugasHarian', compact('tugasFinal'));
    }

// Surat Tugas
    public function SAsuratTugas()
    {
        $suratTugas = SuratTugas::all();
        return view('admin.SAsuratTugas', compact('suratTugas'));
    }

    public function storeSuratTugas(Request $request)
    {
        SuratTugas::create([
            'no_ppjp'       => $request->no_ppjp,
            'tanggal'       => $request->tanggal,
            'pemberi_tugas' => $request->pemberi_tugas,
            'nama_penilai'  => $request->nama_penilai,
            'adendum'       => $request->adendum,
            'status'        => $request->status,
        ]);

        return redirect()->route('superadmin.admin.SAsuratTugas')
            ->with('success', 'Surat Tugas berhasil ditambahkan!');
    }

    public function suratTugasAdmin()
    {
        $suratTugas = SuratTugas::all();
        return view('admin.suratTugas', compact('suratTugas'));
    }

    // Agar route /surat-tugas tetap bisa dipakai
    public function suratTugas()
    {
        return $this->suratTugasAdmin();
    }

    public function updateSuratTugas(Request $request, $id)
    {
        $suratTugas = \App\Models\SuratTugas::findOrFail($id);
        $suratTugas->status = $request->status;
        $suratTugas->save();

        return response()->json(['message' => 'Status updated']);
    }
    

// Daftar Proposal
    public function proposal()
    {
        $proposal = Proposal::all();
        $jumlahProposal = Proposal::count();

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

    
        return view('admin.proposal', compact('proposal', 'jumlahProposal'));
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
        $proposal = Proposal::all();
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
        $adendum = Adendum::all();
        return view('admin.adendum', compact('adendum'));
    }

    public function SAadendum()
    {
        $adendum = \App\Models\Adendum::all();
        return view('admin.SAadendum', compact('adendum'));
    }

    public function storeAdendum(Request $request)
    {
        $request->validate([
            'nomor' => 'required',
            'proyek' => 'required',
            'tanggal' => 'required|date',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        \App\Models\Adendum::create($request->all());

        return redirect()->route('superadmin.admin.SAadendum')->with('success', 'Adendum Berhasil Ditambahkan');
    }

    public function updateStatusAdendum(Request $request, $id)
    {
        $adendum = \App\Models\Adendum::findOrFail($id);
        $adendum->status = $request->status;
        $adendum->save();

        return response()->json(['message' => 'Status updated']);
    }



// Draft Resume
    public function draftResume()
    {
        $resume = \App\Models\DraftResume::all();
        return view('admin.draftResume', compact('resume'));
    }

    public function SAdraftResume()
    {
        $resume = \App\Models\DraftResume::all();
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
        $laporan = \App\Models\DraftLaporan::all();
        return view('admin.draftLaporan', compact('laporan'));
    }

    public function SAdraftLaporan()
    {
        $laporan = \App\Models\DraftLaporan::all();

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
        $laporanFinal = \App\Models\LaporanFinal::all();
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


}
