@extends('layouts.app')

@section('title', 'Dokumen Final EDP')

@section('content')
<style>
    /* HEADER */
    .page-header { margin-bottom: 25px; }
    .page-header h1 { display: flex; align-items: center; gap: 10px; font-weight: 700; }
    .page-header p { color: #6c757d; }

    /* SEARCH & FILTER */
    .search-upload-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .search-upload-wrapper form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }
    .search-upload-wrapper input,
    .search-upload-wrapper select {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ced4da;
        outline: none;
        font-size: 14px;
        transition: 0.2s;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .search-upload-wrapper input:focus,
    .search-upload-wrapper select:focus {
        border-color: #28a745;
        box-shadow: 0 0 5px rgba(40,167,69,0.3);
    }
    .search-btn {
        background: #28a745;
        color: white;
        padding: 9px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.25s;
    }
    .search-btn:hover { background: #218838; transform: translateY(-1px); }

    /* UPLOAD BUTTON */
    .upload-btn {
        background: #17a2b8;
        color: white;
        padding: 9px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.25s;
    }
    .upload-btn:hover { background: #138496; transform: translateY(-1px); }

    /* TABEL */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    thead { background: #007BFF; color: white; }
    th, td { padding: 12px 14px; border-bottom: 1px solid #e5e5e5; }
    tbody tr:hover { background: #f7f7f7; }
    .action-links {
        display: inline-flex;
        gap: 6px;
    }
    .download-link, .delete-link {
        text-decoration: none; font-weight: 500; font-size: 14px;
        padding: 6px 10px; border-radius: 6px;
        transition: 0.2s;
        display: inline-flex; align-items: center; gap: 4px;
    }
    .download-link { color: white; background: #28a745; }
    .download-link:hover { background: #218838; }
    .delete-link { color: white; background: #dc3545; }
    .delete-link:hover { background: #c82333; }

    /* MODAL */
    #uploadModal {
        display:none;
        position:fixed; top:0; left:0;
        width:100%; height:100%;
        background:rgba(0,0,0,.5);
        z-index:100;
        overflow-y:auto;
    }
    .modal-content {
        background:white;
        width:420px;
        max-width:90%;
        margin:120px auto;
        padding:25px;
        border-radius:8px;
        animation: fadeIn .3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }

    /* FILE INPUT CUSTOM */
    .custom-file-input { position: relative; width: 100%; height: 45px; margin-top: 10px; }
    .custom-file-input input[type="file"] { width: 100%; height: 100%; opacity: 0; position: absolute; cursor: pointer; }
    .custom-file-label {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        padding: 10px 15px; border: 1px solid #ced4da; border-radius: 6px;
        background: #f8f9fa; display: flex; align-items: center; gap: 10px;
        font-size: 14px; color: #495057; cursor: pointer; transition: 0.2s;
    }
    .custom-file-input input[type="file"]:hover + .custom-file-label { background: #e9ecef; }

    /* MODAL BUTTONS */
    .btn-cancel { padding: 10px 18px; border-radius: 6px; border: 1px solid #ced4da; background: #f1f3f5; color: #495057; font-weight: 500; cursor: pointer; transition: 0.2s; }
    .btn-cancel:hover { background: #e2e6ea; transform: translateY(-1px); }
    .btn-upload { padding: 10px 18px; border-radius: 6px; border: none; background: #28a745; color: white; font-weight: 500; cursor: pointer; transition: 0.2s; }
    .btn-upload:hover { background: #218838; transform: translateY(-1px); }

    /* TOAST NOTIF */
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

<div class="page-header">
    <h1><i class="fas fa-file-archive"></i> Dokumen Final</h1>
    <p class="text-muted">Daftar dokumen final EDP yang telah diupload.</p>
</div>

<div class="search-upload-wrapper">
    {{-- FORM FILTER & SEARCH --}}
    <form method="GET" action="{{ route('edp.dokumenFinal') }}">
        <input type="text" name="search" placeholder="Cari nama file..." value="{{ request('search') }}">
        <select name="bulan">
            <option value="">Semua Bulan</option>
            @foreach(range(1,12) as $m)
                <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="search-btn"><i class="fas fa-search"></i> Filter</button>
    </form>

    {{-- UPLOAD BUTTON --}}
    <button class="upload-btn" onclick="document.getElementById('uploadModal').style.display='block'">
        <i class="fas fa-upload"></i> Upload ZIP
    </button>
</div>

{{-- TABEL DOKUMEN --}}
<table>
    <thead>
        <tr>
            <th style="width:60px;">No</th>
            <th style="text-align:left;">Nama File</th>
            <th style="text-align:left;">Bulan</th>
            <th style="width:180px; text-align:center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dokumenFinal as $index => $file)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ basename($file['nama']) }}</td>
            <td>{{ \Carbon\Carbon::parse($file['tanggal'])->translatedFormat('F Y') }}</td>
            <td style="text-align:center;">
                <div class="action-links">
                    <a class="download-link" href="{{ asset('storage/'.$file['nama']) }}" download>
                        <i class="fas fa-download"></i> Download
                    </a>
                    <form action="{{ route('edp.deleteDokumenFinal', basename($file['nama'])) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-link">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align:center; padding:18px; color:#777;">Belum ada dokumen.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- MODAL UPLOAD --}}
<div id="uploadModal">
    <div class="modal-content">
        <h3 style="margin-bottom:15px;">Upload Dokumen Final (ZIP)</h3>
        <form method="POST" action="{{ route('edp.uploadDokumenFinal') }}" enctype="multipart/form-data">
            @csrf
            <div class="custom-file-input">
                <input type="file" name="data_zip" accept=".zip" required id="fileInput">
                <label for="fileInput" class="custom-file-label"><i class="fas fa-file-archive"></i> Pilih file ZIP...</label>
            </div>
            <div style="margin-top:20px; display:flex; justify-content:flex-end; gap:12px;">
                <button type="button" class="btn-cancel" onclick="document.getElementById('uploadModal').style.display='none'">Batal</button>
                <button type="submit" class="btn-upload">Upload</button>
            </div>
        </form>
    </div>
</div>

{{-- TOAST NOTIF --}}
@if(session('success'))
<div id="toastNotif" class="toast-notif"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div id="toastNotif" class="toast-notif" style="background:#dc3545;"><i class="fas fa-times-circle"></i> {{ session('error') }}</div>
@endif

<script>
    // File input label update
    const fileInput = document.getElementById('fileInput');
    const fileLabel = document.querySelector('.custom-file-label');
    fileInput.addEventListener('change', function() {
        if(this.files.length > 0) { fileLabel.textContent = this.files[0].name; }
        else { fileLabel.textContent = 'Pilih file ZIP...'; }
    });

    // Toast notif
    const toast = document.getElementById('toastNotif');
    if(toast){
        toast.classList.add('show');
        setTimeout(()=>{ toast.classList.remove('show'); }, 3000);
    }
</script>
@endsection
