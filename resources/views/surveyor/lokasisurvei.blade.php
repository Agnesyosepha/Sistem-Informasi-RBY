@extends('layouts.app')

@section('title', 'Lokasi Survei')

@section('content')
    <h1><i class="fas fa-map-marker-alt"></i> Daftar Lokasi Survei</h1>
    <p>Daftar lokasi survei yang akan dilakukan:</p>

    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-calendar-alt"></i> Jadwal Surveyor</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#239BA7; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Surveyor</th>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Lokasi</th>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">Firdaus Ginting</td>
                    <td style="padding:10px;">05 Sep 2025</td>
                    <td style="padding:10px;">Jakarta</td>
                    <td style="padding:10px;">Survey Tanah dan Rumah</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Selesai</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">Fajar Hariyadi</td>
                    <td style="padding:10px;">07 Okt 2025</td>
                    <td style="padding:10px;">Bandung</td>
                    <td style="padding:10px;">Survey Tanah Kosong</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Proses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">Jasmani Ginting</td>
                    <td style="padding:10px;">01 Nov 2025</td>
                    <td style="padding:10px;">Bekasi</td>
                    <td style="padding:10px;">Survey Bangunan</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Proses</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
