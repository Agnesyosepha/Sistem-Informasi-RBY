@extends('layouts.app')

@section('title', 'Laporan Final')

@section('content')
    <h1><i class="fas fa-book"></i> Buku Laporan Final</h1>
    <p>Daftar laporan akhir penilaian berdasarkan status pengiriman.</p>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#F9B572; color:black;">
            <tr>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Jenis Penilaian</th>
                <th style="padding:10px; text-align:left;">Nama Pengirim</th>
                <th style="padding:10px; text-align:left;">No. Laporan</th>
                <th style="padding:10px; text-align:left;">Status Pengiriman</th>
                <th style="padding:10px; text-align:center;">Copy</th>
            </tr>
        </thead>

        <tbody>
            @foreach($laporanFinal as $item)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
                <td style="padding:10px;">{{ $item['jenis_penilaian'] }}</td>
                <td style="padding:10px;">{{ $item['pengirim'] }}</td>
                <td style="padding:10px;">{{ $item['nomor_laporan'] }}</td>

                <td style="padding:10px; font-weight:600;
                    color:
                        {{ $item['status_pengiriman'] == 'Sudah Dikirim' ? 'green' : 'red' }};
                ">
                    {{ $item['status_pengiriman'] }}
                </td>

                <!-- Kolom Copy -->
                <td style="padding:10px; text-align:center;">
                    <label style="margin-right:10px;">
                        <input type="checkbox" name="softcopy_{{ $loop->index }}">
                        Softcopy
                    </label>

                    <label>
                        <input type="checkbox" name="hardcopy_{{ $loop->index }}">
                        Hardcopy
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    
@endsection
