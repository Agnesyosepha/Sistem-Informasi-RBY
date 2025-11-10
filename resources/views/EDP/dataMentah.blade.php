@extends('layouts.app')

@section('title', 'Data Mentah EDP')

@section('content')
<style>
    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
    }

    .search-upload-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .upload-btn {
        background: #2ecc71;
        color: white;
        padding: 9px 16px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: 0.25s;
    }

    .upload-btn:hover {
        background: #27ae60;
        transform: translateY(-1px);
    }

    /* Table Style */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }

    thead {
        background: #007BFF;
        color: white;
    }

    th, td {
        padding: 12px 14px;
        border-bottom: 1px solid #e5e5e5;
    }

    tbody tr:hover {
        background: #f7f7f7;
    }

    .download-link {
        color: #007BFF;
        text-decoration: none;
        font-weight: 500;
    }

    .download-link:hover {
        text-decoration: underline;
    }

    /* Modal */
    #uploadModal {
        display:none;
        position:fixed;
        top:0; left:0;
        width:100%; height:100%;
        background:rgba(0,0,0,.4);
        z-index:100;
    }

    .modal-content {
        background:white;
        width:420px;
        margin:120px auto;
        padding:20px;
        border-radius:8px;
        animation: fadeIn .3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>

<div class="page-header">
    <h1><i class="fas fa-database"></i> Data Mentah</h1>
    <p class="text-muted">Daftar data mentah yang masuk dalam proses EDP.</p>
</div>

@if(session('success'))
<div style="background:#d4edda; border-left:5px solid #28a745; padding:12px; border-radius:6px; display:flex; align-items:center; gap:10px;">
    <i class="fas fa-check-circle" style="color:#28a745; font-size:18px;"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<div class="search-upload-wrapper">
    
    <form method="GET" action="" style="display:flex; gap:10px;">
        <input type="text" name="search" class="form-control" placeholder="Cari data..." style="width:240px;">
        <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
    </form>

    <button class="upload-btn" onclick="document.getElementById('uploadModal').style.display='block'">
        <i class="fas fa-upload"></i> Upload ZIP
    </button>
</div>

<table>
    <thead>
        <tr>
            <th style="width:60px;">No</th>
            <th>Nama File</th>
            <th style="width:150px; text-align:center;">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($files as $index => $file)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ basename($file) }}</td>
            <td style="text-align:center;">
                <a class="download-link" href="{{ asset('storage/'.$file) }}" download>Download</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" style="text-align:center; padding:18px; color:#777;">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- MODAL UPLOAD -->
<div id="uploadModal">
    <div class="modal-content">
        <h3 style="margin-bottom:15px;">Upload Data Mentah (ZIP)</h3>
        <form method="POST" action="{{ route('edp.uploadData') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="data_zip" accept=".zip" required class="form-control">
            <div style="margin-top:18px; display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('uploadModal').style.display='none'">Batal</button>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </form>
    </div>
</div>

@endsection
