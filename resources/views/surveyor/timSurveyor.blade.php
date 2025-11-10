@extends('layouts.app')

@section('title', 'Tim Surveyor')

@section('content')
    <h1><i class="fas fa-users"></i> Daftar Tim Surveyor</h1>
    <p>Berikut adalah nama-nama staff surveyor yang terdaftar.</p>

    <div class="dashboard-card" style="margin-top:25px;">
        <h3><i class="fas fa-user-friends"></i> Tim Surveyor</h3>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#2F6FED; color:white;">
                <tr>
                    <th style="padding:12px; text-align:left;">Nama Surveyor</th>
                    <th style="padding:12px; text-align:left;">Nomor HP</th>
                    <th style="padding:12px; text-align:left;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tim as $t)
                    <tr style="border-bottom:1px solid #e2e2e2;">
                        <td style="padding:12px;">{{ $t['nama'] }}</td>
                        <td style="padding:12px;">{{ $t['nohp'] }}</td>
                        <td style="padding:12px;">
                            @if($t['status'] == 'Aktif')
                                <span style="color:green; font-weight:600;">Aktif</span>
                            @else
                                <span style="color:orange; font-weight:600;">Cuti</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
