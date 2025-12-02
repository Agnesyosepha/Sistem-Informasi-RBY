@extends('superadmin.app2')

@section('title', 'Data Admin')

@section('content')

<h1><i class="fas fa-user-cog"></i> Admin Admin</h1>
    <p>Panel kontrol administrator untuk mengelola sistem dan pengguna.</p>

    <!-- Statistik Utama -->
    <div class="dashboard-cards">
        <a href="{{ route('superadmin.admin.SAproposal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file-invoice"></i> Daftar Proposal</h3>
                <p><strong>{{ $jumlahProposal }} Record</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAadendum') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-plus-square"></i> Adendum</h3>
                <p><strong>Daftar Adendum yang Diajukan</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAsuratTugas') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file-signature"></i> Surat Tugas</h3>
                <p><strong>Surat Tugas yang Diterbitkan</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAdraftResume') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Draft Resume</h3>
                <p><strong>Draft Resume Hasil Penilaian</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAdraftLaporan') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Draft Laporan</h3>
                <p><strong >Draft Laporan Penilaian</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAlaporanFinal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-book"></i> Buku Laporan Final</h3>
                <p><strong >Draft Laporan Penilaian</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAtugasHarian') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-tasks"></i> Tugas Harian</h3>
                <p><strong >Daftar Tugas Harian</strong></p>
            </div>
        </a>
        
    </div>

    

@endsection
