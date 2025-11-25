@extends('superadmin.app2')

@section('title', 'Reviewer Admin')

@section('content')

<h1><i class="fas fa-file-signature"></i> Reviewer Admin</h1>
    <p>Ringkasan aktivitas Reviewer.</p>

    <div class="dashboard-cards">

        <a href="{{ route('superadmin.reviewer.SAdokumenRevisi') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file-alt"></i> Dokumen Revisi</h3>
                <p><strong>8 Dokumen</strong></p>
            </div>
        </a>

        <a href="{{ route('superadmin.reviewer.SAdokumenFinal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-check-circle"></i> Dokumen Final</h3>
                <p><strong>8 Dokumen</strong></p>
            </div>
        </a>
    </div>




@endsection
