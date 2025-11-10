@extends('layouts.app')

@section('title', 'Proyek Selesai')

@section('content')
    <h1><i class="fas fa-check-circle"></i> Daftar Proyek Selesai</h1>
    <p>Berikut adalah daftar proyek yang telah diselesaikan.</p>

    <div class="dashboard-card" style="margin-top:25px; border-radius:10px; overflow:hidden; border:1px solid #e5e5e5;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#2F6FED; color:white;">
                    <th style="padding:14px; text-align:left;">Nama Proyek</th>
                    <th style="padding:14px; text-align:left;">Lokasi</th>
                    <th style="padding:14px; text-align:left;">User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyek as $p)
                    <tr style="border-bottom:1px solid #e5e5e5;">
                        <td style="padding:12px 14px;">{{ $p['nama'] }}</td>
                        <td style="padding:12px 14px;">{{ $p['lokasi'] }}</td>
                        <td style="padding:12px 14px;">{{ $p['user'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
