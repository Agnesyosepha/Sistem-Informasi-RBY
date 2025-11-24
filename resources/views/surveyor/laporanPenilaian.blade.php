@extends('layouts.app')

@section('title', 'Laporan Penilaian')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Laporan Penilaian-Final</h1>
    <p>Daftar laporan hasil penilaian yang telah dibuat oleh tim surveyor.</p>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor LPA</th>
                <th style="padding:10px; text-align:left;">Nama Debitur</th>
                <th style="padding:10px; text-align:left;">Objek penilaian</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Tanggal Laporan</th>
                <th style="padding:10px; text-align:center;">Softcopy</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanPenilaian as $laporan)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $laporan['nomor_laporan'] }}</td>
                    <td style="padding:10px;">{{ $laporan['klien'] }}</td>
                    <td style="padding:10px;">{{ $laporan['jenis_aset'] }}</td>
                    <td style="padding:10px;">Rp {{ number_format($laporan['nilai_penilaian'], 0, ',', '.') }}</td>
                    <td style="padding:10px;">{{ $laporan['tgl_laporan'] }}</td>
                    <td style="padding:10px; text-align:center;">
                        @if($laporan->softcopy)
                            <a href="{{ asset('storage/laporan/'.$laporan->softcopy) }}" target="_blank"
                            style="color:white; background:#007BFF; padding:5px 10px; border-radius:5px; text-decoration:none;">
                            PDF
                            </a>
                        @else
                            -
                        @endif
                    </td>
            @endforeach
        </tbody>
    </table>
    </div>

    
@endsection
