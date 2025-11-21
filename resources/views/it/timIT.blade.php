@extends('layouts.app')

@section('title', 'Staff IT')

@section('content')
<h1><i class="fas fa-user"></i> Staff IT</h1>
<p>Berikut adalah staff divisi IT yang terdaftar saat ini.</p>

<div class="dashboard-card" style="margin-top:30px;">
  <h3><i class="fas fa-user-friends"></i> Tim IT</h3>

<table style="width:100%; border-collapse: collapse; margin-top:15px;">
    <thead style="background:#E49BA6; color:white;">
        <tr>
            <th style="padding:10px; text-align:left;">Nama</th>
            <th style="padding:10px; text-align:left;">No. HP</th>
            <th style="padding:10px; text-align:left;">Email</th>
            <th style="padding:10px; text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($staffIT as $staff)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px;">{{ $staff['nama'] }}</td>
            <td style="padding:10px;">{{ $staff['nohp'] }}</td>
            <td style="padding:10px;">{{ $staff['email'] }}</td>
            <td style="padding:12px;">
                @if($staff['status'] == 'Aktif')
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
