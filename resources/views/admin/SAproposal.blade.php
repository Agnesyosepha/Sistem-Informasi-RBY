@extends('superadmin.app2')

@section('title', 'Proposal')

@section('content')
    <h1><i class="fas fa-file-invoice"></i> Daftar Proposal</h1>
    <p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <!-- Tombol Tambah Proposal -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Proposal
    </button>

    <!-- Modal -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">
        
        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Proposal</h2>

            <form action="{{ route('superadmin.admin.SAproposal.store') }}" method="POST" id="formTambah">
                @csrf

                <label>No PPJP</label>
                <input type="text" name="no_ppjp" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Objek Penilaian</label>
                <input type="text" name="judul" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Pemberi Tugas</label>
                <input type="text" name="pengaju" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Disetujui <span style="color:red;">*</span></label>
                <input type="date" name="tgl_disetujui" required id="tgl_disetujui"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Berakhir <span style="color:red;">*</span></label>
                <input type="date" name="tgl_berakhir" required id="tgl_berakhir"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Menunggu Review">Menunggu Review</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Direvisi">Direvisi</option>
                    <option value="Proses">Proses</option>
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

    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">No PPJP</th>
                    <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:left;">Status</th>
                    <th style="padding:10px; text-align:left;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;" data-id="{{ $p->id }}">
                        <td style="padding:10px;">{{ $p->no_ppjp ?? '-' }}</td>
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_pengajuan'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_berakhir'] }}</td>
                        <td style="padding:10px; font-weight:600; color:
                            @if($p->status === 'Disetujui') #28a745
                            @elseif($p->status === 'Menunggu Review') #ffc107
                            @elseif($p->status === 'Direvisi') #17a2b8
                            @elseif($p->status === 'Proses') #007bff
                            @else #dc3545 @endif;" class="status-cell">
                            {{ $p->status }}
                        </td>
                        <td style="padding:10px;">
                            <button onclick="openEditStatusModal('{{ $p->id }}', '{{ $p->status }}')"
                                class="btn-icon btn-edit" title="Edit Status">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <button onclick="openDeleteModal('{{ route('superadmin.admin.SAproposal.destroy', $p->id) }}')"
                                class="btn-icon btn-delete" title="Hapus Data">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

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
            <select name="status" id="edit_status" required class="input-field">
                <option value="Menunggu Review">Menunggu Review</option>
                <option value="Disetujui">Disetujui</option>
                <option value="Direvisi">Direvisi</option>
                <option value="Proses">Proses</option>
            </select>

            <button type="submit" class="btn-primary">Simpan</button>
            <button type="button"
                onclick="document.getElementById('modalEditStatus').style.display='none'"
                class="btn-danger" style="margin-left:10px;">Batal</button>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" style="
    display:none; position:fixed; z-index:2000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="background:white; margin:auto; padding:20px;
        border-radius:10px; width:30%; text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        
        <h3 style="margin-bottom:15px;">Konfirmasi Hapus</h3>
        <p>Apakah kamu yakin ingin menghapus proposal ini?</p>

        <form id="formHapus" method="POST" style="display:flex; gap:10px; justify-content:center; margin-top:15px;">
        @csrf
        @method('DELETE')

        <button type="submit" 
            style="background:#dc3545; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Ya, Hapus!
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
.btn-icon {
    border: none;
    padding: 8px 10px;
    border-radius: 6px;
    cursor: pointer;
    margin: 0 3px;
    font-size: 14px;
}
.btn-edit {
    background: #17a2b8;
    color: white;
}
.btn-delete {
    background: #dc3545;
    color: white;
}
</style>

<script>
// Variabel untuk menyimpan ID proposal yang sedang diedit
let currentProposalId = null;

function openEditStatusModal(id, currentStatus) {
    currentProposalId = id; // Simpan ID ke variabel global
    document.getElementById('modalEditStatus').style.display = 'block';

    // Gunakan route helper untuk membuat URL yang benar
    document.getElementById('formEditStatus').action = "{{ route('superadmin.admin.proposal.updateStatus', ':id') }}".replace(':id', id);

    document.getElementById('edit_status').value = currentStatus;
}

function openDeleteModal(url) {
    document.getElementById('modalHapus').style.display = 'block';
    document.getElementById('formHapus').action = url;
}

function closeModal() {
    document.getElementById('modalHapus').style.display = 'none';
}

// Tangani pengiriman form edit status dengan AJAX
document.getElementById('formEditStatus').addEventListener('submit', function(e) {
    e.preventDefault(); // Cegah pengiriman form standar

    const form = e.target;
    const formData = new FormData(form);
    
    // Ubah method dari POST ke PUT untuk sesuai dengan route
    formData.set('_method', 'PUT');

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Tutup modal
        document.getElementById('modalEditStatus').style.display = 'none';

        // Cari baris tabel yang sesuai berdasarkan ID
        const row = document.querySelector(`tr[data-id="${currentProposalId}"]`);
        if (row) {
            // Cari sel status di dalam baris tersebut
            const statusCell = row.querySelector('.status-cell');
            if (statusCell) {
                // Update teks status
                statusCell.textContent = data.new_status;

                // Update warna status
                applyColorToCell(statusCell, data.new_status);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui status.');
    });
});

// Fungsi untuk mewarnai sel status
function applyColorToCell(cell, value) {
    if (value === "Disetujui") {
        cell.style.color = "#28a745";
    } 
    else if (value === "Menunggu Review") {
        cell.style.color = "#ffc107";
    } 
    else if (value === "Direvisi") {
        cell.style.color = "#17a2b8";
    } 
    else if (value === "Proses") {
        cell.style.color = "#007bff";
    }
    else {
        cell.style.color = "#dc3545";
    }
}

// Validasi form tambah proposal
document.getElementById('formTambah').addEventListener('submit', function(e) {
    const tglDisetujui = document.getElementById('tgl_disetujui').value;
    const tglBerakhir = document.getElementById('tgl_berakhir').value;
    
    if (!tglDisetujui) {
        e.preventDefault();
        alert('Tanggal Disetujui harus diisi!');
        return false;
    }
    
    if (!tglBerakhir) {
        e.preventDefault();
        alert('Tanggal Berakhir harus diisi!');
        return false;
    }
    
    if (new Date(tglBerakhir) <= new Date(tglDisetujui)) {
        e.preventDefault();
        alert('Tanggal Berakhir harus setelah Tanggal Disetujui!');
        return false;
    }
});
</script>
@endsection