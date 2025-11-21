@extends('layouts.app')

@section('title', 'Lokasi Survei')

@section('content')
    <h1><i class="fas fa-map-marker-alt"></i> Daftar Lokasi Survei</h1>
    <p>Daftar lokasi survei yang akan dilakukan:</p>

    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-calendar-alt"></i> Jadwal Surveyor</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#239BA7; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Surveyor</th>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Lokasi</th>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lokasi as $l)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $l->surveyor }}</td>
                    <td style="padding:10px;">{{ $l->tanggal }}</td>
                    <td style="padding:10px;">{{ $l->lokasi }}</td>
                    <td style="padding:10px;">{{ $l->nama_objek }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color: {{ $l->status == 'Selesai' ? 'green' : 'orange' }};">
                        {{ $l->status }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
