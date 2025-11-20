@extends('superadmin.app2')

@section('title', 'EDP Admin')

@section('content')

<h1><i class="fas fa-desktop"></i> EDP Admin</h1>
    <p>Ringkasan aktivitas Electronic Data Processing (EDP).</p>

    <div class="dashboard-cards">
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-server"></i> Data Aktif</h3>
                <p><strong>8 Data Aktif</strong></p>
            </div>
        </a>
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-file-archive"></i> Dokumen Final</h3>
                <p><strong>Lihat Dokumen</strong></p>
            </div>
        </a>
        
        
        <a href="" style="text-decoration:none; color:inherit;">
                <div class="dashboard-card" style="cursor:pointer;">
                    <h3><i class="fas fa-users"></i> EDP</h3>
                    <p><strong>3 Staff</strong></p>
                </div>
        </a>

    </div>




@endsection
