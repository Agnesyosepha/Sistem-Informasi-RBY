@extends('superadmin.app2')

@section('title', 'Draft Resume')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Draft Resume</h1>
    <p>Daftar draft resume hasil penilaian aset dari berbagai proyek yang sedang disusun atau telah dikirim.</p>


    <button onclick="document.getElementById('modalTambah').style.display='block'"
      style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
      + Tambah Draft Resume
    </button>

<!-- Modal -->
<div id="modalTambah" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">

    <div style="
    background:white; margin:auto; padding:20px; border-radius:10px; width:45%;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
    max-height: 80vh; overflow-y: auto;">

        <h2>Tambah Draft Resume</h2>

        <form action="{{ route('superadmin.admin.SAdraftResume.store') }}" method="POST">
            @csrf

            <label>Nama Pemberi Tugas</label>
            <input type="text" name="pemberi_tugas" required class="input">

            <label>Objek Penilaian</label>
            <input type="text" name="objek_penilaian" required class="input">

            <label>Nilai Pasar</label>
            <input type="number" name="nilai_pasar" required class="input">

            <label>Nilai Wajar</label>
            <input type="number" name="nilai_wajar" required class="input">

            <label>Nilai Likuidasi</label>
            <input type="number" name="nilai_likuidasi" required class="input">

            <label>Tanggal</label>
            <input type="date" name="tanggal" required class="input">

            <label>Tanggal Pengiriman</label>
            <input type="date" name="tanggal_pengiriman" required class="input">

            <label>Status</label>
            <select name="status" class="input">
                <option value="Terkirim">Terkirim</option>
                <option value="Final">Final</option>
                <option value="Pending">Pending</option>
                <option value="Disetujui">Disetujui</option>
            </select>

            <button type="submit" style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan</button>
            <button type="button" onclick="document.getElementById('modalTambah').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; margin-left:10px; cursor:pointer;">
                Batal
            </button>
        </form>

    </div>
</div>

<style>
.input {
    width:100%; padding:8px; margin-bottom:10px;
    border:1px solid #ccc; border-radius:5px;
}
</style>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                <th style="padding:10px; text-align:left;">Total Nilai</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Tanggal Pengiriman</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resume as $ar)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $ar['pemberi_tugas'] }}</td>
                    <td style="padding:10px;">{{ $ar['objek_penilaian'] }}</td>
                    <td style="padding:10px;">
                        <ul style="margin:0; padding-left:15px;">
                            <li><strong>Nilai Pasar:</strong> Rp {{ number_format($ar['nilai_pasar'], 0, ',', '.') }}</li>
                            <li><strong>Nilai Wajar:</strong> Rp {{ number_format($ar['nilai_wajar'], 0, ',', '.') }}</li>
                            <li><strong>Nilai Likuidasi:</strong> Rp {{ number_format($ar['nilai_likuidasi'], 0, ',', '.') }}</li>
                        </ul>
                    </td>
                    <td style="padding:10px;">{{ $ar['tanggal'] }}</td>
                    <td style="padding:10px;">{{ $ar['tanggal_pengiriman'] }}</td>
                    <td style="padding:10px; text-align:center;">
                          <select 
                            onchange="updateStatus({{ $ar->id }}, this)" 
                            style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                            class="status-select"
                            data-status="{{ $ar->status }}">
                            <option value="Final" {{ $ar->status == 'Final' ? 'selected' : '' }}>Final</option>
                            <option value="Terkirim" {{ $ar->status == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                            <option value="Pending" {{ $ar->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Disetujui" {{ $ar->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
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
    else if (value === "Final") {
        selectElement.style.color = "orange";
    } 
    else if (value === "Terkirim") {
        selectElement.style.color = "blue";
    }
    else if (value === "Pending") {
        selectElement.style.color = "red";
    }
}

// Saat halaman pertama kali load
document.querySelectorAll('.status-select').forEach(select => {
    applyColor(select);
});

function updateStatus(id, selectElement) {
    applyColor(selectElement);

    fetch(`/superadmin/admin/superadmin-draftResume/update-status/${id}`, {
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
