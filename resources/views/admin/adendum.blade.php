@extends('layouts.app')

@section('title', 'Adendum')

@section('content')
    <h1><i class="fas fa-plus-square"></i> Daftar Adendum</h1>
    <p>Daftar adendum atau perubahan yang diajukan terhadap proyek yang sedang berjalan.</p>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor</th>
                <th style="padding:10px; text-align:left;">Proyek</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Deskripsi</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adendum as $item)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $item['nomor'] }}</td>
                    <td style="padding:10px;">{{ $item['proyek'] }}</td>
                    <td style="padding:10px;">{{ $item['tanggal'] }}</td>
                    <td style="padding:10px;">{{ $item['deskripsi'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color:
                            {{ $item['status'] == 'Disetujui' ? 'green' :
                               ($item['status'] == 'Menunggu Persetujuan' ? 'orange' :
                               ($item['status'] == 'Direvisi' ? 'red' : 'blue')) }};
                    ">
                        {{ $item['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    
@endsection
