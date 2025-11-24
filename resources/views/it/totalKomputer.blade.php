@extends('layouts.app')

@section('title', 'Total Komputer')

@section('content')

<h1><i class="fas fa-computer"></i> Daftar Komputer</h1>
<p>Berikut daftar komputer yang digunakan oleh staf perusahaan.</p>

<div class="dashboard-card" style="margin-top:25px;">
    <h3><i class="fas fa-desktop"></i> Data Komputer</h3>

    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#55AD9B; color:white;">
            <tr>
                <th style="padding:12px; text-align:left;">Nama Komputer</th>
                <th style="padding:12px; text-align:left;">Pengguna</th>
                <th style="padding:12px; text-align:left;">Lokasi</th>
                <th style="padding:12px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($komputers as $pc)
                <tr style="border-bottom:1px solid #e2e2e2;">
                    <td style="padding:12px;">{{ $pc['nama'] }}</td>
                    <td style="padding:12px;">{{ $pc['pengguna'] }}</td>
                    <td style="padding:12px;">{{ $pc['lokasi'] }}</td>
                    <td style="padding:12px;">
                        @if($pc['status'] == 'Aktif')
                            <span style="color:#16a34a; font-weight:600;">Aktif</span>
                        @else
                            <span style="color:#d68a1f; font-weight:600;">Maintenance</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
