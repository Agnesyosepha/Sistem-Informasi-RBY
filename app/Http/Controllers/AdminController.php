<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Proposal;
use App\Models\Adendum;
use App\Models\SuratTugas;
use App\Models\DraftResume;
use App\Models\DraftLaporan;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index'); // Halaman utama dashboard admin
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


    // Tugas Harian
    public function SAtugasHarian()
    {
        $tugasHarian = \App\Models\TugasHarian::all();
        return view('admin.SAtugasHarian', compact('tugasHarian'));
    }

    public function storeSAtugasHarian(Request $request)
    {
        \App\Models\TugasHarian::create([
            'pemberi_tugas'  => $request->pemberi_tugas,
            'debitur'       => $request->debitur,
            'no_ppjp'        => $request->no_ppjp,
            'tanggal_survei'       => $request->tanggal_survei,
            'tim_lapangan'   => $request->tim_lapangan,
            'status'        => $request->status,
        ]);

        return redirect()->route('superadmin.admin.SAtugasHarian')->with('success', 'Tugas Harian berhasil ditambahkan!');
    }

    public function updateStatusTugas(Request $request, $id)
    {
        $tugasHarian = TugasHarian::findOrFail($id);
        $tugasHarian->status = $request->status;
        $tugasHarian->save();

        return response()->json(['message' => 'Status updated']);
    }

    public function destroyTugas($id)
    {
        $tugasHarian = \App\Models\TugasHarian::findOrFail($id);
        $tugasHarian->delete();

        return redirect()->back()->with('success', 'Tugas Harian berhasil dihapus!');
    }



    // Anggota Admin
    public function tim()
        {
            $tim = [
                ['nama' => 'Shafa Az-zahra Eriana', 
                'nohp' => '0895312180247', 
                'email' => 'shafaeriana@gmail.com', 
                'status' => 'Aktif'],
                ['nama' => 'Mieke Dearni Br Tarigan', 
                'nohp' => '082288508800', 
                'email' => 'mieketarigan@gmail.com', 
                'status' => 'Aktif'],
            ];

            return view('admin.timAdmin', compact('tim'));
        }


}
