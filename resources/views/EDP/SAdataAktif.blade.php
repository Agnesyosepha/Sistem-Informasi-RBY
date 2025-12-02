@extends('superadmin.app2')

@section('title', 'Data Aktif')

@section('content')
<h1><i class="fas fa-server"></i> Data Aktif</h1>
<p>Daftar data aktif yang sedang diproses.</p>

<!-- Tombol Tambah Data -->
<button onclick="document.getElementById('modalTambahFinal').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Data
</button>

<style>
.input-field {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.btn-primary {
    background:#007BFF; 
    color:white; 
    padding:10px 18px; 
    border:none; 
    border-radius:6px; 
    cursor:pointer;
}
.btn-danger {
    background:#dc3545; 
    color:white; 
    padding:10px 18px; 
    border:none; 
    border-radius:6px; 
    cursor:pointer;
}
</style>

{{-- ================================
    MODAL TAMBAH DATA
================================ --}}
<div id="modalTambahFinal"
    style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
           background:rgba(0,0,0,0.5); padding-top:60px;">

    <div style="background:white; margin:auto; padding:20px; border-radius:10px;
                width:40%; max-height:80vh; overflow-y:auto; box-shadow:0 4px 12px rgba(0,0,0,0.2);">

        <h2 style="margin-bottom:15px;">Tambah Data Aktif</h2>

        <form action="{{ route('superadmin.edp.storeDataAktif') }}" method="POST">
            @csrf

            <label>Tanggal:</label>
            <input type="date" name="tanggal" required class="input-field">

            <label>Maksud & Tujuan:</label>
            <input type="text" name="jenis" required class="input-field">

            <label>Pemberi Tugas:</label>
            <input type="text" name="pemberi" required class="input-field">

            <label>Pengguna:</label>
            <input type="text" name="pengguna" required class="input-field">

            <label>Surveyor:</label>
            <input type="text" name="surveyor" required class="input-field">

            <label>Lokasi:</label>
            <input type="text" name="lokasi" required class="input-field">

            <label>Objek:</label>
            <input type="text" name="objek" required class="input-field">

            <label>Status Progres:</label>
            <select name="status_progres" required class="input-field">
                <option value="Proses">Proses</option>
                <option value="Selesai">Selesai</option>
                <option value="Reviewer">Reviewer</option>
            </select>

            <button type="submit" class="btn-primary">Simpan</button>
            <button type="button" onclick="document.getElementById('modalTambahFinal').style.display='none'"
                class="btn-danger" style="margin-left:10px;">Batal</button>
        </form>
    </div>
</div>


{{-- ================================
    MODAL EDIT STATUS
================================ --}}
<div id="modalEditStatus"
    style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
           background:rgba(0,0,0,0.5); padding-top:60px;">

    <div style="background:white; margin:auto; padding:20px; border-radius:10px;
                width:30%; max-height:60vh; box-shadow:0 4px 12px rgba(0,0,0,0.2);">

        <h2>Edit Status</h2>

        <form id="formEditStatus" method="POST">
            @csrf
            @method('PUT')

            <label>Status Progres:</label>
            <select name="status_progres" id="edit_status_progres" required class="input-field">
                <option value="Proses">Proses</option>
                <option value="Selesai">Selesai</option>
                <option value="Reviewer">Reviewer</option>
            </select>

            <button type="submit" class="btn-primary">Simpan</button>
            <button type="button"
                onclick="document.getElementById('modalEditStatus').style.display='none'"
                class="btn-danger" style="margin-left:10px;">Batal</button>
        </form>
    </div>
</div>


{{-- ================================
    TABEL DATA AKTIF
================================ --}}
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px;">Tanggal</th>
                <th style="padding:10px;">Maksud & Tujuan</th>
                <th style="padding:10px;">Pemberi Tugas</th>
                <th style="padding:10px;">Pengguna</th>
                <th style="padding:10px;">Surveyor</th>
                <th style="padding:10px;">Lokasi</th>
                <th style="padding:10px;">Objek</th>
                <th style="padding:10px;">Status</th>
                <th style="padding:10px;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($dataAktif as $data)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $data->tanggal }}</td>
                <td style="padding:10px;">{{ $data->jenis }}</td>
                <td style="padding:10px;">{{ $data->pemberi }}</td>
                <td style="padding:10px;">{{ $data->pengguna }}</td>
                <td style="padding:10px;">{{ $data->surveyor }}</td>
                <td style="padding:10px;">{{ $data->lokasi }}</td>
                <td style="padding:10px;">{{ $data->objek }}</td>

                <td style="padding:10px; font-weight:600;
                    color:
                        @if($data->status_progres === 'Selesai') #28a745
                        @elseif($data->status_progres === 'Reviewer') #007bff
                        @elseif($data->status_progres === 'Proses') #ffc107
                        @else #dc3545 @endif;">
                    {{ $data->status_progres }}
                </td>

                <!-- Aksi paling kanan -->
                <td style="padding:10px;">
                    <button onclick="openEditStatusModal('{{ $data->id }}', '{{ $data->status_progres }}')"
                        style="background:#17a2b8; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">
                        Edit
                    </button>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function openEditStatusModal(id, currentStatus) {
    document.getElementById('modalEditStatus').style.display = 'block';

    document.getElementById('formEditStatus').action =
        "/superadmin/edp/data-aktif/update-status/" + id;

    document.getElementById('edit_status_progres').value = currentStatus;
}
</script>

@endsection
