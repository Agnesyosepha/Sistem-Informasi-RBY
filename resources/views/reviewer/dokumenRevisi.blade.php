@extends('layouts.app')

@section('title', 'Dokumen Revisi')

@section('content')
<h1><i class="fas fa-file-alt"></i> Dokumen Revisi</h1>
<p>Daftar dokumen yang sedang direvisi oleh tim reviewer.</p>

<div class="dashboard-card" style="margin-top:30px;">
  <h3><i class="fas fa-file"></i> Dokumen Revisi</h3>
<table style="width:100%; border-collapse:collapse; margin-top:25px; background:white; border-radius:8px; overflow:hidden;">
    <thead style="background:#239BA7; color:white;">
        <tr>
            <th style="padding:12px 14px; text-align:left; width:60px;">No</th>
            <th style="padding:12px 14px; text-align:left;">Nama Dokumen</th>
            <th style="padding:12px 14px; text-align:left;">Tanggal Upload</th>
            <th style="padding:12px 14px; text-align:left;">Reviewer</th>
            <th style="padding:12px 14px; text-align:left;">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dokumenRevisi as $index => $dok)
        <tr style="border-bottom:1px solid #e5e5e5;">
            <td style="padding:12px 14px;">{{ $index + 1 }}</td>
            <td style="padding:12px 14px;">{{ $dok['nama'] }}</td>
            <td style="padding:12px 14px;">{{ $dok['tanggal'] }}</td>
            <td style="padding:12px 14px;">{{ $dok['reviewer'] }}</td>
            <td style="padding:12px 14px;">
                @if($dok['status'] === 'Selesai')
                    <span style="padding:10px; font-weight:600; color:green;">Selesai</span>
                @elseif($dok['status'] === 'Dalam Revisi')
                    <span style="padding:10px; font-weight:600; color:orange;">Dalam Revisi</span>
                @else
                    <span style="padding:10px; font-weight:600; color:red;">Ditolak</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center; padding:18px; color:#777;">Belum ada dokumen revisi.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
