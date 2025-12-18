@extends('superadmin.app2')

@section('title', 'Reviewer Admin')

@section('content')

<h1><i class="fas fa-file-signature"></i> Reviewer Admin</h1>
    <p style="font-family: 'Great Vibes', cursive; font-weight: bold;">Ringkasan aktivitas Reviewer.</p>

    <div class="dashboard-cards">

        <a href="{{ route('superadmin.reviewer.SAdokumenRevisi') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file-alt"></i> Dokumen Revisi</h3>
                <p><strong>Daftar dokumen revisi</strong></p>
            </div>
        </a>

        <a href="{{ route('superadmin.reviewer.SAdokumenFinal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-check-circle"></i> Dokumen Final</h3>
                <p><strong>Daftar seluruh dokumen final</strong></p>
            </div>
        </a>
        {{--
        <a href="{{ route('superadmin.reviewer.SAlog') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-history"></i> Log Aktivitas</h3>
                <p><strong>{{ $totalLog ?? '—' }} Aktivitas</strong></p>
            </div>
        </a>
        --}}
    </div>




@endsection
