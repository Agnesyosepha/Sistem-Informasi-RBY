@extends('layouts.app')

@section('title', 'Total Komputer')

@section('content')
    <h1><i class="fas fa-computer"></i> Daftar Komputer</h1>
    <p>Berikut daftar komputer yang digunakan oleh staf perusahaan.</p>

    
    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Komputer</th>
                <th style="padding:10px; text-align:left;">Pengguna</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($komputers as $pc)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $pc['nama'] }}</td>
                    <td style="padding:10px;">{{ $pc['pengguna'] }}</td>
                    <td style="padding:10px;">{{ $pc['lokasi'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color: {{ $pc['status'] == 'Aktif' ? 'green' : 'orange' }};">
                        {{ $pc['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    
@endsection
