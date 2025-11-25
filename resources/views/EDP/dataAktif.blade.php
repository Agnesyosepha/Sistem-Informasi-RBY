@extends('layouts.app')

@section('title', 'Data Aktif')

@section('content')
<h1><i class="fas fa-server"></i> Data Aktif</h1>
<p>Daftar data aktif yang sedang diproses.</p>

<div class="dashboard-card" style="margin-top:30px;">
<table style="width:100%; border-collapse: collapse; margin-top:15px;">
    <thead style="background:#239BA7; color:white;">
        <tr>
            <th style="padding:10px; text-align:left;">Tanggal</th>
            <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
            <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
            <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
            <th style="padding:10px; text-align:left;">Surveyor</th>
            <th style="padding:10px; text-align:left;">Lokasi</th>
            <th style="padding:10px; text-align:left;">Objek Penilaian</th>
            <th style="padding:10px; text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($dataAktif as $data)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px; text-align:left;">{{ $data['tanggal'] }}</td>
            <td style="padding:10px; text-align:left;">{{ $data['jenis'] }}</td>
            <td style="padding:10px; text-align:left;">{{ $data['pemberi'] }}</td>
            <td style="padding:10px; text-align:left;">{{ $data['pengguna'] }}</td>

            {{-- KOLOM BARU --}}
            <td style="padding:10px; text-align:left;">
                {{ $data['surveyor'] ?? '-' }}
            </td>

            <td style="padding:10px; text-align:left;">
                {{ $data['lokasi'] ?? '-' }}
            </td>

            <td style="padding:10px; text-align:left;">
                {{ $data['objek'] ?? '-' }}
            </td>

            {{-- STATUS WARNA --}}
            <td style="
                padding:10px;
                text-align:left;
                font-weight:600; 
                color:
                    @if(($data['status_progres'] ?? '') === 'Selesai')
                        #28a745
                    @elseif(($data['status_progres'] ?? '') === 'Reviewer')
                        #007bff
                    @elseif(($data['status_progres'] ?? '') === 'Proses')
                        #ffc107
                    @else
                        #dc3545
                    @endif
            ">
                {{ $data['status_progres'] ?? 'Proses' }}
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
