@extends('layouts.app')

@section('title', 'Laporan Penilaian')

@section('content')
<h1 class="fw-bold mb-2"><i class="fas fa-file-alt"></i> Laporan Penilaian</h1>
<p class="text-muted mb-4">Daftar laporan hasil penilaian yang telah dibuat oleh tim surveyor.</p>

<div class="lp-wrapper">

    {{-- 2022 --}}
    <div class="lp-card">
        <div class="lp-left">
            <div class="lp-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="lp-info">
                <h3 class="lp-title">Laporan Penilaian Tahun 2022</h3>
                <p class="lp-desc">Dokumen laporan resmi untuk penilaian tahun 2022.</p>
            </div>
        </div>

        <a href="{{ asset('templates/Database 2022.xlsx') }}" download class="lp-btn">
            <i class="fas fa-download"></i> Download
        </a>
    </div>

    {{-- 2023 --}}
    <div class="lp-card">
        <div class="lp-left">
            <div class="lp-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="lp-info">
                <h3 class="lp-title">Laporan Penilaian Tahun 2023</h3>
                <p class="lp-desc">Dokumen laporan resmi untuk penilaian tahun 2023.</p>
            </div>
        </div>

        <a href="{{ asset('templates/Database 2023.xlsx') }}" download class="lp-btn">
            <i class="fas fa-download"></i> Download
        </a>
    </div>

    {{-- 2024 --}}
    <div class="lp-card">
        <div class="lp-left">
            <div class="lp-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="lp-info">
                <h3 class="lp-title">Laporan Penilaian Tahun 2024</h3>
                <p class="lp-desc">Dokumen laporan resmi untuk penilaian tahun 2024.</p>
            </div>
        </div>

        <a href="{{ asset('templates/Database 2024.xlsx') }}" download class="lp-btn">
            <i class="fas fa-download"></i> Download
        </a>
    </div>

</div>

<style>
body {
    background: #f5f7fb;
}

.lp-wrapper {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}

.lp-card {
    background: #ffffff;
    padding: 22px 26px;
    border-radius: 14px;
    border: 1px solid #e5e8ef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: .25s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.04);
}

.lp-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}

.lp-left {
    display: flex;
    gap: 18px;
    align-items: center;
}

.lp-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    background: #e9f2ff;
    color: #2e63d3;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
}

.lp-info {
    display: flex;
    flex-direction: column;
}

.lp-title {
    margin: 0;
    font-weight: 600;
    font-size: 18px;
    color: #303640;
}

.lp-desc {
    margin: 4px 0 0;
    color: #6c7480;
    font-size: 14px;
}

.lp-btn {
    background: #2e63d3;
    color: white !important;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: .2s ease;
}

.lp-btn:hover {
    background: #244fa8;
}
</style>

@endsection
