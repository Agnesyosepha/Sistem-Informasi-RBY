@extends('layouts.app')

@section('title', 'Working Paper')

@section('content')
<h1 class="fw-bold mb-2"><i class="fas fa-file-alt"></i> Working Paper</h1>
<p class="text-muted mb-4">Pilih jenis working paper dan download template pengerjaan.</p>

<div class="wp-wrapper">

    {{-- APARTEMEN --}}
    <div class="wp-card">
        <div class="wp-info">
            <h3 class="wp-title">Apartemen</h3>
            <p class="wp-desc">Dokumen untuk penilaian unit apartemen.</p>
        </div>
        <a href="{{ asset('templates/apartemen.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download Template
        </a>
    </div>

    {{-- RUKO --}}
    <div class="wp-card">
        <div class="wp-info">
            <h3 class="wp-title">Ruko</h3>
            <p class="wp-desc">Dokumen untuk penilaian ruko atau tempat usaha.</p>
        </div>
        <a href="{{ asset('templates/ruko.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download Template
        </a>
    </div>

    {{-- TANAH & BANGUNAN --}}
    <div class="wp-card">
        <div class="wp-info">
            <h3 class="wp-title">Tanah & Bangunan</h3>
            <p class="wp-desc">Dokumen untuk penilaian tanah kosong atau tanah & bangunan.</p>
        </div>
        <a href="{{ asset('templates/tanah_bangunan.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download Template
        </a>
    </div>

</div>

<style>
.wp-wrapper {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-top: 20px;
}

.wp-card {
    background: #ffffff;
    padding: 22px 28px;
    border-radius: 10px;
    border: 1px solid #e6e9ef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: .25s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
}

.wp-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
}

.wp-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.wp-title {
    margin: 0;
    font-weight: 600;
    font-size: 20px;
}

.wp-desc {
    margin: 0;
    color: #6c757d;
    font-size: 14px;
}

.wp-btn {
    background: #007bff;
    color: white !important;
    padding: 10px 18px;
    border-radius: 7px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: .2s;
}

.wp-btn:hover {
    background: #005fcc;
}
</style>
@endsection
