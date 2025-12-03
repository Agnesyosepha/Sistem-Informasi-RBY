@extends('layouts.app')

@section('title', 'EDP')

@section('content')
    <h1><i class="fas fa-file-signature"></i> Dashboard Reviewer</h1>
    <p>Ringkasan aktivitas Reviewer.</p>

    <div class="dashboard-cards">
        <a href="{{ route('reviewer.dokumenRevisi') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file-alt"></i> Dokumen Revisi</h3>
                <p><strong>Daftar dokumen yang sedang direvisi</strong></p>
            </div>
        </a>

        <a href="{{ route('reviewer.dokumenFinal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-check-circle"></i> Dokumen Final</h3>
                <p><strong>Daftar dokumen yang telah selesai direvisi</strong></p>
            </div>
        </a>
        <a href="{{ route('reviewer.tim') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-users"></i> Reviewer</h3>
                <p><strong>1 Staff</strong></p>
            </div>
        </a>
    </div>
    
    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-history"></i> Log Aktivitas</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">No. Laporan</th>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:center;">Staff EDP</th>
                    <th style="padding:10px; text-align:center;">Objek penilaian </th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse($logs as $index => $item)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $index + 1 }}</td>
                <td style="padding:10px;">{{ $item->tanggal }}</td>
                <td style="padding:10px;">{{ $item->pemberi_tugas }}</td>
                <td style="padding:10px;">{{ $item->staff_edp }}</td>
                <td style="padding:10px;">{{ $item->objek_penilaian }}</td>
                <td style="padding:10px; text-align:center; font-weight:600;
                    color: {{ $item->status == 'Selesai' ? 'green' : 'orange' }}">
                    {{ $item->status }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:10px; text-align:center; color:#777;">
                    Belum ada aktivitas.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
