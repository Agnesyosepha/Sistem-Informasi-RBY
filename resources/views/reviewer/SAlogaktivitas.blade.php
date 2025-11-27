@extends('superadmin.app2')

@section('title', 'Log Aktivitas Reviewer')

@section('content')

<h1><i class="fas fa-history"></i> Log Aktivitas Reviewer</h1>
<p>Daftar log aktivitas yang dilakukan oleh Reviewer.</p>

<!-- Tombol Tambah -->
<button onclick="document.getElementById('modalTambahLog').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-bottom:20px;">
    + Tambah Log Aktivitas
</button>

<!-- Modal Form -->
<div id="modalTambahLog" style="
    display:none; position:fixed; z-index:1000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;
">
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);
    ">
        
        <h2 style="margin-bottom:15px;">Tambah Log Aktivitas</h2>

        <form action="{{ route('superadmin.reviewer.storeLog') }}" method="POST">
            @csrf

            <label>No. Laporan</label>
            <input type="text" name="no_laporan" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Tanggal</label>
            <input type="date" name="tanggal" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Pemberi Tugas</label>
            <input type="text" name="pemberi_tugas" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Staff EDP</label>
            <input type="text" name="staff_edp" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Objek Penilaian</label>
            <input type="text" name="objek_penilaian" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Status</label>
            <select name="status" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">
                <option value="On Progress">On Progress</option>
                <option value="Selesai">Selesai</option>
            </select>

            <button type="submit"
                style="background:#007bff; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalTambahLog').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:8px;">
                Batal
            </button>
        </form>
    </div>
</div>

<!-- CARD CONTAINER -->
<div class="dashboard-card" style="margin-top:30px;">
  <h3><i class="fas fa-history"></i> Log Aktivitas</h3>

<table style="width:100%; border-collapse:collapse; margin-top:25px; background:white; border-radius:8px; overflow:hidden;">
    <thead style="background:#007BFF; color:white;">
        <tr>
            <th style="padding:12px 14px; text-align:left; width:60px;">No</th>
            <th style="padding:12px 14px; text-align:left;">No. Laporan</th>
            <th style="padding:12px 14px; text-align:left;">Tanggal</th>
            <th style="padding:12px 14px; text-align:left;">Pemberi Tugas</th>
            <th style="padding:12px 14px; text-align:left;">Staff EDP</th>
            <th style="padding:12px 14px; text-align:left;">Objek Penilaian</th>
            <th style="padding:12px 14px; text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse($logs as $index => $log)
        <tr style="border-bottom:1px solid #e5e5e5;">
            <td style="padding:12px 14px;">{{ $index + 1 }}</td>
            <td style="padding:12px 14px;">{{ $log->no_laporan }}</td>
            <td style="padding:12px 14px;">{{ $log->tanggal }}</td>
            <td style="padding:12px 14px;">{{ $log->pemberi_tugas }}</td>
            <td style="padding:12px 14px;">{{ $log->staff_edp }}</td>
            <td style="padding:12px 14px;">{{ $log->objek_penilaian }}</td>

            <td style="padding:12px 14px;">
                @if($log->status === 'Selesai')
                    <span style="padding:10px; font-weight:600; color:green;">Selesai</span>
                @else
                    <span style="padding:10px; font-weight:600; color:orange;">On Progress</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align:center; padding:18px; color:#777;">Belum ada log aktivitas.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection
