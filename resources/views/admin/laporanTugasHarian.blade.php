@extends('layouts.app')

@section('title', 'Laporan Tugas Harian')

@section('content')

<style>
    /* Container tahapan */
    .tahapan-box {
        padding: 14px;
        border: 1px solid #e0e0e0;
        background: #ffffff;
        border-radius: 10px;
        margin-bottom: 12px;
        transition: 0.3s ease;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }

    .tahapan-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .tahapan-title {
        font-size: 15px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tahapan-title i {
        color: #F9B572;
    }

    .file-section {
        margin-top: 8px;
        background: #fafafa;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #f0f0f0;
    }

    .file-section p {
        margin: 0;
        font-weight: 600;
        font-size: 14px;
    }

    .file-section a {
        margin-top: 5px;
    }

    .no-file {
        color: #c0392b;
        font-size: 13px;
        font-weight: 600;
    }

    /* Row dropdown */
    tr.dropdown-row td {
        background: #fff8f0;
        border-top: 2px solid #F9B572;
        border-bottom: 2px solid #F9B572;
    }
</style>

<h1><i class="fas fa-tasks"></i> Laporan Tugas Harian</h1>
<p>Daftar tugas yang sudah final, lengkap dengan tahapan dan file.</p>

<form method="GET" action="{{ route('admin.laporanTugasHarian') }}" 
      style="margin-bottom:20px; display:flex; gap:10px; align-items:center;">

    {{-- Search --}}
    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Cari ..."
        style="padding:10px 15px; width:280px; border-radius:8px; border:1px solid #ccc;
        outline:none; transition:0.3s;">

    {{-- Filter Bulan --}}
    <select name="bulan" id="bulan"
        style="padding:10px 15px; border-radius:8px; border:1px solid #ccc;">
        <option value="">-- Semua Bulan --</option>
        @foreach(range(1,15) as $m)
            <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
            </option>
        @endforeach
    </select>

    <button type="submit"
        style="padding:10px 18px; background:#F9B572; color:black; border:none; 
        border-radius:8px; cursor:pointer; font-weight:600;">
        Filter
    </button>

    @if(request('search') || request('bulan'))
        <a href="{{ route('admin.laporanTugasHarian') }}"
            style="padding:10px 18px; background:#777; color:white; border-radius:8px; 
            text-decoration:none; font-weight:600;">
            Reset
        </a>
    @endif
</form>

<div class="dashboard-card" style="margin-top:30px;">
<table style="width:100%; border-collapse: collapse; margin-top:15px;">
    <thead style="background:#F9B572; color:black;">
        <tr>
            <th style="padding:10px; text-align:left;">No</th>
            <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
            <th style="padding:10px; text-align:left;">Debitur</th>
            <th style="padding:10px; text-align:left;">No. PPJP</th>
            <th style="padding:10px; text-align:left;">Tanggal Survei</th>
            <th style="padding:10px; text-align:left;">Tim Lapangan</th>
            <th style="padding:10px; text-align:left;">Status</th>
        </tr>
    </thead>


    <tbody>
        @foreach($tugasFinal as $tugas)

        <!-- ROW UTAMA -->
        <tr class="tugas-row" style="cursor:pointer; border-bottom:1px solid #ddd;" 
            onclick="toggleTahapan({{ $tugas->id }})">
            <td style="padding:12px; text-align:center;">
                {{ $loop->iteration }}
            </td>
            <td style="padding:10px;">{{ $tugas->pemberi_tugas }}</td>
            <td style="padding:10px;">{{ $tugas->debitur }}</td>
            <td style="padding:10px;">{{ $tugas->no_ppjp }}</td>
            <td style="padding:10px;">{{ $tugas->tanggal_survei }}</td>
            <td style="padding:10px;">{{ $tugas->tim_lapangan }}</td>
            <td style="padding:10px; font-weight:600; color:green;">Selesai</td>
        </tr>

        <!-- ROW DROPDOWN TAHAPAN -->
        <tr id="tahapan-{{ $tugas->id }}" class="dropdown-row" style="display:none;">
            <td colspan="6" style="padding:20px;">
                <h4 style="text-align:center; margin-bottom:20px;">Tahapan Pekerjaan</h4>

                @php
                    $tahapanData = [
                        1 => 'Pengumpulan Data',
                        2 => 'Pembuatan Invoice DP',
                        3 => 'Penjadwalan Inspeksi',
                        4 => 'Inspeksi',
                        5 => 'Proses Analisa',
                        6 => 'Review Nilai',
                        7 => 'Kirim Draft Resume',
                        8 => 'Draft Laporan',
                        9 => 'Final',
                        10 => 'Review',
                        11 => 'Review Approval',
                        12 => 'Invoice Pelunasan',
                        13 => 'Nomor Laporan',
                        14 => 'Laporan Lengkap',
                        15 => 'Rangkap 3 LPA dan Pengiriman Dokumen',
                    ];
                @endphp

                @foreach($tahapanData as $id => $label)
                    @php
                        $mainFile = $tugas->files->where('tahapan_id', $id)->where('is_revision', 0)->first();
                        $revisionFile = $tugas->files->where('tahapan_id', $id)->where('is_revision', 1)->first();
                    @endphp

                    <div class="tahapan-box">
                        <div class="tahapan-title">
                            <i class="fas fa-check-circle"></i>
                            {{ $id }}. {{ $label }}
                        </div>

                        <div class="file-section">
                            <p><strong>File Utama:</strong></p>
                            @if($mainFile)
                                <a href="{{ route('admin.tugas-harian.downloadFile', $mainFile->id) }}"
                                    class="btn btn-sm btn-primary">
                                    Download {{ $mainFile->filename }}
                                </a>
                            @else
                                <span class="no-file">Belum ada file</span>
                            @endif
                        </div>

                        <div class="file-section" style="margin-top:10px;">
                            <p><strong>File Revisi:</strong></p>
                            @if($revisionFile)
                                <a href="{{ route('admin.tugas-harian.downloadFile', $revisionFile->id) }}"
                                    class="btn btn-sm btn-warning">
                                    Download Revisi {{ $revisionFile->filename }}
                                </a>
                            @else
                                <span class="no-file">Belum ada file revisi</span>
                            @endif
                        </div>
                    </div>
                @endforeach

            </td>
        </tr>

        @endforeach
    </tbody>
</table>
</div>

<script>
function toggleTahapan(id) {
    const row = document.getElementById('tahapan-' + id);
    row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
}
</script>

@endsection
