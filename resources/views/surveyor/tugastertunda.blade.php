@extends('layouts.app')

@section('title', 'Tugas Tertunda')

@section('content')
<h1><i class="fas fa-clock"></i> Tugas Tertunda</h1>
<p>Berikut adalah daftar tugas yang masih dalam antrian.</p>

<div class="dashboard-card" style="margin-top:25px;">
    <table style="width:100%; border-collapse:collapse; margin-top:15px;">
    <thead style="background:#FFC107; color:#000;">
        <tr>
            <th style="padding:12px; text-align:left;">Nama Tugas</th>
            <th style="padding:12px; text-align:left;">Lokasi</th>
            <th style="padding:12px; text-align:left;">Deadline</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $t)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:12px; text-align:left;">{{ $t['nama'] }}</td>
            <td style="padding:12px; text-align:left;">{{ $t['lokasi'] }}</td>
            <td style="padding:12px; text-align:left;">{{ $t['deadline'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
