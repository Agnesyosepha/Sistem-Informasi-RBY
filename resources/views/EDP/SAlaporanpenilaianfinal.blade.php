@extends('superadmin.app2')

@section('title', 'Laporan Penilaian Superadmin')

@section('content')
<h1><i class="fas fa-file-alt"></i> Laporan Penilaian</h1>
<p>Daftar laporan hasil penilaian yang telah selesai diproses.</p>

<!-- Tabel Laporan Penilaian -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Jenis</th>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Pengguna Jasa</th>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                <th style="padding:10px; text-align:left;">Reviewer</th>
                <th style="padding:10px; text-align:left;">Status</th>
                <th style="padding:10px; text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanPenilaian as $l)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $l->tanggal }}</td>
                    <td style="padding:10px;">{{ $l->jenis }}</td>
                    <td style="padding:10px;">{{ $l->pemberi }}</td>
                    <td style="padding:10px;">{{ $l->pengguna }}</td>
                    <td style="padding:10px;">{{ $l->surveyor }}</td>
                    <td style="padding:10px;">{{ $l->lokasi }}</td>
                    <td style="padding:10px;">{{ $l->objek }}</td>
                    <td style="padding:10px;">{{ $l->reviewer ?? '-' }}</td>
                    <td style="padding:10px;">
                        <span class="status-label" data-status="{{ $l->status }}">
                            {{ $l->status }}
                        </span>
                    </td>
                    <td style="padding:10px; text-align:center;">
                        <button onclick="editData({{ $l->id }})" 
                            style="background:#ffc107; color:black; padding:5px 10px; border:none; border-radius:5px; margin-right:5px; cursor:pointer;">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteData({{ $l->id }})" 
                            style="background:#dc3545; color:white; padding:5px 10px; border:none; border-radius:5px; cursor:pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($laporanPenilaian->count() > 0)
    <div style="margin-top: 15px; text-align: right; color: #6c757d;">
        Menampilkan {{ $laporanPenilaian->count() }} data
    </div>
    @endif
</div>

<!-- Modal Edit Laporan -->
<div id="modalEdit" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:45%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);
        max-height: 80vh; overflow-y: auto;">

        <h2 style="margin-bottom:15px;">Edit Laporan Penilaian</h2>

        <form id="editForm" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            
            <input type="hidden" id="editId" name="id">

            <label>Tanggal</label>
            <input type="date" id="editTanggal" name="tanggal" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Jenis</label>
            <input type="text" id="editJenis" name="jenis" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Pemberi Tugas</label>
            <input type="text" id="editPemberi" name="pemberi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Pengguna Jasa</label>
            <input type="text" id="editPengguna" name="pengguna" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Surveyor</label>
            <input type="text" id="editSurveyor" name="surveyor" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Lokasi</label>
            <input type="text" id="editLokasi" name="lokasi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Objek Penilaian</label>
            <input type="text" id="editObjek" name="objek" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Reviewer</label>
            <input type="text" id="editReviewer" name="reviewer" 
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Status</label>
            <select id="editStatus" name="status" required
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                <option value="">Pilih Status</option>
                <option value="Proses">Proses</option>
                <option value="Selesai">Selesai</option>
                <option value="Revisi">Revisi</option>
                <option value="Final EDP">Final EDP</option>
            </select>

            <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalEdit').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                Batal
            </button>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".status-label").forEach(function(label) {
        const value = label.getAttribute("data-status");

        if (value === "Selesai") {
            label.style.color = "green";
        } 
        else if (value === "Proses") {
            label.style.color = "orange";
        } 
        else if (value === "Revisi") {
            label.style.color = "red";
        }
        else if (value === "Final EDP") {
            label.style.color = "#007bff";
        }
    });
});

function editData(id) {
    // Fetch data dari server
    fetch(`/superadmin/edp/laporan-penilaian/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            // Isi form dengan data yang ada
            document.getElementById('editId').value = data.id;
            document.getElementById('editTanggal').value = data.tanggal;
            document.getElementById('editJenis').value = data.jenis;
            document.getElementById('editPemberi').value = data.pemberi;
            document.getElementById('editPengguna').value = data.pengguna;
            document.getElementById('editSurveyor').value = data.surveyor;
            document.getElementById('editLokasi').value = data.lokasi;
            document.getElementById('editObjek').value = data.objek;
            document.getElementById('editReviewer').value = data.reviewer || '';
            document.getElementById('editStatus').value = data.status;
            
            // Set action form
            document.getElementById('editForm').action = `/superadmin/edp/laporan-penilaian/${id}`;
            
            // Tampilkan modal
            document.getElementById('modalEdit').style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data!');
        });
}



document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const id = document.getElementById('editId').value;
    const formData = new FormData(this);
    
    fetch(`/superadmin/edp/laporan-penilaian/${id}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Data berhasil diperbarui!');
            location.reload();
        } else {
            alert('Gagal memperbarui data!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan!');
    });
});
</script>
@endsection
