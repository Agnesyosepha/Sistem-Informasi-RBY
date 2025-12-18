<!-- resources/views/admin.SAsuratTugas.blade.php -->
@extends('superadmin.app2')

@section('title', 'Surat Tugas')

@section('content')
    <h1><i class="fas fa-file-signature"></i> Input Surat Tugas</h1>
    <p>Berikut adalah daftar surat tugas yang telah dibuat oleh admin.</p>

    <!-- Tombol Tambah Surat Tugas -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Surat Tugas
    </button>

    <!-- Modal Tambah -->
    <div id="modalTambah" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
        
        <div style="
    background:white; margin:auto; padding:20px; border-radius:10px; width:45%;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
    max-height: 80vh; overflow-y: auto;">

            <h2 style="margin-bottom:15px;">Tambah Surat Tugas</h2>

            <form action="{{ route('superadmin.admin.SAsuratTugas.store') }}" method="POST">
                @csrf

                <label>Nomor PPJP</label>
                <input type="text" name="no_ppjp" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Survey</label>
                <input type="date" name="tanggal_survey" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Lokasi</label>
                <input type="text" name="lokasi" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Objek Penilaian</label>
                <input type="text" name="objek_penilaian" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Pemberi Tugas</label>
                <input type="text" name="pemberi_tugas" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                    
                <label>Nama Penilai</label>
                @for($i = 1; $i <= 5; $i++)
                    <select name="penilai[]" 
                        {{ $i == 1 ? 'required' : '' }}
                        style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                        
                        <option value="">
                            -- Pilih Nama Penilai {{ $i }} {{ $i == 1 ? '(Wajib)' : '(Opsional)' }}
                        </option>

                        @foreach($tim as $t)
                            <option value="{{ $t->nama }}">{{ $t->nama }}</option>
                        @endforeach
                    </select>
                @endfor

                <label>Adendum</label>
                <input type="text" name="adendum"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status" id="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="survey">Survey</option>
                    <option value="pending">Pending</option>
                </select>

                <button type="submit"
                    style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                    Simpan
                </button>

                <button type="button"
                    onclick="document.getElementById('modalTambah').style.display='none'"
                    style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                    Batal
                </button>
            </form>

        </div>
    </div>

    <!-- Modal Edit Status -->
    <div id="modalEdit" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">
        
        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Edit Status Surat Tugas</h2>

            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="id" id="editId">
                
                <label>Status</label>
                <select name="status" id="editStatus"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="survey">Survey</option>
                    <option value="pending">Pending</option>
                </select>
                
                <button type="submit"
                    style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                    Simpan
                </button>

                <button type="button"
                    onclick="document.getElementById('modalEdit').style.display='none'"
                    style="background:#6c757d; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                    Batal
                </button>
            </form>
        </div>
    </div>

    <!-- Tabel Surat Tugas -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">No.</th>
                    <th style="padding:10px; text-align:left;">no. PPJP</th>
                    <th style="padding:10px; text-align:left;">Tanggal Survey</th>
                    <th style="padding:10px; text-align:left;">Lokasi</th>
                    <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Nama Penilai</th>
                    <th style="padding:10px; text-align:left;">Adendum</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($suratTugas as $st)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $no++ }}</td>
                        <td style="padding:10px;">{{ $st->no_ppjp }}</td>
                        <td style="padding:10px;">{{ $st->tanggal_survey }}</td>
                        <td style="padding:10px;">{{ $st->lokasi }}</td>
                        <td style="padding:10px;">{{ $st->objek_penilaian }}</td>
                        <td style="padding:10px;">{{ $st->pemberi_tugas }}</td>
                        <td style="padding:10px;">{{ $st->nama_penilai }}</td>
                        <td style="padding:10px;">{{ $st->adendum ?? '-' }}</td>
                        <td style="padding:10px; text-align:center;">
                            <span style="
                                padding:5px 10px; border-radius:5px; font-weight:600;
                                {{ $st->status == 'survey' ? 'background:#e3f2fd; color:#1976d2;' : 'background:#fff3e0; color:#f57c00;' }}
                            ">
                                {{ ucfirst($st->status) }}
                            </span>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button onclick="showEditModal({{ $st->id }}, '{{ $st->status }}')" 
                                    style="background:#17a2b8; color:white; padding:6px 12px; border:none; border-radius:4px; cursor:pointer; margin-right:5px;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showDeleteModal({{ $st->id }})" 
                                    style="background:#dc3545; color:white; padding:6px 12px; border:none; border-radius:4px; cursor:pointer;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Hapus -->
    <div id="modalHapus" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">
        
        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus Surat Tugas ini?</p>
            <p style="color:red;">Tindakan ini tidak dapat dibatalkan!</p>

            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit"
                    style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                    Hapus
                </button>

                <button type="button"
                    onclick="document.getElementById('modalHapus').style.display='none'"
                    style="background:#6c757d; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                    Batal
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Fungsi untuk menampilkan modal edit
function showEditModal(id, status) {
    document.getElementById('editId').value = id;
    document.getElementById('editStatus').value = status;
    document.getElementById('formEdit').action = `/superadmin/admin/surat-tugas/${id}`;
    document.getElementById('modalEdit').style.display = 'block';
}

// Fungsi untuk menampilkan modal hapus
function showDeleteModal(id) {
    document.getElementById('formHapus').action = `/superadmin/admin/surat-tugas/${id}`;
    document.getElementById('modalHapus').style.display = 'block';
}

// Menutup modal saat klik di luar area modal
window.onclick = function(event) {
    if (event.target == document.getElementById('modalTambah')) {
        document.getElementById('modalTambah').style.display = 'none';
    }
    if (event.target == document.getElementById('modalEdit')) {
        document.getElementById('modalEdit').style.display = 'none';
    }
    if (event.target == document.getElementById('modalHapus')) {
        document.getElementById('modalHapus').style.display = 'none';
    }
}
</script>
@endsection