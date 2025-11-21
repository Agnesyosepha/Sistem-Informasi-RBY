@extends('superadmin.app2')

@section('title', 'Surat Tugas')

@section('content')

<style>
/* ===================== MODAL STYLE ===================== */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    backdrop-filter: blur(4px);
    z-index: 1000;
}

.modal-box {
    background: #fff;
    width: 40%;
    padding: 25px 30px;
    margin: 80px auto;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    animation: fadeIn 0.25s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.modal-title {
    margin-bottom: 20px;
    font-size: 22px;
    font-weight: bold;
    color: #333;
}

.input-style {
    width: 100%;
    padding: 10px 12px;
    margin-top: 5px;
    border: 1px solid #bfc4d1;
    border-radius: 8px;
    font-size: 14px;
}

.form-group { margin-bottom: 15px; }

.btn-primary {
    background: #007bff;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.btn-primary:hover { background: #0069d9; }

.btn-danger {
    background: #dc3545;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.btn-danger:hover { background: #c82333; }

.modal-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

/* Button Tambah */
.btn-add {
    background:#28a745;
    color:white;
    padding:10px 18px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    margin-top:20px;
}
.btn-add:hover { background:#218838; }

/* Table */
.table-header {
    background:#007BFF; 
    color:white;
}
</style>



<h1><i class="fas fa-file-signature"></i> Input Surat Tugas</h1>

<button class="btn-add" onclick="openModal()">
    + Tambah Surat Tugas
</button>


<!-- ===================== MODAL TAMBAH ===================== -->
<div id="modalTambah" class="modal-overlay">
    <div class="modal-box">

        <h2 class="modal-title">Tambah Surat Tugas</h2>

        <form action="{{ route('superadmin.admin.SAsuratTugas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nomor PPJP</label>
                <input type="text" name="no_ppjp" required class="input-style">
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" required class="input-style">
            </div>

            <div class="form-group">
                <label>Pemberi Tugas</label>
                <input type="text" name="pemberi_tugas" required class="input-style">
            </div>

            <div class="form-group">
                <label>Nama Penilai</label>
                <input type="text" name="nama_penilai" required class="input-style">
            </div>

            <div class="form-group">
                <label>Adendum</label>
                <input type="text" name="adendum" class="input-style">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="input-style">
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <div class="modal-buttons">
                <button type="submit" class="btn-primary">Simpan</button>
                <button type="button" class="btn-danger" onclick="closeModal()">Batal</button>
            </div>
        </form>

    </div>
</div>



<!-- ===================== TABEL ===================== -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse;">
        <thead class="table-header">
            <tr>
                <th>Nomor PPJP</th>
                <th>Tanggal</th>
                <th>Pemberi Tugas</th>
                <th>Penilai</th>
                <th>Adendum</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suratTugas as $st)
            <tr>
                <td>{{ $st->no_ppjp }}</td>
                <td>{{ $st->tanggal }}</td>
                <td>{{ $st->pemberi_tugas }}</td>
                <td>{{ $st->nama_penilai }}</td>
                <td>{{ $st->adendum ?? '-' }}</td>
                <td>{{ $st->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
function openModal() {
    document.getElementById('modalTambah').style.display = 'block';
}
function closeModal() {
    document.getElementById('modalTambah').style.display = 'none';
}
</script>

@endsection
