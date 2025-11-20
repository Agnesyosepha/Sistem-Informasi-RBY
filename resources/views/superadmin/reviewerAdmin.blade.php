@extends('superadmin.app2')

@section('title', 'Reviewer Admin')

@section('content')

<h1><i class="fas fa-file-signature"></i> Reviewer Admin</h1>
    <p>Ringkasan aktivitas Reviewer.</p>

    <div class="dashboard-cards">
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-users"></i> Reviewer</h3>
                <p><strong>1 Staff</strong></p>
            </div>
        </a>

        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-server"></i> Dokumen Revisi</h3>
                <p><strong>8 Dokumen</strong></p>
            </div>
        </a>

        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-server"></i> Dokumen Final</h3>
                <p><strong>8 Dokumen</strong></p>
            </div>
        </a>
    </div>




@endsection
