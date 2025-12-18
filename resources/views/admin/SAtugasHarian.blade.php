@extends('superadmin.app2')

@section('title', 'Tugas Harian')

@section('content')
    <h1><i class="fas fa-tasks"></i> Tugas Harian</h1>
    <p>Daftar tugas harian dari setiap role dalam sistem.</p>

    <!-- Tombol Tambah Tugas -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Tugas
    </button>

    <!-- Modal Tambah -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">
        
        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Tugas</h2>

            <form action="{{ route('superadmin.admin.SAtugasHarian.store') }}" method="POST">
                @csrf

                <label>Pemberi Tugas</label>
                <input type="text" name="pemberi_tugas" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Debitur</label>
                <input type="text" name="debitur" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>No.PPJP</label>
                <input type="text" name="no_ppjp" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Survei</label>
                <input type="date" name="tanggal_survei" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tim Lapangan</label>
                <input type="text" name="tim_lapangan" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Urgent">Urgent</option>
                    <option value="Sangat Urgent">Sangat Urgent</option>
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
    <div id="modalEditStatus" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">
        
        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Edit Status Tugas</h2>

            <form id="formEditStatus" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                
                <input type="hidden" id="edit_tugas_id" name="tugas_id">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Urgent">Urgent</option>
                    <option value="Sangat Urgent">Sangat Urgent</option>
                </select>

                <button type="submit"
                    style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                    Update
                </button>

                <button type="button"
                    onclick="document.getElementById('modalEditStatus').style.display='none'"
                    style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                    Batal
                </button>
            </form>
        </div>
    </div>

    <!-- Tabel -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">No.PPJP</th>
                    <th style="padding:10px; text-align:left;">Tanggal Survei</th>
                    <th style="padding:10px; text-align:left;">Tim Lapangan</th>
                    <th style="padding:10px; text-align:left;">Status</th>
                    <th style="padding:10px; text-align:left;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tugasHarian as $tugas)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;  text-align:left;">{{ $tugas->pemberi_tugas }}</td>
                        <td style="padding:10px;  text-align:left;">{{ $tugas->debitur }}</td>
                        <td style="padding:10px;  text-align:left;">{{ $tugas->no_ppjp }}</td>
                        <td style="padding:10px;  text-align:left;">{{ $tugas->tanggal_survei }}</td>
                        <td style="padding:10px;  text-align:left;">{{ $tugas->tim_lapangan }}</td>
                        <td style="padding:10px;  text-align:left;">
                            <span style="padding:6px; border-radius:5px; font-weight:600; 
                                {{ $tugas->status == 'Urgent' ? 'color: orange;' : 'color: red;' }}">
                                {{ $tugas->status }}
                            </span>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button type="button"
                                onclick="openEditModal({{ $tugas->id }}, '{{ $tugas->status }}')"
                                style="background:#17a2b8; color:white; padding:6px 12px; border:none; border-radius:4px; cursor:pointer; margin-right:5px;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button"
                                onclick="openModal('{{ route('superadmin.admin.SAtugasHarian.destroyTugas', $tugas->id) }}')"
                                style="background:#dc3545; color:white; padding:6px 12px; border:none; border-radius:4px; cursor:pointer;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" style="
    display:none; position:fixed; z-index:2000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="background:white; margin:auto; padding:20px;
        border-radius:10px; width:30%;
        box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        
        <h3 style="margin-bottom:15px;">Konfirmasi Hapus</h3>
        <p>Apakah kamu yakin ingin menghapus Tugas Harian ini?</p>

        <form id="formHapus" method="POST" style="display:flex; gap:10px; margin-top:15px;">
        @csrf
        @method('DELETE')

        <button type="submit" 
            style="background:#dc3545; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Hapus
        </button>

        <button type="button" onclick="closeModal()"
            style="background:#6c757d; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Batal
        </button>
        </form>
    </div>
</div>

@section('scripts')
<script>
// Hapus
function openModal(actionUrl) {
    document.getElementById('formHapus').action = actionUrl;
    document.getElementById('modalHapus').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalHapus').style.display = 'none';
}

// Edit Status
function openEditModal(tugasId, currentStatus) {
    document.getElementById('edit_tugas_id').value = tugasId;
    
    // Set the current status in the dropdown
    const statusSelect = document.querySelector('#modalEditStatus select[name="status"]');
    Array.from(statusSelect.options).forEach(option => {
        option.selected = (option.value === currentStatus);
    });
    
    // Set form action
    document.getElementById('formEditStatus').action = `/superadmin/admin/tugas-harian/update-status/${tugasId}`;
    
    // Show modal
    document.getElementById('modalEditStatus').style.display = 'block';
}
</script>
@endsection