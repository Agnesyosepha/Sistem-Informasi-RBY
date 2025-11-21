@extends('superadmin.app2')

@section('title', 'Surveyor Admin')

@section('content')

<h1><i class="fas fa-clipboard-list"></i> Surveyor Admin</h1>

<div class="dashboard-cards">
     <a href="{{ route('superadmin.admin.SAlokasiSurvei') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-map-marker-alt"></i> Lokasi Survei</h3>
                <p><strong>25 Lokasi</strong></p>
            </div>
        </a>
        <a href="" class="dashboard-card" style="display:block; color:inherit; text-decoration:none;">
            <h3><i class="fas fa-user"></i> Surveyor</h3>
            <p><strong>10 Staff</strong></p>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-sync-alt"></i> Update Proyek</h3>
                <p><strong>Ringkasan Semua Status Proyek</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-tasks"></i> Working Paper</h3>
                <p><strong>11 Dokumen</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Laporan Penilaian</h3>
                <p><strong >6 dokumen</strong></p>
            </div>
        </a>
</div>

@endsection
