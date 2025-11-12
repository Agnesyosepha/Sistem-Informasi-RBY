@extends('layouts.app')

@section('title', 'Upload Form Peminjaman')

@section('content')
<style>
/* Container */
.upload-container {
    background:#fff; 
    padding:25px; 
    border-radius:10px; 
    box-shadow:0 2px 8px rgba(0,0,0,0.05); 
    margin-top:20px;
}

/* Upload button */
.upload-btn {
    background: #138496;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: 0.25s;
    margin-bottom: 20px;
}
.upload-btn:hover { 
    background: #117a8b; 
    transform: translateY(-1px); 
}

/* Table */
.upload-table {
    width:100%;
    border-collapse: collapse;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
}
.upload-table th {
    background:#007bff;
    color:white;
    padding:12px;
    text-align:left;
}
.upload-table td {
    padding:12px;
    border-bottom:1px solid #e5e5e5;
}
.upload-table tr:nth-child(even){ background:#f8f9fa; }
.upload-table tr:hover { background:#f1f3f5; }

/* Status */
.status-finish {
    display:inline-block;
    padding:5px 12px;
    border-radius:6px;
    background:#28a745;
    color:white;
    font-weight:600;
    font-size:13px;
    text-align:center;
}

/* Toast notif */
.toast-notif {
    position: fixed; top: 20px; right: 20px;
    background: #28a745; color: white;
    padding: 12px 18px; border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    display: flex; align-items: center; gap: 8px;
    opacity: 0; pointer-events: none;
    transition: opacity 0.3s, transform 0.3s;
    z-index: 200;
}
.toast-notif.show { opacity: 1; transform: translateY(0); pointer-events: auto; }
</style>

<h1 class="fw-bold"><i class="fas fa-upload"></i> Upload Form Peminjaman</h1>
<p class="text-muted">Unggah form peminjaman yang telah diisi dan ditandatangani.</p>

@if(session('success'))
<div id="toastNotif" class="toast-notif">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="upload-container">
    <!-- Form Upload -->
    <form method="POST" action="{{ route('it.uploadForm.store') }}" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <input type="file" name="file" accept=".pdf" required style="display:none;" id="fileInput">
        <button type="button" class="upload-btn"><i class="fas fa-upload"></i> Upload Form</button>
    </form>

    <!-- Tabel File -->
    <table class="upload-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama File</th>
                <th>Tanggal Upload</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($files as $index => $file)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $file['nama'] }}</td>
                <td>{{ $file['tanggal'] }}</td>
                <td><span class="status-finish">Selesai</span></td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;color:#777; padding:12px;">Belum ada file.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
// Toast notif
const toast = document.getElementById('toastNotif');
if(toast){
    toast.classList.add('show');
    setTimeout(()=>{ toast.classList.remove('show'); }, 3000);
}

// Klik tombol upload untuk trigger file input
const uploadBtn = document.querySelector('.upload-btn');
const fileInput = document.getElementById('fileInput');
const form = document.getElementById('uploadForm');

uploadBtn.addEventListener('click', () => {
    fileInput.click(); // buka file chooser
});

fileInput.addEventListener('change', () => {
    if(fileInput.files.length > 0){
        form.submit(); // langsung submit setelah pilih file
    }
});
</script>
@endsection
