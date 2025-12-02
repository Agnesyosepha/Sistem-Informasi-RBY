@extends('layouts.app')

@section('title', 'Proposal')

@section('content')
    <h1><i class="fas fa-file-invoice"></i> Daftar Proposal</h1>
    <p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <form method="GET" action="{{ route('admin.proposal') }}" style="margin-bottom:20px;">
    <input type="text" name="search" value="{{ request('search') }}" 
           placeholder="Cari ..." 
           style="padding:8px; width:250px; border:1px solid #ccc; border-radius:5px;">

    <select name="bulan" style="padding:8px; border:1px solid #ccc; border-radius:5px;">
        <option value="">-- Bulan Pengajuan --</option>
        @for($i=1; $i<=12; $i++)
            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
        @endfor
    </select>

    <button type="submit" 
            style="padding:8px 15px; background:#239BA7; color:white; border:none; border-radius:5px; cursor:pointer;">
        Filter
    </button>

    <a href="{{ route('admin.proposal') }}" 
       style="padding:8px 15px; background:#777; color:white; border-radius:5px; margin-left:5px; text-decoration:none;">
       Reset
    </a>
</form>


    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#239BA7; color:white;">
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
        else if (value === "Menunggu Review") {
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
