@extends('layouts.app')

@section('title', 'Adendum')

@section('content')
<h1><i class="fas fa-file-contract"></i> Daftar Adendum</h1>
<p>Berikut adalah daftar adendum yang telah diajukan.</p>



<!-- Tabel -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor</th>
                <th style="padding:10px; text-align:left;">Proyek</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Deskripsi</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adendum as $a)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $a->nomor }}</td>
                    <td style="padding:10px;">{{ $a->proyek }}</td>
                    <td style="padding:10px;">{{ $a->tanggal }}</td>
                    <td style="padding:10px;">{{ $a->deskripsi }}</td>
                    <td style="padding:10px; font-weight:bold; text-align:center;">
                        <span class="status-label" data-status="{{ $a->status }}">
                            {{ $a->status }}
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
        else if (value === "Menunggu Persetujuan") {
            label.style.color = "orange";
        } 
        else if (value === "Direvisi") {
            label.style.color = "blue";
        } 
        else if (value === "Proses") {
            label.style.color = "blue";
        }
    });
});
</script>
@endsection
