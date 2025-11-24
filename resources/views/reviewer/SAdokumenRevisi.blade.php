@extends('superadmin.app2')

@section('title', 'Dokumen Revisi')

@section('content')
<h1><i class="fas fa-file-alt"></i> Dokumen Revisi</h1>
<p>Daftar dokumen yang sedang direvisi oleh tim reviewer.</p>

<!-- Tombol Tambah -->
<button onclick="document.getElementById('modalTambahDokumen').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-bottom:20px;">
    + Tambah Dokumen
</button>

<!-- Modal Form -->
<div id="modalTambahDokumen" style="
    display:none; position:fixed; z-index:1000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;
">
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);
    ">
        
        <h2 style="margin-bottom:15px;">Tambah Dokumen Revisi</h2>

        <form action="{{ route('superadmin.reviewer.storeDokumenRevisi') }}" method="POST">
            @csrf

            <label>Nama Dokumen</label>
            <input type="text" name="nama" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Tanggal Upload</label>
            <input type="date" name="tanggal" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Reviewer</label>
            <input type="text" name="reviewer" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Status</label>
            <select name="status" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">
                <option value="Dalam Revisi">Dalam Revisi</option>
                <option value="Selesai">Selesai</option>
                <option value="Ditolak">Ditolak</option>
            </select>

            <button type="submit"
                style="background:#007bff; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalTambahDokumen').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:8px;">
                Batal
            </button>
        </form>
    </div>
</div>


<div class="dashboard-card" style="margin-top:30px;">
  <h3><i class="fas fa-file"></i> Dokumen Revisi</h3>
<table style="width:100%; border-collapse:collapse; margin-top:25px; background:white; border-radius:8px; overflow:hidden;">
    <thead style="background:#007BFF; color:white;">
        <tr>
            <th style="padding:12px 14px; text-align:left; width:60px;">No</th>
            <th style="padding:12px 14px; text-align:left;">Nama Dokumen</th>
            <th style="padding:12px 14px; text-align:left;">Tanggal Upload</th>
            <th style="padding:12px 14px; text-align:left;">Reviewer</th>
            <th style="padding:12px 14px; text-align:left;">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dokumenRevisi as $index => $dok)
        <tr style="border-bottom:1px solid #e5e5e5;">
            <td style="padding:12px 14px;">{{ $index + 1 }}</td>
            <td style="padding:12px 14px;">{{ $dok['nama'] }}</td>
            <td style="padding:12px 14px;">{{ $dok['tanggal'] }}</td>
            <td style="padding:12px 14px;">{{ $dok['reviewer'] }}</td>
            <td style="padding:12px 14px;">
                @if($dok['status'] === 'Selesai')
                    <span style="padding:10px; font-weight:600; color:green;">Selesai</span>
                @elseif($dok['status'] === 'Dalam Revisi')
                    <span style="padding:10px; font-weight:600; color:orange;">Dalam Revisi</span>
                @else
                    <span style="padding:10px; font-weight:600; color:red;">Ditolak</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center; padding:18px; color:#777;">Belum ada dokumen revisi.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
