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

    <!-- Tabel Surat Tugas -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">No.</th>
                    <th style="padding:10px; text-align:left;">PPJP</th>
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
                            <select 
                                onchange="updateStatus({{ $st->id }}, this)" 
                                style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                                class="status-select"
                                data-status="{{ $st->status }}">
                                <option value="survey" {{ $st->status == 'survey' ? 'selected' : '' }}>Survey</option>
                                <option value="pending" {{ $st->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button onclick="showDeleteModal({{ $st->id }}, '{{ $st->no_ppjp }}')" 
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
            <p>Apakah Anda yakin ingin menghapus Surat Tugas dengan Nomor PPJP <strong id="noPPJP"></strong>?</p>
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
function applyColor(selectElement) {
    const value = selectElement.value;
    if (value === 'survey') selectElement.style.color = 'blue';
    else if (value === 'pending') selectElement.style.color = 'orange';
}

// Inisialisasi warna saat load
document.querySelectorAll('.status-select').forEach(select => applyColor(select));

function updateStatus(id, selectElement) {
    applyColor(selectElement);

    fetch(`/superadmin/admin/surat-tugas/update-status/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            status: selectElement.value
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.message) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: selectElement.value === 'survey'
                    ? 'Status diperbarui dan notifikasi telah dikirim ke surveyor.'
                    : 'Status berhasil diperbarui.',
                timer: 2000,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.reload();
            }, 2000);
        }
    })
    .catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat memperbarui status.'
        });
        console.error(err);
    });
}

// Fungsi untuk menampilkan modal hapus
function showDeleteModal(id, noPPJP) {
    document.getElementById('noPPJP').textContent = noPPJP;
    document.getElementById('formHapus').action = `/superadmin/admin/surat-tugas/${id}`;
    document.getElementById('modalHapus').style.display = 'block';
}
</script>
@endsection
