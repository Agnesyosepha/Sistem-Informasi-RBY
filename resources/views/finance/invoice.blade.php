@extends('layouts.app')

@section('title', 'Invoice')

@section('content')
<h1><i class="fas fa-file-invoice"></i> Invoice</h1>
<p>Daftar data invoice yang sedang diproses.</p>

<div class="dashboard-card" style="margin-top:20px;">
        <h3><i class="fas fa-receipt"></i> Data Invoice</h3>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                 <tr style="background:#007BFF; color:white;">
                    <th style="padding:10px; text-align:left;">Tanggal Pembuat</th>
                    <th style="padding:10px; text-align:left;">No. Invoice</th>
                    <th style="padding:10px; text-align:left;">No. PPJP/No. Adendum</th>
                    <th style="padding:10px; text-align:left;">Nama Klien</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">08 Nov 2025</td>
                    <td style="padding:10px;">PT Sumber Jaya</td>
                    <td style="padding:10px;">1.200.000</td>
                    <td style="padding:10px;">Budi Santoso</td>
                    <td style="padding:10px;">Rp 1.500.000</td>
                    <td style="padding:10px; color: blue; font-weight:600;">Disetujui</td>
                    <td style="padding:10px; text-align:center;">
                        <input type="checkbox">
                    </td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">09 Nov 2025</td>
                    <td style="padding:10px;">CV Cahaya Baru</td>
                    <td style="padding:10px;">900.000</td>
                    <td style="padding:10px;">Siti Aulia</td>                    
                    <td style="padding:10px;">Rp 900.000</td>
                    <td style="padding:10px; color: orange; font-weight:600">Menunggu</td>
                    <td style="padding:10px; text-align:center;">
                        <input type="checkbox" checked disabled>
                    </td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">10 Nov 2025</td>
                    <td style="padding:10px;">PT Andalan Sejahtera</td>
                    <td style="padding:10px;">750.000</td>
                    <td style="padding:10px;">Reza Fadillah</td>                    
                    <td style="padding:10px;">Rp 800.000</td>
                    <td style="padding:10px; color: blue; font-weight:600">Disetujui</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox" disabled></td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">11 Nov 2025</td>
                    <td style="padding:10px;">Koperasi Maju</td>
                    <td style="padding:10px;">1.050.000</td>
                    <td style="padding:10px;">Andi Wijaya</td>                    
                    <td style="padding:10px;">Rp 1.200.000</td>
                    <td style="padding:10px; color: orange; font-weight:600">Menunggu</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox"></td>
                </tr>

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">12 Nov 2025</td>
                    <td style="padding:10px;">PT Digital Nusantara</td>
                    <td style="padding:10px;">1.600.000</td>
                    <td style="padding:10px;">Nadia Putri</td>                   
                    <td style="padding:10px;">Rp 1.600.000</td>
                    <td style="padding:10px; color: blue; font-weight:600">Disetujui</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox" checked disabled></td>
                </tr>

                 <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">13 Nov 2025</td>
                    <td style="padding:10px;">PT Mandiri Global</td>
                    <td style="padding:10px;">1.300.000</td>
                    <td style="padding:10px;">Yoga Pranata</td>                    
                    <td style="padding:10px;">Rp 1.450.000</td>
                    <td style="padding:10px; color: blue; font-weight:600">Disetujui</td>
                    <td style="padding:10px; text-align:center;"><input type="checkbox"></td>
                </tr>


            </tbody>
        </table>
    </div>


@endsection
