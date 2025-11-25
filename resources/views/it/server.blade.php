@extends('layouts.app')

@section('title', 'Daftar Server')

@section('content')
    <h1><i class="fas fa-network-wired"></i> Daftar Server</h1>
    <p>Berikut daftar server aktif dan statusnya di seluruh lokasi.</p>

    
    
    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#ABE7B2; color:black;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Server</th>
                <th style="padding:10px; text-align:left;">Alamat IP</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servers as $server)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $server['nama'] }}</td>
                    <td style="padding:10px;">{{ $server['ip'] }}</td>
                    <td style="padding:10px;">{{ $server['lokasi'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color: 
                            @if($server['status'] == 'Aktif') green 
                            @elseif($server['status'] == 'Maintenance') orange 
                            @else red 
                            @endif;">
                        {{ $server['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    
@endsection
