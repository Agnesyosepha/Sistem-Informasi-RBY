@extends('layouts.app')

@section('title', 'Tim Reviewer')

@section('content')
    <h1><i class="fas fa-users"></i> Tim Reviewer</h1>
    <p>Daftar anggota tim reviewer EDP yang aktif saat ini.</p>

    <div class="dashboard-card" style="margin-top:30px;">
      <h3><i class="fas fa-person"></i> Anggota Reviewer</h3>
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama</th>
                <th style="padding:10px; text-align:left;">Email</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($timReviewer as $reviewer)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $reviewer['nama'] }}</td>
                    <td style="padding:10px;">{{ $reviewer['email'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color: {{ $reviewer['status'] == 'Aktif' ? 'green' : 'orange' }};">
                        {{ $reviewer['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    
@endsection
