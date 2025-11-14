@extends('layouts.app')

@section('title', 'Laporan Penilaian')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Laporan Penilaian</h1>
    <p>Daftar laporan hasil penilaian yang telah dibuat oleh tim surveyor.</p>

    <div class="wp-wrapper">

    {{-- 2022 --}}
    <div class="wp-card">
        <div class="wp-info">
            <h3 class="wp-title">Laporan Penilaian Tahun 2022</h3>
            <p class="wp-desc">Dokumen laporan untuk penilaian tahun 2022.</p>
        </div>
        <a href="{{ asset('templates/Database 2022.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download
        </a>
    </div>

    {{-- 2023 --}}
    <div class="wp-card">
        <div class="wp-info">
            <h3 class="wp-title">Laporan Penilaian Tahun 2023</h3>
            <p class="wp-desc">Dokumen laporan untuk penilaian tahun 2023.</p>
        </div>
        <a href="{{ asset('templates/Database 2023.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download
        </a>
    </div>

    {{-- 2024 --}}
    <div class="wp-card">
        <div class="wp-info">
            <h3 class="wp-title">Laporan Penilaian Tahun 2024</h3>
            <p class="wp-desc">Dokumen laporan untuk penilaian tahun 2024.</p>
        </div>
        <a href="{{ asset('templates/Database 2024.xlsx') }}" download class="wp-btn">
            <i class="fas fa-download"></i> Download
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
