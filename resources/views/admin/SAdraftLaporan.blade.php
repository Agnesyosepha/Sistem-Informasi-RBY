@extends('superadmin.app2')

@section('title', 'Draft Laporan')

@section('content')
<h1><i class="fas fa-file-alt"></i> Draft Laporan</h1>
<p>Daftar draft laporan penilaian yang sedang dalam tahap penyusunan, review, atau sudah disetujui.</p>

<!-- Tombol Tambah -->
<button onclick="document.getElementById('modalTambah').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Draft Laporan
</button>

<!-- Modal Tambah -->
<div id="modalTambah" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);">

        <h2 style="margin-bottom:15px;">Tambah Draft Laporan</h2>

        <form action="{{ route('superadmin.admin.SAdraftLaporan.store') }}" method="POST">
            @csrf

            <label>Nama Pemberi Tugas</label>
            <input type="text" name="pemberi_tugas" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Nomor PPJP</label>
            <input type="text" name="nomor_ppjp" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Tanggal Proposal</label>
            <input type="date" name="tgl_proposal" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Tanggal Pengiriman</label>
            <input type="date" name="tgl_pengiriman" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Status</label>
            <select name="status"
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                <option value="Pending">Pending</option>
                <option value="Final">Final</option>
                <option value="Disetujui">Disetujui</option>
                <option value="Ditolak">Ditolak</option>
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

<!-- Tabel Laporan -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Nomor PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Proposal</th>
                <th style="padding:10px; text-align:left;">Tanggal Pengiriman</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $item)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $item->pemberi_tugas }}</td>
                    <td style="padding:10px;">{{ $item->nomor_ppjp }}</td>
                    <td style="padding:10px;">{{ $item->tgl_proposal }}</td>
                    <td style="padding:10px;">{{ $item->tgl_pengiriman }}</td>

                    <td style="padding:10px; font-weight:bold; text-align:center;">
                      <select 
                        onchange="updateStatus({{ $item->id }}, this)" 
                        style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                        class="status-select"
                        data-status="{{ $item->status }}">
                        
                        <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Final" {{ $item->status == 'Final' ? 'selected' : '' }}>Final</option>
                        <option value="Disetujui" {{ $item->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ $item->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>

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
    if (value === "Final") {
        selectElement.style.color = "blue";
    }
    if (value === "Pending") {
        selectElement.style.color = "orange";
    }
    if (value === "Ditolak") {
        selectElement.style.color = "red";
    }
    
}

// Warna saat halaman diload
document.querySelectorAll('.status-select').forEach(select => applyColor(select));

// Update status via AJAX
function updateStatus(id, selectElement) {

    applyColor(selectElement);

    fetch(`/superadmin/admin/draftlaporan/update-status/${id}`, {
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
