@extends('layouts.app')

@section('title', 'Draft Laporan')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Draft Laporan</h1>
    <p>Daftar draft laporan penilaian yang sedang dalam tahap penyusunan, review, atau sudah disetujui.</p>

    <!-- Filter dan Pencarian -->
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('admin.draftLaporan') }}" style="display: flex; gap: 10px;">
            <input type="text" name="search" placeholder="Cari berdasarkan pemberi tugas atau nomor PPJP..." 
                   value="{{ request('search') }}" 
                   style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; width: 300px;">
            <button type="submit" style="background: #007BFF; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.draftLaporan') }}" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; display: inline-block;">
                <i class="fas fa-times"></i> Reset
            </a>
            @endif
        </form>
        
        <!-- Form Filter Bulan -->
        <form method="GET" action="{{ route('admin.draftLaporan') }}" style="display: flex; gap: 10px;">
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
            <a href="{{ route('admin.draftLaporan', ['search' => request('search')]) }}" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; display: inline-block;">
                <i class="fas fa-times"></i> Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Tabel Laporan -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#C0C9EE; color:black;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Nomor PPJP</th>
                    <th style="padding:10px; text-align:left;">Tanggal Proposal</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengiriman</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $index => $item)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $item->pemberi_tugas }}</td>
                        <td style="padding:10px;">{{ $item->nomor_ppjp }}</td>
                        <td style="padding:10px;">{{ \Carbon\Carbon::parse($item->tgl_proposal)->format('d M Y') }}</td>
                        <td style="padding:10px;">{{ \Carbon\Carbon::parse($item->tgl_pengiriman)->format('d M Y') }}</td>

                        <td style="padding:10px; font-weight:bold; text-align:center;">
                          <span class="status-label" data-status="{{ $item->status }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:10px; text-align:center;">Tidak ada data draft laporan yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($laporan->count() > 0)
        <div style="margin-top: 15px; text-align: right; color: #6c757d;">
            Menampilkan {{ $laporan->count() }} dari {{ $totalLaporan }} data
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
        else if (value === "Final") {
            label.style.color = "blue";
        } 
        else if (value === "Pending") {
            label.style.color = "orange";
        } 
        else if (value === "Ditolak") {
            label.style.color = "red";
        } 
    });
});
</script>
@endsection
