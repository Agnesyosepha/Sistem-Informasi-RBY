@extends('layouts.app')

@section('title', 'Form Peminjaman')

@section('content')

<h1 class="fw-bold mb-2"><i class="fas fa-laptop"></i> Form Peminjaman</h1>
<p class="text-muted mb-4">Halaman ini digunakan untuk pengajuan peminjaman aset IT.</p>

<div class="fp-container">

    <!-- DOWNLOAD -->
    <div class="fp-card">

        <div class="fp-header fp-between">

            <div class="fp-left">
                <div class="fp-icon red">
                    <i class="fas fa-file-pdf"></i>
                </div>

                <div class="fp-text">
                    <h3 class="fp-title">Form Peminjaman Aset</h3>
                    <p class="fp-desc">Silahkan download template form peminjaman aset IT dan serahkan ke bagian IT.</p>
                </div>
            </div>

            <!-- tombol tetap di ujung kanan -->
            <a href="{{ asset('templates/formpeminjaman.pdf') }}" download class="fp-btn">
                <i class="fas fa-download"></i> Download
            </a>

        </div>

    </div>

    <!-- UPLOAD -->
    <div class="fp-card fp-click" onclick="window.location.href='{{ route('it.uploadForm') }}'">

        <!-- TEKS TETAP DI KIRI -->
        <div class="fp-header fp-left-only">

            <div class="fp-icon blue">
                <i class="fas fa-upload"></i>
            </div>

            <div class="fp-text">
                <h3 class="fp-title">Upload Form Peminjaman</h3>
                <p class="fp-desc">Unggah form peminjaman yang sudah ditandatangani.</p>
            </div>

        </div>

    </div>

    <!-- NOTE -->
    <div class="fp-note">
        <i class="fas fa-info-circle"></i> Pastikan form terisi lengkap sebelum dikirim ke bagian IT.
    </div>

</div>

@endsection

<style>
body {
    background: #f5f7fb;
}

.fp-container {
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.fp-card {
    background: #ffffff;
    padding: 22px 24px;
    border-radius: 14px;
    border: 1px solid #e5e8ef;
    box-shadow: 0 4px 10px rgba(0,0,0,0.04);
    transition: .25s ease;
}

.fp-card:hover {
    box-shadow: 0 6px 16px rgba(0,0,0,0.06);
    transform: translateY(-2px);
    cursor: pointer;
}

.fp-click:hover {
    cursor: pointer;
}

/* ===== FLEX ===== */
.fp-header {
    display: flex;
    gap: 18px;
    align-items: center;
    width: 100%;
}

.fp-between {
    justify-content: space-between;
}

.fp-left-only {
    justify-content: flex-start;
}

.fp-left {
    display: flex;
    gap: 18px;
    align-items: center;
}

/* ICON */
.fp-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
}

.fp-icon.red {
    background: #ffe5e5;
    color: #d63636;
}

.fp-icon.blue {
    background: #e6efff;
    color: #2e63d3;
}

/* TEXT */
.fp-title {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #303640;
}

.fp-desc {
    margin: 4px 0 0;
    font-size: 14px;
    color: #6c7480;
}

/* BUTTON */
.fp-btn {
    background: #2e63d3;
    color: #fff !important;
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 14px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* NOTE */
.fp-note {
    background: #eef4ff;
    border-left: 4px solid #2e63d3;
    padding: 12px 16px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #405070;
}
</style>
