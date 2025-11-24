@extends('layouts.app')

@section('title', 'Update Proyek')

@section('content')
<h1><i class="fas fa-chart-linet"></i> Update Proyek</h1>
<p>Berikut merupakan rekapitulasi seluruh proyek berdasarkan statusnya: <strong>On Progress</strong>, <strong>Selesai</strong>, dan <strong>Pending</strong>.</p>


    {{-- Bagian 1: Proyek Berjalan --}}
    <div class="dashboard-card" style="margin-top:25px; padding:20px; border-radius:10px; border:1px solid #e5e5e5;">
    <h2 style="color:#007BFF;"><i class="fas fa-tasks"></i> Proyek Berjalan</h2>
    <p>Daftar proyek yang sedang dikerjakan dan masih dalam proses inspeksi lapangan.</p>

    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead style="background:#CDE5FF;">
            <tr>
                <th style="padding:10px; text-align:left;">No. PPJP</th>
                <th style="padding:10px; text-align:left;">Nama Debitur / Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Tgl Inspeksi</th>
                <th style="padding:10px; text-align:left;">Progres</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyekBerjalan as $p)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $p['noppjp'] }}</td>
                    <td style="padding:10px;">{{ $p['debitur'] }}</td>
                    <td style="padding:10px;">{{ $p['lokasi'] }}</td>
                    <td style="padding:10px;">{{ $p['surveyor'] }}</td>
                    <td style="padding:10px;">{{ $p['tgl_inspeksi'] }}</td>
                    <td style="padding:10px; font-weight:600; color:
                        {{ $p['progres'] == 'On Progress' ? 'orange' : ($p['progres'] == 'Review' ? 'blue' : 'green') }}">
                        {{ $p['progres'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    {{-- Bagian 2: Proyek Selesai --}}
    <div class="dashboard-card" style="margin-top:25px; padding:20px; border-radius:10px; border:1px solid #e5e5e5;">
    <h2 style="color:#28A745; margin-top:30px;"><i class="fas fa-check-circle"></i> Proyek Selesai</h2>
    <p>Daftar proyek yang telah diselesaikan dan disetujui, termasuk proyek dengan lokasi berbeda namun memiliki No. PPJP yang sama.</p>

    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead style="background:#B9F6CA;">
            <tr>
                <th style="padding:10px; text-align:left;">No. PPJP</th>
                <th style="padding:10px; text-align:left;">Nama Debitur / Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Tgl Selesai</th>
                <th style="padding:10px; text-align:left;">Progres</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyekSelesai as $p)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $p['noppjp'] }}</td>
                    <td style="padding:10px;">{{ $p['debitur'] }}</td>
                    <td style="padding:10px;">{{ $p['lokasi'] }}</td>
                    <td style="padding:10px;">{{ $p['surveyor'] }}</td>
                    <td style="padding:10px;">{{ $p['tgl_selesai'] }}</td>
                    <td style="padding:10px; color:green; font-weight:600;">{{ $p['progres'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    {{-- Bagian 3: Proyek Pending --}}
<div class="dashboard-card" style="margin-top:25px; padding:20px; border-radius:10px; border:1px solid #e5e5e5;">
    <h2 style="color:#C62828; margin-top:30px;"><i class="fas fa-clock"></i> Proyek Pending</h2>
    <p>Daftar proyek yang masih tertunda dan menunggu tindak lanjut lebih lanjut.</p>

    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead style="background:#FFE082;">
            <tr>
                <th style="padding:10px; text-align:left;">No. PPJP</th>
                <th style="padding:10px; text-align:left;">Nama Debitur / Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Tgl Inspeksi</th>
                <th style="padding:10px; text-align:left;">Alasan</th>
                <th style="padding:10px; text-align:left;">Progres</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyekPending as $p)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $p['noppjp'] }}</td>
                    <td style="padding:10px;">{{ $p['debitur'] }}</td>
                    <td style="padding:10px;">{{ $p['lokasi'] }}</td>
                    <td style="padding:10px;">{{ $p['surveyor'] }}</td>
                    <td style="padding:10px;">{{ $p['tgl_inspeksi'] }}</td>
                    <td style="padding:10px;">{{ $p['alasan'] }}</td>
                    <td style="padding:10px; color:#E65100; font-weight:600;">{{ $p['progres'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
