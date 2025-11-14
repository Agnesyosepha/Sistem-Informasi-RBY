@extends('layouts.app')

@section('title', 'Staff EDP')

@section('content')
    <h1><i class="fas fa-users"></i> Daftar Staff EDP</h1>
    <p>Berikut adalah daftar staff EDP yang bertugas :</p>

    <div class="dashboard-card" style="margin-top:25px;">
<h3><i class="fas fa-user-friends"></i> Tim EDP</h3>
   <table style="width:100%; border-collapse: collapse; margin-top:15px;">
    <thead style="background:#E49BA6; color:white;">
        <tr>
            <th style="padding:10px; text-align:left;">Nama</th>
            <th style="padding:10px; text-align:left;">No HP</th>
            <th style="padding:10px; text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($staff as $s)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px; text-align:left;">{{ $s['nama'] }}</td>
            <td style="padding:10px; text-align:left;">{{ $s['nohp'] }}</td>

            <td style="
                padding:10px; 
                text-align:left; 
                font-weight:600; 
                color: {{ $s['status'] == 'Aktif' ? '#28a745' : '#fd7e14' }};
            ">
                {{ $s['status'] }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

    </div>
@endsection
