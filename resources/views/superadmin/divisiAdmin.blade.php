@extends('superadmin.app2')

@section('title', 'Data Admin')

@section('content')

<h1><i class="fas fa-user-cog"></i> Admin Admin</h1>
    <p>Panel kontrol administrator untuk mengelola sistem dan pengguna.</p>

    <!-- Statistik Utama -->
    <div class="dashboard-cards">
        <a href="{{ route('superadmin.admin.SAproposal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-lightbulb"></i> Daftar Proposal</h3>
                <p><strong>{{ $jumlahProposal }} Record</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAadendum') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-plus-square"></i> Adendum</h3>
                <p><strong style="color:green;">Online</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAsuratTugas') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file-signature"></i> Surat Tugas</h3>
                <p><strong>350</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Draft Resume</h3>
                <p><strong>2 dokumen</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Draft Laporan</h3>
                <p><strong >2 dokumen</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Buku Laporan Final</h3>
                <p><strong >6 dokumen</strong></p>
            </div>
        </a>
        <a href="" class="dashboard-card" style="display:block; color:inherit; text-decoration:none;">
            <h3><i class="fas fa-user"></i> Admin</h3>
            <p><strong>2 Staff</strong></p>
        </a>
    </div>

    <!-- Tabel Aktivitas -->
    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-clipboard-list"></i> Tugas Harian</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">No. PPJP</th>
                    <th style="padding:10px; text-align:center;">Tanggal Survei</th>
                    <th style="padding:10px; text-align:center;">Tim Lapangan</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">PT Caturkarda Depo Bangunan, Tbk</td>
                    <td style="padding:10px;">PT Caturkarda Depo Bangunan, Tbk</td>
                    <td style="padding:10px;">00166/RBY-PPJP/BKS/VIII/2024</td>
                    <td style="padding:10px;">17 Agustus 2023</td>
                    <td style="padding:10px;">Fajar</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Sukses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">Port Mori Corporation</td>
                    <td style="padding:10px;">Port Mori Corporation</td>
                    <td style="padding:10px;">01026/RBY-PPJP/BKS/VII/2024</td>
                    <td style="padding:10px;">24 Juli 2024</td>
                    <td style="padding:10px;">Jasmani</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Sukses</td>
                </tr>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">PT Bahagia Biru</td>
                    <td style="padding:10px;">PT Bahagia Biru</td>
                    <td style="padding:10px;">00199/RBY-PPJP/BKS/VI/2024</td>
                    <td style="padding:10px;">08 Oktober 2025</td>
                    <td style="padding:10px;">Santo</td>
                    <td style="padding:10px; text-align:center; color:green; font-weight:600;">Sukses</td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
