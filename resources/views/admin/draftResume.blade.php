@extends('layouts.app')

@section('title', 'Draft Resume')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Draft Resume</h1>
    <p>Daftar draft resume hasil penilaian aset dari berbagai proyek yang sedang disusun atau telah dikirim.</p>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#CDE5FF; color:black;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                <th style="padding:10px; text-align:left;">Total Nilai</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Tanggal Pengiriman</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resume as $ar)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $ar['pemberi_tugas'] }}</td>
                    <td style="padding:10px;">{{ $ar['objek_penilaian'] }}</td>
                    <td style="padding:10px;">
                        <ul style="margin:0; padding-left:15px;">
                            <li><strong>Nilai Pasar:</strong> Rp {{ number_format($ar['nilai_pasar'], 0, ',', '.') }}</li>
                            <li><strong>Nilai Wajar:</strong> Rp {{ number_format($ar['nilai_wajar'], 0, ',', '.') }}</li>
                            <li><strong>Nilai Likuidasi:</strong> Rp {{ number_format($ar['nilai_likuidasi'], 0, ',', '.') }}</li>
                        </ul>
                    </td>
                    <td style="padding:10px;">{{ $ar['tanggal'] }}</td>
                    <td style="padding:10px;">{{ $ar['tanggal_pengiriman'] }}</td>
                    <td style="padding:10px; font-weight:bold; text-align:center;">
                        <span class="status-label" data-status="{{ $ar->status }}">
                            {{ $ar->status }}
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
        else if (value === "Terkirim") {
            label.style.color = "blue";
        } 
        else {
            label.style.color = "red"; // default untuk status lain
        }
    });
});
</script>
@endsection
