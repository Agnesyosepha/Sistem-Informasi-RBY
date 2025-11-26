@extends('superadmin.app2')

@section('title', 'Laporan Penilaian Superadmin')

@section('content')
<h1><i class="fas fa-file-alt"></i> Laporan Penilaian</h1>
<p>Daftar laporan hasil penilaian yang dikelola oleh Superadmin.</p>

<!-- Tombol Tambah Laporan -->
<button onclick="document.getElementById('modalTambah').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Laporan Penilaian
</button>

<!-- Modal Tambah Laporan -->
<div id="modalTambah" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);">

        <h2 style="margin-bottom:15px;">Tambah Laporan Penilaian</h2>

        <form action="{{ route('superadmin.admin.SAlaporanpenilaianfinal.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Nomor LPA</label>
            <input type="text" name="nomor_laporan" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Nama Debitur</label>
            <input type="text" name="klien" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Objek Penilaian</label>
            <input type="text" name="jenis_aset" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Lokasi</label>
            <input type="text" name="lokasi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Tanggal Laporan</label>
            <input type="date" name="tgl_laporan" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Softcopy (PDF)</label>
            <input type="file" name="softcopy" accept="application/pdf"
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

            <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalTambah').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                Batal
            </button>
        </form>

    </div>
</div>

<!-- Tabel Laporan Penilaian -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor LPA</th>
                <th style="padding:10px; text-align:left;">Nama Debitur</th>
                <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Tanggal Laporan</th>
                <th style="padding:10px; text-align:center;">Softcopy</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanPenilaian as $l)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $l->nomor_laporan }}</td>
                    <td style="padding:10px;">{{ $l->klien }}</td>
                    <td style="padding:10px;">{{ $l->jenis_aset }}</td>
                    <td style="padding:10px;">{{ $l->lokasi }}</td>
                    <td style="padding:10px;">{{ $l->tgl_laporan }}</td>
                    <td style="padding:10px; text-align:center;">
                        @if($l->softcopy)
                            <a href="{{ asset('storage/laporan/'.$l->softcopy) }}" 
                                target="_blank"
                                style="color:white; background:#007BFF; padding:5px 10px; border-radius:5px; text-decoration:none;">
                                PDF
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
