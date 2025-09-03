@extends('layouts.app')

@section('title', 'Admin')

@section('content')
    <h1><i class="fas fa-user-cog"></i> Dashboard Admin</h1>
    <p>Panel kontrol administrator untuk mengelola sistem dan pengguna.</p>

    <!-- Statistik Utama -->
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3><i class="fas fa-users"></i> Total Pengguna</h3>
            <p><strong>350</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-user-shield"></i> Role & Permissions</h3>
            <p><strong>5 Role Utama</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-database"></i> Data Tersimpan</h3>
            <p><strong>120.000 Record</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-server"></i> Status Server</h3>
            <p><strong style="color:green;">Online</strong></p>
        </div>
    </div>

    <!-- Tabel Aktivitas -->
    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-clipboard-list"></i> Log Aktivitas Terakhir</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">User</th>
                    <th style="padding:10px; text-align:left;">Aksi</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">01 Sep 2025</td>
                    <td style="padding:10px;">Admin Utama</td>
                    <td style="padding:10px;">Menambahkan user baru</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Sukses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">02 Sep 2025</td>
                    <td style="padding:10px;">Surveyor01</td>
                    <td style="padding:10px;">Login ke sistem</td>
                    <td style="padding:10px; text-align:center; color:blue; font-weight:600;">Info</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">02 Sep 2025</td>
                    <td style="padding:10px;">EDP02</td>
                    <td style="padding:10px;">Gagal update data</td>
                    <td style="padding:10px; text-align:center; color:red; font-weight:600;">Error</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
