@extends('layouts.app')

@section('title', 'Surveyor')

@section('content')
    <h1><i class="fas fa-clipboard-list"></i> Dashboard Surveyor</h1>
    <p>Ringkasan aktivitas surveyor bulan ini.</p>

    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3><i class="fas fa-map-marker-alt"></i> Lokasi Disurvei</h3>
            <p><strong>25 Lokasi</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-tasks"></i> Proyek Berjalan</h3>
            <p><strong>12 Proyek</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-check-circle"></i> Proyek Selesai</h3>
            <p><strong>18 Proyek</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-clock"></i> Tugas Tertunda</h3>
            <p><strong>3 Tugas</strong></p>
        </div>
    </div>

    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-calendar-alt"></i> Jadwal Surveyor</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Lokasi</th>
                    <th style="padding:10px; text-align:left;">Deskripsi</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">05 Sep 2025</td>
                    <td style="padding:10px;">Jakarta</td>
                    <td style="padding:10px;">Survey Jaringan Fiber</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Selesai</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">07 Sep 2025</td>
                    <td style="padding:10px;">Bandung</td>
                    <td style="padding:10px;">Survey Infrastruktur</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Proses</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
