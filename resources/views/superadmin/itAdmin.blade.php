@extends('superadmin.app2')

@section('title', 'IT Admin')

@section('content')

<h1><i class="fas fa-server"></i> Dashboard IT</h1>
    <p>Ringkasan status infrastruktur dan aktivitas IT perusahaan.</p>

    <div class="dashboard-cards">
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-database"></i> Aset</h3>
                <p><strong>Total 33</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-network-wired"></i> Server</h3>
                <p><strong>12</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-computer"></i> Total Komputer</h3>
                <p><strong>15 PC</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-laptop"></i> Total Laptop</h3>
                <p><strong>10 Laptop</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-list"></i> Form Peminjaman</h3>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-square-check"></i> Laporan Penilaian</h3>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-user"></i> Staff</h3>
                <p><strong>2 Staff</strong></p>
            </div>
        </a>
    </div>




@endsection
