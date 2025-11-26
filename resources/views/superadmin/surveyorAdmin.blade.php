@extends('superadmin.app2')

@section('title', 'Surveyor Admin')

@section('content')

<h1><i class="fas fa-clipboard-list"></i> Surveyor Admin</h1>
<p>Ringkasan aktivitas surveyor.</p>

<div class="dashboard-cards">
     <a href="{{ route('superadmin.admin.SAlokasiSurvei') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-map-marker-alt"></i> Lokasi Survei</h3>
                <p><strong>25 Lokasi</strong></p>
            </div>
        </a>
       <a href="{{ route('superadmin.admin.SAupdateProyek') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-chart-line"></i> Update Proyek</h3>
                <p><strong>Ringkasan Semua Status Proyek</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.admin.SAlaporanpenilaianfinal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Laporan Penilaian</h3>
                <p><strong >6 dokumen</strong></p>
            </div>
        </a>
        <a href="{{ route('superadmin.jadwal.index') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-calendar-alt"></i> Jadwal Surveyor</h3>
                <p><strong>6 Jadwal</strong></p>
            </div>
        </a>
</div>

@endsection
