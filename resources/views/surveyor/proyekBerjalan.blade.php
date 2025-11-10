@extends('layouts.app')

@section('title', 'Proyek Berjalan')

@section('content')
    <h1><i class="fas fa-tasks"></i> Daftar Proyek Berjalan</h1>
    <p>Berikut adalah daftar proyek yang sedang dikerjakan oleh tim surveyor:</p>

    <table style="width:100%; border-collapse: collapse; margin-top:20px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">No</th>
                <th style="padding:10px; text-align:left;">Nama Proyek</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Tanggal Mulai</th>
                <th style="padding:10px; text-align:left;">Progress</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">1</td>
                <td style="padding:10px;">Proyek Penilaian Gedung Perkantoran</td>
                <td style="padding:10px;">Jakarta</td>
                <td style="padding:10px;">Firdaus Ginting</td>
                <td style="padding:10px;">15 Okt 2025</td>
                <td style="padding:10px;">On Progress</td>
            </tr>
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">2</td>
                <td style="padding:10px;">Proyek Survey Rumah Komersial</td>
                <td style="padding:10px;">Bandung</td>
                <td style="padding:10px;">Fajar Hariyadi</td>
                <td style="padding:10px;">22 Okt 2025</td>
                <td style="padding:10px;">On Progress</td>
            </tr>
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">3</td>
                <td style="padding:10px;">Proyek Evaluasi Tanah Kosong</td>
                <td style="padding:10px;">Medan</td>
                <td style="padding:10px;">Jasmani Ginting</td>
                <td style="padding:10px;">30 Okt 2025</td>
                <td style="padding:10px;">Done</td>
            </tr>
        </tbody>
    </table>
@endsection
