@extends('layouts.app')

@section('title', 'Data Aktif')

@section('content')
<h1><i class="fas fa-server"></i> Data Aktif</h1>
<p>Daftar data aktif yang sedang diproses.</p>

<table style="width:100%; border-collapse: collapse; margin-top:15px;">
    <thead style="background:#007BFF; color:white;">
        <tr>
            <th style="padding:10px; text-align:left;">Tanggal</th>
            <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
            <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
            <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
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
            <td style="
                padding:10px;
                text-align:left;
                font-weight:600; 
                color: 
                    @if($data['status'] == 'Selesai')
                        #28a745
                    @elseif($data['status'] == 'Proses')
                        #ffc107
                    @else
                        #dc3545
                    @endif
            ">
                {{ $data['status'] }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
