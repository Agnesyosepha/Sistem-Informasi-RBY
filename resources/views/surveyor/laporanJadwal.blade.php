@extends('layouts.app')

@section('title', 'Laporan Jadwal Survey')

@section('content')
<h1><i class="fas fa-calendar-check"></i> Laporan Jadwal Survey</h1>
<p>Laporan jadwal survei yang telah selesai dilaksanakan.</p>

<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">No</th>
                <th style="padding:10px; text-align:left;">Nama Surveyor</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Deskripsi</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporanJadwal as $index => $item)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $index + 1 }}</td>
                    <td style="padding:10px;">{{ $item->nama_surveyor }}</td>
                    <td style="padding:10px;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td style="padding:10px;">{{ $item->lokasi }}</td>
                    <td style="padding:10px;">{{ $item->deskripsi }}</td>
                    <td style="padding:10px;">
                        <span style="background:#28a745; color:white; padding:5px 10px; border-radius:5px;">Selesai</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:15px;">Belum ada laporan jadwal survey</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection