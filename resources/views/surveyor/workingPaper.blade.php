@extends('layouts.app')

@section('title', 'Working Paper')

@section('content')

<h1 class="fw-bold mb-2"><i class="fas fa-file-alt"></i> Working Paper</h1>
<p class="text-muted mb-4">Pilih jenis working paper dan download template pengerjaan.</p>

<div class="wp-wrapper">

    {{-- APARTEMEN --}}
    <div class="wp-card">
        <div class="wp-left">
            <div class="wp-icon purple">
                <i class="fas fa-building"></i>
            </div>

            <div class="wp-info">
                <h3 class="wp-title">Apartemen</h3>
                <p class="wp-desc">Dokumen untuk penilaian unit apartemen.</p>
            </div>
        </div>

        <a href="{{ asset('templates/apartemen.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download Template
        </a>
    </div>

    {{-- RUKO --}}
    <div class="wp-card">
        <div class="wp-left">
            <div class="wp-icon orange">
                <i class="fas fa-store"></i>
            </div>

            <div class="wp-info">
                <h3 class="wp-title">Ruko</h3>
                <p class="wp-desc">Dokumen untuk penilaian ruko atau tempat usaha.</p>
            </div>
        </div>

        <a href="{{ asset('templates/ruko.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download Template
        </a>
    </div>

    {{-- TANAH & BANGUNAN --}}
    <div class="wp-card">
        <div class="wp-left">
            <div class="wp-icon green">
                <i class="fas fa-home"></i>
            </div>

            <div class="wp-info">
                <h3 class="wp-title">Tanah & Bangunan</h3>
                <p class="wp-desc">Dokumen untuk penilaian tanah kosong atau tanah & bangunan.</p>
            </div>
        </div>

        <a href="{{ asset('templates/tanah_bangunan.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download Template
        </a>
    </div>

</div>

<style>
body {
    background: #f5f7fb;
}

/* WRAPPER */
.wp-wrapper {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 25px;
}

/* CARD */
.wp-card {
    background: #ffffff;
    padding: 22px 26px;
    border-radius: 14px;
    border: 1px solid #e6e9ef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: .25s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.wp-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.10);
}

/* LEFT SECTION */
.wp-left {
    display: flex;
    align-items: center;
    gap: 18px;
}

/* ICON */
.wp-icon {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
}

.wp-icon.purple {
    background: #f0e9ff;
    color: #6a30d8;
}

.wp-icon.orange {
    background: #ffe9d9;
    color: #d86619;
}

.wp-icon.green {
    background: #e8f8ed;
    color: #2e9d50;
}

/* TEXT */
.wp-title {
    margin: 0;
    font-weight: 600;
    font-size: 19px;
}

.wp-desc {
    margin: 4px 0 0;
    font-size: 14px;
    color: #6c7480;
}

/* BUTTON */
.wp-btn {
    background: linear-gradient(to right, #2e63d3, #4b88ff);
    color: #fff !important;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: .2s ease;
}

.wp-btn:hover {
    filter: brightness(1.1);
}
</style>

@endsection
