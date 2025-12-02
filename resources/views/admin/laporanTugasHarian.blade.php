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
    <style>
    /* ============================
       STYLE FILTER (BULAN)
    ============================ */
    .filter-box {
        padding: 15px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        border-left: 5px solid #F9B572;
    }

    .filter-box label {
        font-weight: 700;
        color: #444;
        font-size: 15px;
        white-space: nowrap;
    }

    .filter-box select {
        height: 40px;
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 5px 10px;
        transition: 0.2s ease;
    }

    .filter-box select:focus {
        border-color: #F9B572;
        box-shadow: 0 0 4px rgba(249,181,114,0.6);
    }

    .filter-box .btn-primary {
        background: #F9B572;
        border: none;
        height: 40px;
        padding: 0 18px;
        font-weight: 600;
        border-radius: 8px;
        transition: 0.3s ease;
        color: black;
    }

    .filter-box .btn-primary:hover {
        background: #e29e50;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .filter-box {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .filter-box select,
        .filter-box .btn-primary {
            width: 100%;
        }
    }
</style>


<h1><i class="fas fa-tasks"></i> Laporan Tugas Harian</h1>
<p>Daftar tugas yang sudah final, lengkap dengan tahapan dan file.</p>

<form method="GET" action="" class="filter-box">
    <label for="bulan">Filter Bulan Survei:</label>

    <select name="bulan" id="bulan" class="form-control">
        <option value="">-- Semua Bulan --</option>
        @foreach(range(1,12) as $m)
            <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-primary">Filter</button>
</form>

<div class="dashboard-card" style="margin-top:30px;">
<table style="width:100%; border-collapse: collapse; margin-top:15px;">
    <thead style="background:#F9B572; color:black;">
        <tr>
            <th style="padding:10px;">Pemberi Tugas</th>
            <th style="padding:10px;">Debitur</th>
            <th style="padding:10px;">No. PPJP</th>
            <th style="padding:10px;">Tanggal Survei</th>
            <th style="padding:10px;">Tim Lapangan</th>
            <th style="padding:10px;">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tugasFinal as $tugas)

        <!-- ROW UTAMA -->
        <tr class="tugas-row" style="cursor:pointer; border-bottom:1px solid #ddd;" 
            onclick="toggleTahapan({{ $tugas->id }})">
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
                        9 => 'Review/Final',
                        10 => 'Nomor Laporan',
                        11 => 'Laporan Rangkap',
                        12 => 'Pengiriman Dokumen',
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
