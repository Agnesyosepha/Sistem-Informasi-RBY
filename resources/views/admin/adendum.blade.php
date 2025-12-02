@extends('layouts.app')

@section('title', 'Adendum')

@section('content')
<h1><i class="fas fa-file-contract"></i> Daftar Adendum</h1>
<p>Berikut adalah daftar adendum yang telah diajukan.</p>

<!-- Filter dan Pencarian -->
<div style="display: flex; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('admin.adendum') }}" style="display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Cari berdasarkan nomor atau proyek..." 
               value="{{ request('search') }}" 
               style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; width: 300px;">
        <button type="submit" style="background: #007BFF; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
            <i class="fas fa-search"></i> Cari
        </button>
        @if(request('search'))
        <a href="{{ route('admin.adendum') }}" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; display: inline-block;">
            <i class="fas fa-times"></i> Reset
        </a>
        @endif
    </form>
    
    <!-- Form Filter Bulan -->
    <form method="GET" action="{{ route('admin.adendum') }}" style="display: flex; gap: 10px;">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <select name="bulan" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            <option value="">Semua Bulan</option>
            @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                </option>
            @endfor
        </select>
        <button type="submit" style="background: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
            <i class="fas fa-filter"></i> Filter
        </button>
        @if(request('bulan'))
        <a href="{{ route('admin.adendum', ['search' => request('search')]) }}" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; display: inline-block;">
            <i class="fas fa-times"></i> Reset
        </a>
        @endif
    </form>
</div>

<!-- Tabel -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse;">
        <thead style="background:#ABE7B2; color:black;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor</th>
                <th style="padding:10px; text-align:left;">Proyek</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Deskripsi</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($adendum as $a)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $a->nomor }}</td>
                    <td style="padding:10px;">{{ $a->proyek }}</td>
                    <td style="padding:10px;">{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</td>
                    <td style="padding:10px;">{{ $a->deskripsi }}</td>
                    <td style="padding:10px; font-weight:bold; text-align:center;">
                        <span class="status-label" data-status="{{ $a->status }}">
                            {{ $a->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding:10px; text-align:center;">Tidak ada data adendum yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($adendum->count() > 0)
    <div style="margin-top: 15px; text-align: right; color: #6c757d;">
        Menampilkan {{ $adendum->count() }} dari {{ $totalAdendum }} data
    </div>
    @endif
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
