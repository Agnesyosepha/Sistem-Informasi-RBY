@extends('layouts.app')

@section('title', 'EDP')

@section('content')
    <h1><i class="fas fa-desktop"></i> Dashboard Reviewer</h1>
    <p>Ringkasan aktivitas Electronic Data Processing (EDP).</p>

    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3><i class="fas fa-server"></i> Dokumen Revisi</h3>
            <p><strong>8 Server</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-database"></i> Dokumen Final</h3>
            <p><strong>15 Database</strong></p>
        </div>
    </div>

    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-history"></i> Log Aktivitas</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Aktivitas</th>
                    <th style="padding:10px; text-align:left;">User</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">04 Sep 2025</td>
                    <td style="padding:10px;">Backup Database</td>
                    <td style="padding:10px;">Admin EDP</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Sukses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">06 Sep 2025</td>
                    <td style="padding:10px;">Update Sistem</td>
                    <td style="padding:10px;">EDP-02</td>
                    <td style="padding:10px; text-align:center; color:red; font-weight:600;">Gagal</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
