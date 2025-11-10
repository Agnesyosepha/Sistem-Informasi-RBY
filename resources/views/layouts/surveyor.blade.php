@extends('layouts.app')

@section('title', 'Surveyor')

@section('content')
    <h1><i class="fas fa-clipboard-list"></i> Dashboard Surveyor</h1>
    <p>Ringkasan aktivitas surveyor bulan ini.</p>

    <div class="dashboard-cards">
        <a href="{{ route('surveyor.lokasisurvei') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-map-marker-alt"></i> Lokasi Survei</h3>
                <p><strong>25 Lokasi</strong></p>
            </div>
        </a>
        <a href="{{ route('surveyor.tim') }}" class="dashboard-card" style="display:block; color:inherit; text-decoration:none;">
            <h3><i class="fas fa-user"></i> Surveyor</h3>
            <p><strong>6 Surveyor</strong></p>
        </a>
        <a href="{{ route('surveyor.proyekberjalan') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-tasks"></i> Proyek Berjalan</h3>
                <p><strong>12 Proyek</strong></p>
            </div>
        </a>
        <a href="{{ route('surveyor.proyekSelesai') }}" class="dashboard-card" style="display:block; color:inherit; text-decoration:none;">
            <h3><i class="fas fa-check-circle"></i> Proyek Selesai</h3>
            <p><strong>18 Proyek</strong></p>
        </a>
        <div class="dashboard-card">
            <h3><i class="fas fa-clock"></i> Tugas Tertunda</h3>
            <p><strong>3 Tugas</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-tasks"></i> Working Paper</h3>
            <p><strong>11 Dokumen</strong></p>
        </div>
    </div>

    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-calendar-alt"></i> Jadwal Surveyor</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Surveyor</th>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Lokasi</th>
                    <th style="padding:10px; text-align:left;">Deskripsi</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">Dazai</td>
                    <td style="padding:10px;">05 Sep 2025</td>
                    <td style="padding:10px;">Jakarta</td>
                    <td style="padding:10px;">Survey Tanah dan Rumah</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Selesai</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">Ranpo</td>
                    <td style="padding:10px;">07 Okt 2025</td>
                    <td style="padding:10px;">Bandung</td>
                    <td style="padding:10px;">Survey Tanah Kosong</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Proses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">Naomi</td>
                    <td style="padding:10px;">01 Nov 2025</td>
                    <td style="padding:10px;">Bekasi</td>
                    <td style="padding:10px;">Survey Bangunan</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Proses</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
