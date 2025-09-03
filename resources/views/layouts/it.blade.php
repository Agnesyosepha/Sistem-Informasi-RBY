@extends('layouts.app')

@section('title', 'IT Dashboard')

@section('content')
    <h1><i class="fas fa-server"></i> Dashboard IT</h1>
    <p>Ringkasan status infrastruktur dan aktivitas IT perusahaan.</p>

    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3><i class="fas fa-network-wired"></i> Server Aktif</h3>
            <p><strong>12 / 12 Online</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-database"></i> Database Health</h3>
            <p><strong>Normal</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-shield-alt"></i> Keamanan</h3>
            <p><strong>99% Threats Blocked</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-users-cog"></i> User Support</h3>
            <p><strong>25 Tiket Aktif</strong></p>
        </div>
    </div>

    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-tasks"></i> Aktivitas Terbaru</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Aktivitas</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">01 Sep 2025</td>
                    <td style="padding:10px;">Update Security Patch Server</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Selesai</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">02 Sep 2025</td>
                    <td style="padding:10px;">Backup Database Mingguan</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Proses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">03 Sep 2025</td>
                    <td style="padding:10px;">Perbaikan Jaringan Kantor</td>
                    <td style="padding:10px; text-align:center; color:red; font-weight:600;">Pending</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
