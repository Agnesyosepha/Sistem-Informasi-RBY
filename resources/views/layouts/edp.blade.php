@extends('layouts.app')

@section('title', 'EDP')

@section('content')
    <h1><i class="fas fa-desktop"></i> Dashboard EDP</h1>
    <p>Ringkasan aktivitas Electronic Data Processing (EDP).</p>

    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3><i class="fas fa-server"></i> Data Aktif</h3>
            <p><strong>8 Data Aktif</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-database"></i> Data Mentah</h3>
            <p><strong>15 Database</strong></p>
        </div>
        <a href="{{ route('edp.staff') }}" style="text-decoration:none; color:inherit;">
                <div class="dashboard-card" style="cursor:pointer;">
                    <h3><i class="fas fa-users"></i> EDP</h3>
                    <p><strong>4 Staff</strong></p>
                </div>
        </a>

    </div>

    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-history"></i> Log Aktivitas</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
                    <th style="padding:10px; text-align:left;">User</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">04 Sep 2025</td>
                    <td style="padding:10px;">Lelang</td>
                    <td style="padding:10px;">Admin EDP</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Sukses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">05 Sep 2025</td>
                    <td style="padding:10px;">Penjaminan Utang</td>
                    <td style="padding:10px;">EDP-02</td>
                    <td style="padding:10px; text-align:center; color:red; font-weight:600;">Gagal</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">06 Sep 2025</td>
                    <td style="padding:10px;">Laporan Keuangan</td>
                    <td style="padding:10px;">EDP-02</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Sukses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">07 Sep 2025</td>
                    <td style="padding:10px;">Jual Beli</td>
                    <td style="padding:10px;">EDP-02</td>
                    <td style="padding:10px; text-align:center; color:red; font-weight:600;">Gagal</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
