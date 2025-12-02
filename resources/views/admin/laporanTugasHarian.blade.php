@extends('layouts.app')

@section('title', 'Laporan Tugas Harian')

@section('content')
<h1><i class="fas fa-tasks"></i> Laporan Tugas Harian</h1>
<p>Daftar tugas yang sudah final, lengkap dengan tahapan dan file.</p>

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
        <tr id="tahapan-{{ $tugas->id }}" style="display:none; background:#fafafa;">
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

                    <div style="padding:10px; border:1px solid #ddd; margin-bottom:10px; border-radius:6px;">
                        <strong>{{ $id }}. {{ $label }}</strong>

                        <div style="margin-top:8px;">
                            <p style="margin:0;"><strong>File Utama:</strong></p>

                            @if($mainFile)
                                <a href="{{ route('admin.tugas-harian.downloadFile', $mainFile->id) }}"
                                    class="btn btn-sm btn-primary" style="margin-top:5px;">
                                    Download {{ $mainFile->filename }}
                                </a>
                            @else
                                <span style="color:red;">Belum ada file</span>
                            @endif
                        </div>

                        <div style="margin-top:10px;">
                            <p style="margin:0;"><strong>File Revisi:</strong></p>

                            @if($revisionFile)
                                <a href="{{ route('admin.tugas-harian.downloadFile', $revisionFile->id) }}"
                                    class="btn btn-sm btn-warning" style="margin-top:5px;">
                                    Download Revisi {{ $revisionFile->filename }}
                                </a>
                            @else
                                <span style="color:red;">Belum ada file revisi</span>
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
