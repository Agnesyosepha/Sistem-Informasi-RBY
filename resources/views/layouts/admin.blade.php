@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<h1><i class="fas fa-user-cog"></i> Dashboard Admin</h1>
<p>Panel kontrol administrator untuk mengelola sistem dan pengguna.</p>

<!-- Statistik Utama -->
<div class="dashboard-cards">
    <a href="{{ route('admin.proposal') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file-invoice"></i> Daftar Proposal</h3>
            <p><strong>{{ $jumlahProposal }} Record</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.adendum') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-plus-square"></i> Adendum</h3>
            <p><strong style="color:green;">Online</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.suratTugas') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file-signature"></i> Surat Tugas</h3>
            <p><strong>350</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.draftResume') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file"></i> Draft Resume</h3>
            <p><strong>2 dokumen</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.draftLaporan') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file"></i> Draft Laporan</h3>
            <p><strong>2 dokumen</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.laporanFinal') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-book"></i> Buku Laporan Final</h3>
            <p><strong>6 dokumen</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.tim') }}" class="dashboard-card" style="display:block; color:inherit; text-decoration:none;">
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
                <th style="padding:10px; text-align:left;">No.PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Survei</th>
                <th style="padding:10px; text-align:left;">Tim Lapangan</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugasHarian as $tugas)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px; text-align:left; font-weight:600;">{{ $tugas->pemberi_tugas }}</td>
                    <td style="padding:10px; text-align:left; font-weight:600;">{{ $tugas->debitur }}</td>
                    <td style="padding:10px; text-align:left; font-weight:600;">{{ $tugas->no_ppjp }}</td>
                    <td style="padding:10px; text-align:left; font-weight:600;">{{ $tugas->tanggal_survei }}</td>
                    <td style="padding:10px; text-align:left; font-weight:600;">{{ $tugas->tim_lapangan }}</td>
                    <td style="padding:10px; text-align:left; font-weight:600;">
                            <span class="status-label" data-status="{{ $tugas->status }}">
                                {{ $tugas->status }}
                            </span>
                    </td>
                        
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('sidebar')
<aside class="sidebar" id="sidebar">
    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i><span> Home</span></a></li>
            <li><a href="{{ route('admin') }}" class="{{ request()->routeIs('admin*') ? 'active' : '' }}"><i class="fas fa-user-cog"></i><span> Admin</span></a></li>
            <li><a href="{{ route('surveyor') }}" class="{{ request()->routeIs('surveyor*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i><span> Surveyor</span></a></li>
            <li><a href="{{ route('edp') }}" class="{{ request()->routeIs('edp*') ? 'active' : '' }}"><i class="fas fa-desktop"></i><span> EDP</span></a></li>
            <li><a href="{{ route('reviewer') }}" class="{{ request()->routeIs('reviewer*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i><span> Reviewer</span></a></li>
            <li><a href="{{ route('finance') }}" class="{{ request()->routeIs('finance*') ? 'active' : '' }}"><i class="fas fa-file-invoice-dollar"></i><span> Finance</span></a></li>
            <li><a href="{{ route('it') }}" class="{{ request()->routeIs('it*') ? 'active' : '' }}"><i class="fas fa-server"></i><span> IT</span></a></li>
        </ul>
    </nav>
</aside>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        document.querySelector('.main-content').classList.toggle('collapsed');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".status-label").forEach(function(label) {
        const value = label.getAttribute("data-status");

        if (value === "Urgent") {
            label.style.color = "orange";
        } 
        else if (value === "Sangat Urgent") {
            label.style.color = "red";
        }
    });
});
</script>
@endsection

<style>
.sidebar nav ul li a.active {
    background-color: #ffc107;
    color: #111;
}
</style>
