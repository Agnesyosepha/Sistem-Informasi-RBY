@extends('layouts.app')

@section('title', 'IT Dashboard')

@section('content')
    <h1><i class="fas fa-server"></i> Dashboard IT</h1>
    <p>Ringkasan status infrastruktur dan aktivitas IT perusahaan.</p>

    <div class="dashboard-cards">
        <a href="{{ route('it.laporanPenilaian') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-file-alt"></i> Laporan Penilaian</h3>
                <p><strong>Dokumen Laporan Penilaian</strong></p>
            </div>
        </a>
        <a href="{{ route('it.formpeminjaman') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-list"></i> Form Peminjaman</h3>
                <p><strong>Alat & Barang</strong></p>
            </div>
        </a>
        <a href="{{ route('it.aset') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-database"></i> Aset</h3>
                <p><strong>Total 33</strong></p>
            </div>
        </a>
        <a href="{{ route('it.server') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-network-wired"></i> Server</h3>
                <p><strong>1 Server</strong></p>
            </div>
        </a>
        <a href="{{ route('it.totalKomputer') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-computer"></i> Total Komputer</h3>
                <p><strong>4 PC</strong></p>
            </div>
        </a>
        <a href="{{ route('it.totalLaptop') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-laptop"></i> Total Laptop</h3>
                <p><strong>10 Laptop</strong></p>
            </div>
        </a>
        <a href="{{ route('it.tim') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-user"></i> IT</h3>
                <p><strong>1 Staff</strong></p>
            </div>
        </a>
    </div>
@endsection
