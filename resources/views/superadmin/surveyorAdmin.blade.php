@extends('superadmin.app2')

@section('title', 'Surveyor Admin')

@section('content')

<h1 style="font-weight:700; font-size:28px; margin-bottom:10px; color:#0C2B4E;">
    Surveyor
</h1>

<p style="color:#555; margin-bottom:25px;">
    Daftar seluruh admin yang terdaftar di sistem.
</p>

<div style="
    background:white; padding:20px; 
    border-radius:12px; 
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
">
    <table style="width:100%; border-collapse:collapse;">
        <thead style="background:#4FB7B3; color:white;">
            <tr>
                <th style="padding:12px; text-align:left;">Nama</th>
                <th style="padding:12px; text-align:left;">Username</th>
                <th style="padding:12px; text-align:left;">Email</th>
                <th style="padding:12px; text-align:center;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            
    </table>
</div>




@endsection
