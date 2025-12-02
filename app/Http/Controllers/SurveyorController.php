<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiSurvei;
use App\Models\ProyekBerjalan;
use App\Models\ProyekSelesai;
use App\Models\ProyekPending;
use App\Models\LaporanPenilaian;
use App\Models\JadwalSurveyor;
use App\Models\LaporanJadwal;

class SurveyorController extends Controller
{
    /* ================================
       DASHBOARD SURVEYOR (USER)
    ================================= */
    public function dashboard()
    {
        $jadwal = JadwalSurveyor::where('status', 'Survey')->orderBy('tanggal_survey', 'asc')->get();
        return view('layouts.surveyor', compact('jadwal'));
    }

    public function laporanJadwal()
    {
        $laporanJadwal = LaporanJadwal::orderBy('tanggal_survey', 'desc')->get();
        return view('surveyor.laporanJadwal', compact('laporanJadwal'));
    }

// Jadwal Surveyor di Superadmin
    public function jadwalAdmin()
    {
        $jadwal = JadwalSurveyor::orderBy('tanggal_survey', 'asc')->get();
        return view('surveyor.SAjadwalsurveyor', compact('jadwal'));
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'no_ppjp' => 'required',
            'tanggal_survey' => 'required|date',
            'lokasi' => 'required',
            'objek_penilaian' => 'required',
            'pemberi_tugas' => 'required',
            'nama_penilai' => 'required',
            'adendum' => 'nullable',
            'status' => 'required|in:Selesai,Survey',
        ]);

        JadwalSurveyor::create($request->all());

        return back()->with('success', 'Jadwal Surveyor berhasil ditambahkan.');
    }

    public function deleteJadwal($id)
    {
        JadwalSurveyor::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal Surveyor berhasil dihapus.');
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = JadwalSurveyor::findOrFail($id);

    $jadwal->update([
        'no_ppjp' => $request->no_ppjp,
        'tanggal_survey' => $request->tanggal_survey,
        'lokasi' => $request->lokasi,
        'objek_penilaian' => $request->objek_penilaian,
        'pemberi_tugas' => $request->pemberi_tugas,
        'nama_penilai' => $request->nama_penilai,
        'adendum' => $request->adendum,
        'status' => $request->status,
        ]);

    // Jika status diubah menjadi "Selesai", tambahkan ke tabel laporan_jadwals
    if ($request->status == 'Selesai') {
        // Cek apakah data sudah ada di laporan_jadwals untuk menghindari duplikasi
        $existingLaporan = LaporanJadwal::where('jadwal_id', $jadwal->id)->first();
        
        if (!$existingLaporan) {
            LaporanJadwal::create([
                'jadwal_id' => $jadwal->id, // Menyimpan ID jadwal asli untuk referensi
                'no_ppjp' => $jadwal->no_ppjp,
                'tanggal_survey' => $jadwal->tanggal_survey,
                'lokasi' => $jadwal->lokasi,
                'objek_penilaian' => $jadwal->objek_penilaian,
                'pemberi_tugas' => $jadwal->pemberi_tugas,
                'nama_penilai' => $jadwal->nama_penilai,
                'adendum' => $jadwal->adendum,
                'status' => $jadwal->status,
                ]);
            }
        }

        return redirect()->route('superadmin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }


// Tim
    public function tim()
    {
        $tim = [
            ['nama' => 'Richard Barus','nohp' => '0812-8636-5116','email' => 'richard.barus33@gmail.com', 'status' => 'Aktif'],
            ['nama' => 'Robbi Sugara Ginting','nohp' => '0821-2358-0669','email' => 'ragaforex88@gmail.com','status' => 'Aktif'],
            ['nama' => 'Firdaus Ginting','nohp' => '0813-1246-7274','email' => 'dausgtg02@gmail.com','status' => 'Aktif'],
            ['nama' => 'Amri Simbolon','nohp' => '0811-1214-890','email' => 'cbnex13@gmail.com','status' => 'Aktif'],
            ['nama' => 'Fajar Hariyadi','nohp' => '0838-7009-5867','email' => '20nya.fajartambunan@gmail.com','status' => 'Aktif'],
            ['nama' => 'Jasmani Ginting','nohp' => '0813-6293-0556','email' => 'jasmanig97@gmail.com','status' => 'Aktif'],
            ['nama' => 'Santo Cornelius Ginting','nohp' => '0811-6511-109','email' => 'antocornelius.g@gmail.com','status' => 'Aktif'],
            ['nama' => 'Pretty Balerina Br Bangun','nohp' => '0857-8207-8806','email' => 'prettybalerina@icloud.com','status' => 'Aktif'],
            ['nama' => 'Benhur Sumanraja Sembiring','nohp' => '0858-3097-6179','email' => 'benhurpopuler2002@gmail.com','status' => 'Aktif'],
            ['nama' => 'Elma Agnes Silitonga','nohp' => '0812-8858-1609','email' => 'elmaagnes02@gmail.com','status' => 'Aktif'],
        ];

        return view('surveyor.timsurveyor', compact('tim'));
    }

    public function lokasiSurvei()
    {
        $lokasi = LokasiSurvei::all();  
        return view('surveyor.lokasisurvei', compact('lokasi'));
    }

    /* ==========================================
       ADMIN / SUPERADMIN — LOKASI SURVEI
    =========================================== */
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

        LokasiSurvei::create($request->only(
            'surveyor','tanggal','lokasi','nama_objek','status'
        ));

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


    /* ==========================================
       LAPORAN PENILAIAN SURVEYOR (USER)
    =========================================== */
    public function laporanPenilaianUser()
    {
        $search = request('search');

        $laporanPenilaian = LaporanPenilaian::when($search, function ($query) use ($search) {
            $query->where('nomor_laporan', 'like', "%$search%")
                ->orWhere('klien', 'like', "%$search%")
                ->orWhere('jenis_aset', 'like', "%$search%")
                ->orWhere('lokasi', 'like', "%$search%");
        })
        ->orderBy('tgl_laporan', 'desc')
        ->get();

    return view('surveyor.laporanPenilaian', compact('laporanPenilaian'));
    }
    
    public function laporanPenilaianAdmin()
    {
        $laporanPenilaian = LaporanPenilaian::orderBy('tgl_laporan', 'desc')->get();
         return view('surveyor.SAlaporanpenilaianfinal', compact('laporanPenilaian'));
    }
    public function storeLaporanPenilaian(Request $request)
    {
        $request->validate([
            'nomor_laporan' => 'required|string',
            'klien' => 'required|string',
            'jenis_aset' => 'required|string',
            'lokasi' => 'required|string',
            'tgl_laporan' => 'required|date',
            'softcopy' => 'nullable|file|mimes:pdf',
        ]);

        $laporan = new LaporanPenilaian();
        $laporan->nomor_laporan = $request->nomor_laporan;
        $laporan->klien = $request->klien;
        $laporan->jenis_aset = $request->jenis_aset;
        $laporan->lokasi = $request->lokasi;
        $laporan->tgl_laporan = $request->tgl_laporan;

        if ($request->hasFile('softcopy')) {
            $file = $request->file('softcopy');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('laporan', $filename, 'public');
            $laporan->softcopy = $filename;
        }

        $laporan->save();

        return back()->with('success', 'Laporan penilaian berhasil ditambahkan.');
    }

    /* ==========================================
       UPDATE PROYEK (USER & ADMIN)
    =========================================== */

    // 👉 USER
    public function updateProyekUser()
    {
        return view('surveyor.updateProyek', [
            'proyekBerjalan' => ProyekBerjalan::all(),
            'proyekSelesai'  => ProyekSelesai::all(),
            'proyekPending'  => ProyekPending::all()
        ]);
    }

    // 👉 ADMIN / SUPERADMIN
    public function updateProyekAdmin()
    {
        return view('surveyor.SAupdateproyek', [
            'proyekBerjalan' => ProyekBerjalan::all(),
            'proyekSelesai'  => ProyekSelesai::all(),
            'proyekPending'  => ProyekPending::all()
        ]);
    }


    /* ==========================================
       STORE PROYEK (UNTUK ADMIN ATAU USER)
    =========================================== */
    public function storeProyek(Request $request)
    {
        if ($request->tipe == 'berjalan') {
            ProyekBerjalan::create([
                "noppjp"   => $request->noppjp,
                "debitur"  => $request->debitur,
                "lokasi"   => $request->lokasi,
                "surveyor" => $request->surveyor,
                "tgl_inspeksi" => $request->tanggal,
                "progres" => "On Progress"
            ]);
        }

        if ($request->tipe == 'selesai') {
            ProyekSelesai::create([
                "noppjp"   => $request->noppjp,
                "debitur"  => $request->debitur,
                "lokasi"   => $request->lokasi,
                "surveyor" => $request->surveyor,
                "tgl_selesai" => $request->tanggal,
                "progres" => "Selesai"
            ]);
        }

        if ($request->tipe == 'pending') {
            ProyekPending::create([
                "noppjp"   => $request->noppjp,
                "debitur"  => $request->debitur,
                "lokasi"   => $request->lokasi,
                "surveyor" => $request->surveyor,
                "tgl_inspeksi" => $request->tanggal,
                "alasan" => $request->alasan,
                "progres" => "Pending"
            ]);
        }

        return back()->with("success", "Proyek berhasil ditambahkan");
    }


    public function workingPaper()
    {
        return view('surveyor.workingpaper');
    }




}
