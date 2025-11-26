@extends('superadmin.app2')

@section('title', 'Laporan Final')

@section('content')
    <h1><i class="fas fa-book"></i> Buku Laporan Final</h1>
    <p>Daftar laporan akhir penilaian berdasarkan status pengiriman.</p>

<!-- Tombol Tambah Laporan -->
<button onclick="document.getElementById('modalTambahFinal').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Laporan Final
</button>

<!-- Modal -->
<div id="modalTambahFinal" style="
    display:none; position:fixed; z-index:1000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;
">
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);
    ">
        <h2 style="margin-bottom:15px;">Tambah Laporan Final</h2>

        <form action="{{ route('superadmin.admin.SAlaporanFinal.store') }}" method="POST">
            @csrf

            <label>Pemberi Tugas</label>
            <input type="text" name="pemberi_tugas" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Jenis Penilaian</label>
            <input type="text" name="jenis_penilaian" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Nama Pengirim</label>
            <input type="text" name="pengirim" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Nomor Laporan</label>
            <input type="text" name="nomor_laporan" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Status Pengiriman</label>
            <select name="status_pengiriman" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">
                <option value="Sudah Dikirim">Sudah Dikirim</option>
                <option value="Belum Dikirim">Belum Dikirim</option>
            </select>

            <label style="display:block; margin:8px 0;">
                <input type="checkbox" name="softcopy" value="1">
                Softcopy
            </label>

            <label style="display:block; margin-bottom:15px;">
                <input type="checkbox" name="hardcopy" value="1">
                Hardcopy
            </label>

            <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalTambahFinal').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                Batal
            </button>
        </form>
    </div>
</div>


    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Jenis Penilaian</th>
                <th style="padding:10px; text-align:left;">Nama Pengirim</th>
                <th style="padding:10px; text-align:left;">No. Laporan</th>
                <th style="padding:10px; text-align:left;">Status Pengiriman</th>
                <th style="padding:10px; text-align:center;">Copy</th>
            </tr>
        </thead>

        <tbody>
            @foreach($laporanFinal as $item)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
                <td style="padding:10px;">{{ $item['jenis_penilaian'] }}</td>
                <td style="padding:10px;">{{ $item['pengirim'] }}</td>
                <td style="padding:10px;">{{ $item['nomor_laporan'] }}</td>
                <td style="padding:10px; font-weight:600;">
                    <select class="update-status status-color"
                        data-id="{{ $item->id }}"
                        style="padding:5px; border-radius:5px;">
                        <option value="Sudah Dikirim" {{ $item->status_pengiriman == 'Sudah Dikirim' ? 'selected' : '' }}>
                            Sudah Dikirim
                        </option>
                        <option value="Belum Dikirim" {{ $item->status_pengiriman == 'Belum Dikirim' ? 'selected' : '' }}>
                            Belum Dikirim
                        </option>
                    </select>
                </td>

                <!-- Kolom Copy -->
                <td style="padding:10px; text-align:center;">
                    <label style="margin-right:10px;">
                        <input type="checkbox"
                            class="update-softcopy"
                            data-id="{{ $item->id }}"
                            {{ $item->softcopy ? 'checked' : '' }}
                            style="
                    /* Memperbesar ukuran kotak checkbox */
                    transform: scale(1.5); 
                    /* Menambah margin di kanan kotak untuk memisahkannya dari teks */
                    margin-right: 8px; 
                    /* Memberi sudut yang lebih halus */
                    border-radius: 4px; 
                    /* Warna dasar kotak (tidak dapat diubah) */
                    accent-color: #007bff; 
                ">
                        Softcopy
                    </label>

                    <label>
                        <input type="checkbox"
                            class="update-hardcopy"
                            data-id="{{ $item->id }}"
                            {{ $item->hardcopy ? 'checked' : '' }}
                            style="
                    /* Memperbesar ukuran kotak checkbox */
                    transform: scale(1.5); 
                    /* Menambah margin di kanan kotak untuk memisahkannya dari teks */
                    margin-right: 8px; 
                    /* Memberi sudut yang lebih halus */
                    border-radius: 4px;
                    /* Warna dasar kotak (tidak dapat diubah) */
                    accent-color: #28a745;
                ">
                        Hardcopy
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    
@endsection
<script>

document.addEventListener('DOMContentLoaded', function () {

    // FUNGSI GANTI WARNA
    function applyStatusColor(selectElement) {
        if (selectElement.value === "Sudah Dikirim") {
            selectElement.style.color = "green";
            selectElement.style.fontWeight = "600";
        } else {
            selectElement.style.color = "red";
            selectElement.style.fontWeight = "600";
        }
    }

    // SET WARNA SAAT PERTAMA KALI LOAD
    document.querySelectorAll('.status-color').forEach(select => {
        applyStatusColor(select); 
    });

    // UPDATE STATUS + GANTI WARNA
    document.querySelectorAll('.update-status').forEach(select => {
        select.addEventListener('change', function () {
            applyStatusColor(this);

            updateField(this.dataset.id, "status_pengiriman", this.value);
        });
    });

    // UPDATE SOFTCOPY & HARDCOPY
    document.querySelectorAll('.update-softcopy').forEach(cb => {
        cb.addEventListener('change', function () {
            updateField(this.dataset.id, "softcopy", this.checked ? 1 : 0);
        });
    });

    document.querySelectorAll('.update-hardcopy').forEach(cb => {
        cb.addEventListener('change', function () {
            updateField(this.dataset.id, "hardcopy", this.checked ? 1 : 0);
        });
    });

    // AJAX UPDATE FIELD
    function updateField(id, field, value) {
        fetch(`/superadmin/admin/laporan-final/update/${id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                field: field,
                value: value
            })
        })
        .then(res => res.json())
        .then(data => console.log("Updated:", data))
        .catch(err => console.error(err));
    }
});
</script>
