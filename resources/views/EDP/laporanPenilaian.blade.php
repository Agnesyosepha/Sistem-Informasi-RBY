@extends('layouts.app')

@section('title', 'Laporan Penilaian')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Laporan Penilaian-Final</h1>
    <p>Daftar laporan hasil penilaian yang telah selesai diproses.</p>

    <form method="GET" action="" class="search-container"
    style="display:flex; align-items:center; gap:10px; margin:25px 0;">

    <!-- SEARCH -->
    <div style="
        display:flex; align-items:center; background:#fff; 
        border:1px solid #d0d7de; border-radius:8px; padding:6px 12px;
        box-shadow:0 1px 2px rgba(0,0,0,0.06);
    ">
        <i class="fas fa-search" style="color:#6c757d; margin-right:8px;"></i>
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari ..."
            style="border:none; outline:none; font-size:14px; width:220px;">
    </div>

    <!-- FILTER BULAN -->
    <select name="bulan" style="
        padding:8px 12px; border-radius:8px; 
        border:1px solid #d0d7de; font-size:14px;">
        <option value="">-- Semua Bulan --</option>

        @foreach(range(1,12) as $b)
            <option value="{{ $b }}" 
                {{ request('bulan') == $b ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $b)->format('F') }}
            </option>
        @endforeach
    </select>

    <!-- TOMBOL FILTER -->
    <button type="submit"
        style="background:#ABE7B2; color:black; border:none; 
        padding:8px 18px; border-radius:8px; cursor:pointer; font-size:14px;
        box-shadow:0 1px 3px rgba(0,0,0,0.15);">
        Filter
    </button>

    @if(request()->has('search') || request()->has('bulan'))
        <a href="{{ url()->current() }}"
            style="background:#6c757d; color:white; padding:8px 18px;
            border-radius:8px; text-decoration:none; font-size:14px;">
            Reset
        </a>
    @endif
</form>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#ABE7B2; color:black;">
            <tr>
                <th style="padding:10px; text-align:left;">No</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Jenis</th>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Pengguna Jasa</th>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                <th style="padding:10px; text-align:left;">Status</th>
                <th style="padding:10px; text-align:center;">Softcopy</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanPenilaian as $laporan)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px; text-align:center;">
                        {{ $loop->iteration }}
                    </td>
                    <td style="padding:10px;">{{ $laporan->tanggal }}</td>
                    <td style="padding:10px;">{{ $laporan->jenis }}</td>
                    <td style="padding:10px;">{{ $laporan->pemberi }}</td>
                    <td style="padding:10px;">{{ $laporan->pengguna }}</td>
                    <td style="padding:10px;">{{ $laporan->surveyor }}</td>
                    <td style="padding:10px;">{{ $laporan->lokasi }}</td>
                    <td style="padding:10px;">{{ $laporan->objek }}</td>
                    <td style="padding:10px;">
                        <span class="status-label" data-status="{{ $laporan->status }}">
                            {{ $laporan->status }}
                        </span>
                    </td>
                    <td style="padding:10px; text-align:center;">
                        @if($laporan->softcopy)
                            <a href="{{ asset('storage/laporan/'.$laporan->softcopy) }}" target="_blank"
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

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".status-label").forEach(function(label) {
        const value = label.getAttribute("data-status");

        if (value === "Selesai") {
            label.style.color = "green";
        } 
        else if (value === "Proses") {
            label.style.color = "orange";
        } 
        else if (value === "Revisi") {
            label.style.color = "red";
        }
    });
});
</script>
@endsection
