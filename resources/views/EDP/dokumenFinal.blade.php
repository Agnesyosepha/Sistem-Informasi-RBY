@extends('layouts.app')

@section('title', 'Dokumen Final EDP')

@section('content')
<style>
    .page-header { margin-bottom: 25px; }
    .page-header h1 {
        display: flex; align-items: center; gap: 10px; font-weight: 700;
    }
    .search-upload-wrapper {
        margin-top: 20px; display: flex; justify-content: space-between;
        align-items: center; flex-wrap: wrap; gap: 10px;
    }
    .upload-btn {
        background: #2ecc71; color: white; padding: 9px 16px;
        border-radius: 6px; border: none; cursor: pointer;
        display: inline-flex; align-items: center; gap: 6px;
        transition: 0.25s;
    }
    .upload-btn:hover { background: #27ae60; transform: translateY(-1px); }
    table {
        width: 100%; border-collapse: collapse; margin-top: 25px;
        background: white; border-radius: 8px; overflow: hidden;
    }
    thead { background: #007BFF; color: white; }
    th, td { padding: 12px 14px; border-bottom: 1px solid #e5e5e5; }
    tbody tr:hover { background: #f7f7f7; }
    .download-link, .delete-link {
        color: #007BFF; text-decoration: none; font-weight: 500;
    }
    .delete-link { color: #dc3545; margin-left: 10px; }
    .download-link:hover, .delete-link:hover { text-decoration: underline; }
    #uploadModal {
        display:none; position:fixed; top:0; left:0;
        width:100%; height:100%; background:rgba(0,0,0,.4); z-index:100;
    }
    .modal-content {
        background:white; width:420px; margin:120px auto; padding:20px;
        border-radius:8px; animation: fadeIn .3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="page-header">
    <h1><i class="fas fa-file-archive"></i> Dokumen Final</h1>
    <p class="text-muted">Daftar dokumen final EDP yang telah diupload.</p>
</div>

@if(session('success'))
<div style="background:#d4edda; border-left:5px solid #28a745; padding:12px; border-radius:6px; display:flex; align-items:center; gap:10px;">
    <i class="fas fa-check-circle" style="color:#28a745; font-size:18px;"></i>
    <span>{{ session('success') }}</span>
</div>
@endif
@if(session('error'))
<div style="background:#f8d7da; border-left:5px solid #dc3545; padding:12px; border-radius:6px; display:flex; align-items:center; gap:10px;">
    <i class="fas fa-times-circle" style="color:#dc3545; font-size:18px;"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

<div class="search-upload-wrapper">
    {{-- Form Search dan Filter Bulan --}}
    <form method="GET" action="{{ route('edp.dokumenFinal') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
        <input type="text" name="search" class="form-control" placeholder="Cari nama file..." value="{{ request('search') }}" style="width:220px;">
        <select name="bulan" class="form-control" style="width:150px;">
            <option value="">Semua Bulan</option>
            @foreach(range(1,12) as $m)
                <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
            @endforeach
        </select>
        <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
    </form>

    {{-- Tombol Upload --}}
    <button class="upload-btn" onclick="document.getElementById('uploadModal').style.display='block'">
        <i class="fas fa-upload"></i> Upload ZIP
    </button>
</div>

{{-- Tabel Dokumen --}}
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
            <td >{{ \Carbon\Carbon::parse($file['tanggal'])->translatedFormat('F Y') }}</td>
            <td style="text-align:center;">
                <a class="download-link" href="{{ asset('storage/'.$file['nama']) }}" download>
                    <i class="fas fa-download"></i> Download
                </a>
                <form action="{{ route('edp.deleteDokumenFinal', basename($file['nama'])) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-link" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
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
            <input type="file" name="data_zip" accept=".zip" required class="form-control">
            <div style="margin-top:18px; display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('uploadModal').style.display='none'">Batal</button>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </form>
    </div>
</div>

@endsection
