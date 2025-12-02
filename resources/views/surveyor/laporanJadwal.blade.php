@extends('layouts.app')

@section('title', 'Laporan Jadwal Survey')

@section('content')
<h1><i class="fas fa-calendar-check"></i> Laporan Jadwal Survey</h1>
<p>Laporan jadwal survei yang telah selesai dilaksanakan.</p>
<form method="GET" action="{{ route('surveyor.laporanJadwal') }}" style="margin:20px 0; display:flex; gap:10px;">
    
    <input type="text" 
        name="search" 
        value="{{ request('search') }}" 
        placeholder="Cari ..."
        style="padding:8px; width:300px; border-radius:6px; border:1px solid #ccc;">

    <button type="submit"
        style="padding:8px 15px; background:#007BFF; color:white; border:none; border-radius:6px; cursor:pointer;">
        Search
    </button>

    @if(request('search'))
        <a href="{{ route('surveyor.laporanJadwal') }}"
            style="padding:8px 15px; background:#6c757d; color:white; border-radius:6px; text-decoration:none;">
            Reset
        </a>
    @endif
</form>

<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">No</th>
                <th style="padding:10px; text-align:left;">No. PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Survey</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Nama Penilai</th>
                <th style="padding:10px; text-align:left;">Adendum</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporanJadwal as $index => $item)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $index + 1 }}</td>
                    <td style="padding:10px;">{{ $item->no_ppjp }}</td>
                    <td style="padding:10px;">{{ \Carbon\Carbon::parse($item->tanggal_survey)->format('d M Y') }}</td>
                    <td style="padding:10px;">{{ $item->lokasi }}</td>
                    <td style="padding:10px;">{{ $item->objek_penilaian }}</td>
                    <td style="padding:10px;">{{ $item->pemberi_tugas }}</td>
                    <td style="padding:10px;">{{ $item->nama_penilai }}</td>
                    <td style="padding:10px;">{{ $item->adendum ?? '-' }}</td>
                    <td style="padding:10px;">
                        <span style="background:#28a745; color:white; padding:5px 10px; border-radius:5px;">Selesai</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:15px;">Belum ada laporan jadwal survey</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection