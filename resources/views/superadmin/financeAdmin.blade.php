@extends('superadmin.app2')

@section('title', 'Finance Admin')

@section('content')

<h1><i class="fas fa-file-invoice-dollar"></i> Finance Admin</h1>
    <p>Data - data keuangan yang perlu divalidasi.</p>

    <div class="dashboard-cards">
        <a href="{{ route('superadmin.finance.SAinvoice') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-file-invoice"></i> Invoice</h3>
                <p><strong>Data Invoice</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-users"></i> Staff</h3>
                <p><strong>Staff</strong></p>
            </div>
        </a>
    </div>

    <div class="dashboard-card" style="margin-top:20px;">
        <h3><i class="fas fa-receipt"></i> Data Klaim Perjalanan</h3>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                 <tr style="background:#007BFF; color:white;">
                    <th rowspan="2" style="padding:10px; text-align:left;">Tanggal</th>
                    <th rowspan="2" style="padding:10px; text-align:left;">Nama Klien</th>
                    <th rowspan="2" style="padding:10px; text-align:left;">Yang Bertugas</th>
                    <th colspan="2" style="padding:10px; text-align:center;">Biaya Jalan</th> <!-- HEADER TINGKAT 1 -->
                    <th rowspan="2" style="padding:10px; text-align:right;">Total Klaim</th>
                    <th rowspan="2" style="padding:10px; text-align:center;">Status</th>
                    <th rowspan="2" style="padding:10px; text-align:center;">Aksi</th>
                </tr>
                <tr style="background:#007BFF; color:white;">
                    <th style="padding:10px; text-align:right;">Penilai</th>
                    <th style="padding:10px; text-align:right;">Pelaksana Inspeksi</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">08 Nov 2025</td>
                    <td style="padding:10px;">PT Sumber Jaya</td>
                    <td style="padding:10px;">Budi Santoso</td>
                    <td style="padding:10px; text-align:right;">Rp 1.200.000</td>
                    <td style="padding:10px; text-align:right;">Rp 1.500.000</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Menunggu</td>
                    <td style="padding:10px; text-align:center;">
                        <input type="checkbox">
                    </td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">09 Nov 2025</td>
                    <td style="padding:10px;">CV Cahaya Baru</td>
                    <td style="padding:10px;">Siti Aulia</td>
                    <td style="padding:10px; text-align:right;">Rp 900.000</td>
                    <td style="padding:10px; text-align:right;">Rp 900.000</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Disetujui</td>
                    <td style="padding:10px; text-align:center;">
                        <input type="checkbox" checked disabled>
                    </td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">10 Nov 2025</td>
                    <td style="padding:10px;">PT Andalan Sejahtera</td>
                    <td style="padding:10px;">Reza Fadillah</td>
                    <td style="padding:10px; text-align:right;">Rp 750.000</td>
                    <td style="padding:10px; text-align:right;">Rp 800.000</td>
                    <td style="padding:10px; text-align:center; color:red; font-weight:600;">Ditolak</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox" disabled></td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">11 Nov 2025</td>
                    <td style="padding:10px;">Koperasi Maju</td>
                    <td style="padding:10px;">Andi Wijaya</td>
                    <td style="padding:10px; text-align:right;">Rp 1.050.000</td>
                    <td style="padding:10px; text-align:right;">Rp 1.200.000</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Menunggu</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox"></td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">12 Nov 2025</td>
                    <td style="padding:10px;">PT Digital Nusantara</td>
                    <td style="padding:10px;">Nadia Putri</td>
                    <td style="padding:10px; text-align:right;">Rp 1.600.000</td>
                    <td style="padding:10px; text-align:right;">Rp 1.600.000</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Disetujui</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox" checked disabled></td>
                </tr>

                 <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">13 Nov 2025</td>
                    <td style="padding:10px;">PT Mandiri Global</td>
                    <td style="padding:10px;">Yoga Pranata</td>
                    <td style="padding:10px; text-align:right;">Rp 1.300.000</td>
                    <td style="padding:10px; text-align:right;">Rp 1.450.000</td>
                    <td style="padding:10px; text-align:center; color:orange; font-weight:600;">Menunggu</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox"></td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">14 Nov 2025</td>
                    <td style="padding:10px;">CV Mekar Sentosa</td>
                    <td style="padding:10px;">Rina Kartika</td>
                    <td style="padding:10px; text-align:right;">Rp 780.000</td>
                    <td style="padding:10px; text-align:right;">Rp 900.000</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Disetujui</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox" checked disabled></td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">15 Nov 2025</td>
                    <td style="padding:10px;">PT Metro Elektrik</td>
                    <td style="padding:10px;">Dimas Saputra</td>
                    <td style="padding:10px; text-align:right;">Rp 1.900.000</td>
                    <td style="padding:10px; text-align:right;">Rp 2.000.000</td>
                    <td style="padding:10px; text-align:center; color:red; font-weight:600;">Ditolak</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox" disabled></td>
                </tr>

            </tbody>
        </table>
    </div>




@endsection
