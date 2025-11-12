@extends('layouts.app')

@section('title', 'Upload Form Peminjaman')

@section('content')
<h1 class="fw-bold"><i class="fas fa-upload"></i> Upload Form Peminjaman</h1>
<p class="text-muted">Unggah form peminjaman yang telah diisi dan ditandatangani.</p>

<div class="upload-container">
    <!-- Tombol tambah upload -->
    <button type="button" id="addFileBtn" class="btn-add">
        <i class="fas fa-plus"></i> Tambah Upload
    </button>

    <!-- Input file tersembunyi -->
    <input type="file" id="fileInput" accept=".pdf" style="display:none">

    <!-- Tabel daftar upload -->
    <table class="upload-table" id="uploadTable">
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th>Nama File</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- data akan muncul di sini -->
        </tbody>
    </table>
</div>
@endsection

<style>
.upload-container {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 2px 8px rgba(0,0,0,0.05);
    margin-top: 20px;
}

.btn-add {
    background: #28a745;
    color: #fff;
    border: none;
    padding: 10px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 15px;
}
.btn-add:hover { opacity: 0.9; }

.upload-table {
    width: 100%;
    border-collapse: collapse;
}
.upload-table th, .upload-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}
.upload-table th {
    background-color: #007bff;
    color: #fff;
}
.upload-table tr:nth-child(even) {
    background-color: #f8f9fa;
}
.status-finish {
    color: #28a745;
    font-weight: bold;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addFileBtn = document.getElementById('addFileBtn');
    const fileInput = document.getElementById('fileInput');
    const uploadTable = document.getElementById('uploadTable').querySelector('tbody');
    let counter = 1;

    addFileBtn.addEventListener('click', () => {
        fileInput.click(); // buka file picker
    });

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (!file) return;

        // validasi ekstensi
        const allowed = ['application/pdf'];
        if (!allowed.includes(file.type)) {
            alert('Hanya file PDF yang diperbolehkan.');
            fileInput.value = '';
            return;
        }

        // buat form data untuk kirim lewat fetch
        const formData = new FormData();
        formData.append('file', file);
        formData.append('_token', '{{ csrf_token() }}');

        // upload ke server
        fetch('{{ route("it.uploadForm.store") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${counter++}</td>
                    <td>${data.filename}</td>
                    <td class="status-finish">Selesai</td>
                `;
                uploadTable.appendChild(row);
            } else {
                alert('Gagal upload file.');
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan saat upload.');
            console.error(err);
        });

        // reset input supaya bisa pilih lagi
        fileInput.value = '';
    });
});
</script>
