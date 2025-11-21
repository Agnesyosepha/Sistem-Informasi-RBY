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

<!-- Modal -->
<div id="modalTambah" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);">

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
            <select name="status"
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
            </tr>
        </thead>
        <tbody>
            @foreach($adendum as $a)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $a->nomor }}</td>
                    <td style="padding:10px;">{{ $a->proyek }}</td>
                    <td style="padding:10px;">{{ $a->tanggal }}</td>
                    <td style="padding:10px;">{{ $a->deskripsi }}</td>
                    <td style="padding:10px; font-weight:bold; text-align:center;">
                      <select 
                        onchange="updateStatus({{ $a->id }}, this)" 
                        style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                        class="status-select"
                        data-status="{{ $a->status }}">
                        <option value="Menunggu Persetujuan" {{ $a->status == 'Menunggu Persetujuan' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                        <option value="Disetujui" {{ $a->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Direvisi" {{ $a->status == 'Direvisi' ? 'selected' : '' }}>Direvisi</option>
                        <option value="Proses" {{ $a->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                      </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
function applyColor(selectElement) {
    const value = selectElement.value;

    if (value === "Disetujui") {
        selectElement.style.color = "green";
    } 
    else if (value === "Menunggu Persetujuan") {
        selectElement.style.color = "orange";
    } 
    else if (value === "Direvisi") {
        selectElement.style.color = "blue";
    } 
    else if (value === "Proses") {
        selectElement.style.color = "blue";
    }
}
// Warna saat halaman diload
document.querySelectorAll('.status-select').forEach(select => applyColor(select));

// Update status
function updateStatus(id, selectElement) {

    applyColor(selectElement);

    fetch(`/superadmin/admin/superadmin-adendum/update-status/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: selectElement.value })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));
}

</script>
@endsection