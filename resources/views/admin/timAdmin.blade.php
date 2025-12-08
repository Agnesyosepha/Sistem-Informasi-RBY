@extends('layouts.app')

@section('title', 'Tim Admin')

@section('content')
    <h1><i class="fas fa-users-cog"></i> Daftar Tim Admin</h1>
    <p>Berikut adalah staff divisi Admin yang terdaftar saat ini.</p>

    <div class="dashboard-card" style="margin-top:25px;">
        <h3><i class="fas fa-user-friends"></i> Tim Admin</h3>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#E49BA6; color:white;">
                <tr>
                    <th style="padding:12px; text-align:center;">No</th>
                    <th style="padding:12px; text-align:left;">Nama Admin</th>
                    <th style="padding:12px; text-align:left;">No. HP</th>
                    <th style="padding:12px; text-align:left;">Email</th>
                    <th style="padding:12px; text-align:left;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tim as $t)
                    <tr style="border-bottom:1px solid #e2e2e2;">
                        <td style="padding:12px; text-align:center;">
                            {{ $loop->iteration }}
                        </td>
                        <td style="padding:12px;">{{ $t['nama'] }}</td>
                        <td style="padding:12px;">{{ $t['nohp'] }}</td>
                        <td style="padding:12px;">{{ $t['email'] }}</td>
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
