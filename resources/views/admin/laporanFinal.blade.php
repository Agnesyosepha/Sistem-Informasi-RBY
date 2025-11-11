@extends('layouts.app')

@section('title', 'Laporan Final')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Laporan Final</h1>
    <p>Daftar laporan akhir penilaian yang telah disetujui atau selesai dikirim ke klien.</p>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Nomor PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Pengiriman</th>
                <th style="padding:10px; text-align:left;">Jenis Penilaian</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanFinal as $item)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
                    <td style="padding:10px;">{{ $item['nomor_ppjp'] }}</td>
                    <td style="padding:10px;">{{ $item['tgl_pengiriman'] }}</td>
                    <td style="padding:10px;">{{ $item['jenis_penilaian'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color:
                            {{ $item['status'] == 'Disetujui' ? 'green' :
                               ($item['status'] == 'Direvisi' ? 'orange' :
                               ($item['status'] == 'Arsip' ? 'gray' : 'red')) }};
                    ">
                        {{ $item['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    
@endsection
