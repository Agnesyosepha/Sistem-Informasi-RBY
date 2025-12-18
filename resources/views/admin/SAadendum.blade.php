@extends('superadmin.app2')

@section('title', 'Adendum')

@section('content')
<h1><i class="fas fa-file-contract"></i> Daftar Adendum</h1>
<p>Berikut adalah daftar adendum yang telah diajukan.</p>

<!-- Tombol Tambah -->
<button onclick="document.getElementById('modalTambah').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Adendum
</button>

<!-- Modal Tambah -->
<div id="modalTambah" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);
    ">
        <h2 style="margin-bottom:15px;">Tambah Adendum</h2>

        <form action="{{ route('superadmin.admin.SAadendum.store') }}" method="POST">
            @csrf

            <label>Nomor Adendum</label>
            <input type="text" name="nomor" required 
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Nama Proyek</label>
            <input type="text" name="proyek" required 
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Tanggal</label>
            <input type="date" name="tanggal" required 
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Deskripsi</label>
            <textarea name="deskripsi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;"></textarea>

            <label>Status</label>
            <select name="status" required 
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                <option value="Disetujui">Disetujui</option>
                <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
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

<!-- Modal Edit Status -->
<div id="modalEdit" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);
    ">
        <h2 style="margin-bottom:15px;">Edit Status Adendum</h2>

        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" id="editId" name="id">

            <label>Status</label>
            <select id="editStatus" name="status" required 
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                <option value="Disetujui">Disetujui</option>
                <option value="Direvisi">Direvisi</option>
                <option value="Proses">Proses</option>
            </select>

            <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Update
            </button>

            <button type="button" 
                onclick="document.getElementById('modalEdit').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                Batal
            </button>
        </form>
    </div>
</div>

<!-- Tabel -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor</th>
                <th style="padding:10px; text-align:left;">Proyek</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Deskripsi</th>
                <th style="padding:10px; text-align:center;">Status</th>
                <th style="padding:10px; text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adendum as $a)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $a->nomor }}</td>
                    <td style="padding:10px;">{{ $a->proyek }}</td>
                    <td style="padding:10px;">{{ $a->tanggal }}</td>
                    <td style="padding:10px;">{{ $a->deskripsi }}</td>
                    
                    <!-- Status sebagai teks berwarna -->
                    <td style="padding:10px; text-align:center;">
                        <span style="
                            padding:6px;
                            border-radius:6px;
                            font-weight:600;
                            color:
                                @if($a->status === 'Disetujui') #28a745
                                @elseif($a->status === 'Menunggu Persetujuan') #ffc107
                                @elseif($a->status === 'Direvisi') #17a2b8
                                @elseif($a->status === 'Proses') #007bff
                                @else #dc3545
                                @endif
                        ">{{ $a->status }}</span>
                    </td>
                    
                    <!-- Aksi dengan tombol edit dan hapus -->
                    <td style="padding:10px; text-align:center; display: flex; align-items: center; gap: 5px; justify-content: center;">
                        <button onclick="showEditModal({{ $a->id }})" 
                                style="background:#17a2b8; color:white; padding:6px 12px; border:none; border-radius:4px; cursor:pointer;">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="showDeleteModal({{ $a->id }})" 
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
        <p>Apakah Anda yakin ingin menghapus Adendum ini?</p>
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
<script>
// Fungsi untuk menampilkan modal edit
function showEditModal(id) {
    // Ambil data adendum berdasarkan ID
    fetch(`/superadmin/admin/superadmin-adendum/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            // Isi form dengan data yang ada
            document.getElementById('editId').value = data.id;
            document.getElementById('editStatus').value = data.status;
            
            // Set action form
            document.getElementById('formEdit').action = `/superadmin/admin/superadmin-adendum/${id}`;
            
            // Tampilkan modal
            document.getElementById('modalEdit').style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memuat data adendum');
        });
}

// Fungsi untuk menampilkan modal hapus
function showDeleteModal(id) {
    document.getElementById('formHapus').action = `/superadmin/admin/superadmin-adendum/${id}`;
    document.getElementById('modalHapus').style.display = 'block';
}

// Tangani pengiriman form edit
document.getElementById('formEdit').addEventListener('submit', function(e) {
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
        document.getElementById('modalEdit').style.display = 'none';
        
        // Tampilkan notifikasi
        if (data.success) {
            // Reload halaman setelah 1 detik
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            alert('Gagal memperbarui status!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui status');
    });
});
</script>
@endsection
