@extends('layouts.app')

@section('title', 'Tim Reviewer')

@section('content')
    <h1><i class="fas fa-users"></i> Tim Finance</h1>
    <p>Berikut adalah staff divisi Finance yang terdaftar saat ini.</p>

    <div class="dashboard-card" style="margin-top:30px;">
      <h3><i class="fas fa-person"></i> Anggota Finance</h3>
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#E49BA6; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama</th>
                <th style="padding:10px; text-align:left;">No. HP</th>
                <th style="padding:10px; text-align:left;">Email</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
           @foreach($timFinance as $reviewer)
            <tr>
                <td>{{ $reviewer['nama'] }}</td>
                <td>{{ $reviewer['nohp'] }}</td>
                <td>{{ $reviewer['email'] }}</td>
                <td style="color: {{ $reviewer['status'] == 'Aktif' ? 'green' : 'orange' }}">
                    {{ $reviewer['status'] }}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection
