@extends('layouts.app')

@section('title', 'Form Peminjaman')

@section('content')
<h1 class="fw-bold"><i class="fas fa-laptop"></i> Form Peminjaman</h1>
<p class="text-muted">Halaman ini digunakan untuk pengajuan peminjaman aset IT.</p>

<div class="fp-container">

    <!-- CARD DOWNLOAD TEMPLATE -->
    <div class="fp-card">
        <div class="fp-info">
            <h3 class="fp-title"><i class="fas fa-file-pdf"></i> Form Peminjaman Aset</h3>
            <p class="fp-desc">Silahkan download template form peminjaman aset IT, isi dan serahkan ke bagian IT.</p>
        </div>

        <a href="{{ asset('templates/formpeminjaman.pdf') }}" download class="fp-btn">
            <i class="fas fa-download"></i> Download Template
        </a>
    </div>

    <!-- CARD UPLOAD FORM -->
    <div class="fp-card upload-card" onclick="window.location.href='{{ route('it.uploadForm') }}'">
        <div class="fp-info">
            <h3 class="fp-title" style="color:#28a745;"><i class="fas fa-upload"></i> Upload Form Peminjaman</h3>
            <p class="fp-desc">Klik di sini untuk mengunggah form peminjaman yang telah diisi dan ditandatangani.</p>
        </div>
    </div>

    <!-- NOTE -->
    <div class="fp-note">
        <i class="fas fa-info-circle"></i> Pastikan form terisi lengkap sebelum dikirim ke bagian IT.
    </div>

</div>

@endsection

<style>
.fp-container {
    margin-top: 30px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.fp-card {
    background: #ffffff;
    border: 1px solid #e6e6e6;
    border-radius: 10px;
    padding: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 2px 8px rgba(0,0,0,0.05);
    transition: 0.2s ease;
    cursor: pointer;
}

.fp-card:hover {
    transform: translateY(-3px);
    box-shadow: 0px 6px 16px rgba(0,0,0,0.09);
}

.fp-title {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
}

.fp-desc {
    margin-top: 6px;
    color: #6c757d;
    font-size: 14px;
}

.fp-btn {
    background: #007bff;
    color: #fff !important;
    padding: 10px 18px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    border: none;
    cursor: pointer;
}

.fp-btn:hover {
    opacity: 0.9;
}

.fp-note {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f8f9fa;
    padding: 14px 16px;
    border-left: 4px solid #007bff;
    border-radius: 6px;
    color: #495057;
    font-size: 14px;
}
</style>
