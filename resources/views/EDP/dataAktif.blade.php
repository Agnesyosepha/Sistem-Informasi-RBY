@extends('layouts.app')

@section('title', 'Data Aktif')

@section('content')
<h1><i class="fas fa-server"></i> Data Aktif</h1>
<p>Daftar data aktif yang sedang diproses.</p>
<form method="GET" action="{{ route('edp.dataAktif') }}" 
      style="margin:20px 0; display:flex; gap:10px;">

    <input type="text" 
           name="search" 
           value="{{ request('search') }}" 
           placeholder="Cari ..."
           style="padding:8px; width:300px; border-radius:6px; border:1px solid #ccc;">

    <button type="submit"
        style="padding:8px 15px; background:#239BA7; color:white; border:none; border-radius:6px; cursor:pointer;">
        Search
    </button>

    @if(request('search'))
        <a href="{{ route('edp.dataAktif') }}"
            style="padding:8px 15px; background:#6c757d; color:white; border-radius:6px; text-decoration:none;">
            Reset
        </a>
    @endif

</form>

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
