@extends('layouts.app')

@section('title', 'Draft Resume')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Draft Resume</h1>
    <p>Daftar draft resume hasil penilaian aset dari berbagai proyek yang sedang disusun atau telah dikirim.</p>

    <!-- Filter dan Pencarian -->
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('admin.draftResume') }}" style="display: flex; gap: 10px;">
            <input type="text" name="search" placeholder="Cari berdasarkan pemberi tugas atau objek penilaian..." 
                   value="{{ request('search') }}" 
                   style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; width: 300px;">
            <button type="submit" style="background: #007BFF; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.draftResume') }}" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; display: inline-block;">
                <i class="fas fa-times"></i> Reset
            </a>
            @endif
        </form>
        
        <!-- Form Filter Bulan -->
        <form method="GET" action="{{ route('admin.draftResume') }}" style="display: flex; gap: 10px;">
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
            <a href="{{ route('admin.draftResume', ['search' => request('search')]) }}" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; display: inline-block;">
                <i class="fas fa-times"></i> Reset
            </a>
            @endif
        </form>
    </div>

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
            @forelse($resume as $index => $ar)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $ar->pemberi_tugas }}</td>
                    <td style="padding:10px;">{{ $ar->objek_penilaian }}</td>
                    <td style="padding:10px;">
                        <ul style="margin:0; padding-left:15px;">
                            <li><strong>Nilai Pasar:</strong> Rp {{ number_format($ar->nilai_pasar, 0, ',', '.') }}</li>
                            <li><strong>Nilai Wajar:</strong> Rp {{ number_format($ar->nilai_wajar, 0, ',', '.') }}</li>
                            <li><strong>Nilai Likuidasi:</strong> Rp {{ number_format($ar->nilai_likuidasi, 0, ',', '.') }}</li>
                        </ul>
                    </td>
                    <td style="padding:10px;">{{ \Carbon\Carbon::parse($ar->tanggal)->format('d M Y') }}</td>
                    <td style="padding:10px;">{{ \Carbon\Carbon::parse($ar->tanggal_pengiriman)->format('d M Y') }}</td>
                    <td style="padding:10px; font-weight:bold; text-align:center;">
                        <span class="status-label" data-status="{{ $ar->status }}">
                            {{ $ar->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding:10px; text-align:center;">Tidak ada data draft resume yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($resume->count() > 0)
    <div style="margin-top: 15px; text-align: right; color: #6c757d;">
        Menampilkan {{ $resume->count() }} dari {{ $totalResume }} data
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
            label.style.color = "orange";
        } 
        else if (value === "Terkirim") {
            label.style.color = "blue";
        } 
        else if (value === "Pending") {
            label.style.color = "red";
        }
    });
});
</script>
@endsection
