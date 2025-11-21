@extends('layouts.app')

@section('title', 'Draft Laporan')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Draft Laporan</h1>
    <p>Daftar draft laporan penilaian yang sedang dalam tahap penyusunan, review, atau sudah disetujui.</p>

    <!-- Tabel Laporan -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Nomor PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Proposal</th>
                <th style="padding:10px; text-align:left;">Tanggal Pengiriman</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $item)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $item->pemberi_tugas }}</td>
                    <td style="padding:10px;">{{ $item->nomor_ppjp }}</td>
                    <td style="padding:10px;">{{ $item->tgl_proposal }}</td>
                    <td style="padding:10px;">{{ $item->tgl_pengiriman }}</td>

                    <td style="padding:10px; font-weight:bold; text-align:center;">
                      <span class="status-label" data-status="{{ $item->status }}">
                            {{ $item->status }}
                        </span>
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

        if (value === "Disetujui") {
            label.style.color = "green";
        } 
        else if (value === "Final") {
            label.style.color = "orange";
        } 
        else if (value === "Pending") {
            label.style.color = "blue";
        } 
        else {
            label.style.color = "red"; // default untuk status lain
        }
    });
});
</script>
@endsection
