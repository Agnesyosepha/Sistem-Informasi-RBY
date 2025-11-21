@extends('layouts.app')

@section('title', 'Proposal')

@section('content')
    <h1><i class="fas fa-lightbulb"></i> Daftar Proposal</h1>
    <p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_pengajuan'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_berakhir'] }}</td>
                        <td style="padding:10px; text-align:center;">
                            <span class="status-label" data-status="{{ $p->status }}">
                                {{ $p->status }}
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
