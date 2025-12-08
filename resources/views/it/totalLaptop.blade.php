@extends('layouts.app')

@section('title', 'Total Laptop')

@section('content')
    <h1><i class="fas fa-laptop"></i> Daftar Laptop</h1>
    <p>Berikut daftar laptop yang digunakan oleh staf perusahaan.</p>

    
    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#CDE5FF; color:black;">
            <tr>
                <th style="padding:10px; text-align:center;">No</th>
                <th style="padding:10px; text-align:left;">Nama Laptop</th>
                <th style="padding:10px; text-align:left;">Pengguna</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            <tbody>
            @foreach($laptops as $pc)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px; text-align:center;">
                        {{ $loop->iteration }}
                    </td>

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
