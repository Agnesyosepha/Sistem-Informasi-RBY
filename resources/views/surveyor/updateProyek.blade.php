@extends('layouts.app')

@section('title', 'Update Proyek')

@section('content')
<h1><i class="fas fa-sync-alt"></i> Update Proyek</h1>
<p>Berikut merupakan rekapitulasi seluruh proyek berdasarkan statusnya: <strong>On Progress</strong>, <strong>Selesai</strong>, dan <strong>Pending</strong>.</p>

<div class="dashboard-card" style="margin-top:25px; padding:20px; border-radius:10px; border:1px solid #e5e5e5;">

    {{-- Bagian 1: Proyek Berjalan --}}
    <h2 style="color:#007BFF;"><i class="fas fa-tasks"></i> Proyek Berjalan</h2>
    <p>Daftar proyek yang sedang dikerjakan dan masih dalam proses penilaian.</p>
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead style="background:#CDE5FF;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Proyek</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Tanggal Mulai</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyekBerjalan as $p)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $p['nama'] }}</td>
                    <td style="padding:10px;">{{ $p['lokasi'] }}</td>
                    <td style="padding:10px;">{{ $p['surveyor'] }}</td>
                    <td style="padding:10px;">{{ $p['tanggal'] }}</td>
                    <td style="padding:10px; font-weight:600; color:
                        {{ $p['status'] == 'On Progress' ? 'orange' : ($p['status'] == 'Review' ? 'blue' : 'green') }}">
                        {{ $p['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="dashboard-card" style="margin-top:25px; padding:20px; border-radius:10px; border:1px solid #e5e5e5;">
    {{-- Bagian 2: Proyek Selesai --}}
    <h2 style="color:#28A745; margin-top:30px;"><i class="fas fa-check-circle"></i> Proyek Selesai</h2>
    <p>Proyek yang telah selesai dan disetujui oleh klien.</p>
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead style="background:#B9F6CA;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Proyek</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">User</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyekSelesai as $s)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $s['nama'] }}</td>
                    <td style="padding:10px;">{{ $s['lokasi'] }}</td>
                    <td style="padding:10px;">{{ $s['user'] }}</td>
                    <td style="padding:10px; color:green; font-weight:600;">{{ $s['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="dashboard-card" style="margin-top:25px; padding:20px; border-radius:10px; border:1px solid #e5e5e5;">
    {{-- Bagian 3: Tugas Tertunda --}}
    <h2 style="color:#C62828; margin-top:30px;"><i class="fas fa-clock"></i> Tugas Tertunda</h2>
    <p>Tugas yang masih menunggu pelaksanaan atau penyelesaian.</p>
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead style="background:#FFE082;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Tugas</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Deadline</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tugasTertunda as $t)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $t['nama'] }}</td>
                    <td style="padding:10px;">{{ $t['lokasi'] }}</td>
                    <td style="padding:10px;">{{ $t['deadline'] }}</td>
                    <td style="padding:10px; color:#E65100; font-weight:600;">{{ $t['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
