@extends('layouts.app')

@section('title', 'Finance')

@section('content')
    <h1><i class="fas fa-file-invoice-dollar"></i> Dashboard Finance</h1>
    <p>Ringkasan keuangan perusahaan bulan ini.</p>

    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3><i class="fas fa-wallet"></i> Total Pendapatan</h3>
            <p><strong>Rp 75.000.000</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-credit-card"></i> Total Pengeluaran</h3>
            <p><strong>Rp 42.000.000</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-chart-line"></i> Laba Bersih</h3>
            <p><strong>Rp 33.000.000</strong></p>
        </div>
        <div class="dashboard-card">
            <h3><i class="fas fa-percentage"></i> Margin Laba</h3>
            <p><strong>44%</strong></p>
        </div>
    </div>

    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-receipt"></i> Riwayat Transaksi</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Deskripsi</th>
                    <th style="padding:10px; text-align:right;">Jumlah</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">01 Sep 2025</td>
                    <td style="padding:10px;">Pembayaran Client A</td>
                    <td style="padding:10px; text-align:right;">Rp 15.000.000</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Masuk</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">02 Sep 2025</td>
                    <td style="padding:10px;">Pembelian Peralatan</td>
                    <td style="padding:10px; text-align:right;">Rp 7.500.000</td>
                    <td style="padding:10px; text-align:center; color:red; font-weight:600;">Keluar</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
