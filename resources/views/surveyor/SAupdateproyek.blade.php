@extends('superadmin.app2')

@section('title', 'Update Proyek')

@section('content')
<h1><i class="fas fa-tasks"></i> Update Proyek</h1>
<p>Rekap seluruh proyek berdasarkan status: <strong>Berjalan</strong>, <strong>Selesai</strong>, dan <strong>Pending</strong>.</p>

<!-- Tombol Tambah Proyek -->
<button onclick="document.getElementById('modalTambahProyek').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Data Proyek
</button>

<!-- Modal Tambah -->
<div id="modalTambahProyek"
    style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5); padding-top:60px;">

    <div style="background:white; margin:auto; padding:20px; border-radius:10px; width:40%; box-shadow:0 4px 12px rgba(0,0,0,0.2);">

        <h2 style="margin-bottom:15px;">Tambah Data Proyek</h2>

        <form id="formTambahProyek" method="POST">
            @csrf

            <label>Tipe Proyek</label>
            <select id="tipeProyek" name="tipe"
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                <option value="berjalan">Berjalan</option>
                <option value="selesai">Selesai</option>
                <option value="pending">Pending</option>
            </select>

            <label>No. PPJP</label>
            <input type="text" name="noppjp" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Debitur</label>
            <input type="text" name="debitur" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Lokasi</label>
            <input type="text" name="lokasi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Surveyor</label>
            <input type="text" name="surveyor" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Tanggal</label>
            <input type="date" name="tanggal" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Alasan (Khusus Pending)</label>
            <textarea name="alasan"
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;"></textarea>

            <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalTambahProyek').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                Batal
            </button>
        </form>
    </div>
</div>


{{-- ========================== TABLE 1: PROYEK BERJALAN ========================== --}}
<div class="dashboard-card" style="margin-top:30px;">
    <h2 style="color:#007BFF;"><i class="fas fa-spinner"></i> Proyek Berjalan</h2>
    <p>Daftar proyek yang sedang berjalan atau proses inspeksi.</p>

    <table style="width:100%; border-collapse: collapse; margin-top:10px;">
        <thead style="background:#CDE5FF;">
            <tr>
                <th style="padding:10px;">No. PPJP</th>
                <th style="padding:10px;">Debitur</th>
                <th style="padding:10px;">Lokasi</th>
                <th style="padding:10px;">Surveyor</th>
                <th style="padding:10px;">Tgl Inspeksi</th>
                <th style="padding:10px;">Progres</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyekBerjalan as $p)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $p->noppjp }}</td>
                <td style="padding:10px;">{{ $p->debitur }}</td>
                <td style="padding:10px;">{{ $p->lokasi }}</td>
                <td style="padding:10px;">{{ $p->surveyor }}</td>
                <td style="padding:10px;">{{ $p->tgl_inspeksi }}</td>

                <td style="padding:10px;">
                    <select onchange="updateProgres('berjalan', {{ $p->id }}, this)"
                        class="status-select" data-status="{{ $p->progres }}"
                        style="padding:6px; border-radius:5px; border:1px solid #ccc;">
                        <option value="On Progress" {{ $p->progres=='On Progress'?'selected':'' }}>On Progress</option>
                        <option value="Review" {{ $p->progres=='Review'?'selected':'' }}>Review</option>
                        <option value="Selesai" {{ $p->progres=='Selesai'?'selected':'' }}>Selesai</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- ========================== TABLE 2: PROYEK SELESAI ========================== --}}
<div class="dashboard-card" style="margin-top:40px;">
    <h2 style="color:#28A745;"><i class="fas fa-check-circle"></i> Proyek Selesai</h2>
    <p>Proyek yang sudah selesai dan dinyatakan final.</p>

    <table style="width:100%; border-collapse: collapse; margin-top:10px;">
        <thead style="background:#B9F6CA;">
            <tr>
                <th style="padding:10px;">No. PPJP</th>
                <th style="padding:10px;">Debitur</th>
                <th style="padding:10px;">Lokasi</th>
                <th style="padding:10px;">Surveyor</th>
                <th style="padding:10px;">Tgl Selesai</th>
                <th style="padding:10px;">Progres</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyekSelesai as $p)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $p->noppjp }}</td>
                <td style="padding:10px;">{{ $p->debitur }}</td>
                <td style="padding:10px;">{{ $p->lokasi }}</td>
                <td style="padding:10px;">{{ $p->surveyor }}</td>
                <td style="padding:10px;">{{ $p->tgl_selesai }}</td>

                <td style="padding:10px; font-weight:bold; color:green;">Selesai</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- ========================== TABLE 3: PROYEK PENDING ========================== --}}
<div class="dashboard-card" style="margin-top:40px;">
    <h2 style="color:#C62828;"><i class="fas fa-clock"></i> Proyek Pending</h2>
    <p>Proyek yang tertunda atau menunggu konfirmasi.</p>

    <table style="width:100%; border-collapse: collapse; margin-top:10px;">
        <thead style="background:#FFE082;">
            <tr>
                <th style="padding:10px;">No. PPJP</th>
                <th style="padding:10px;">Debitur</th>
                <th style="padding:10px;">Lokasi</th>
                <th style="padding:10px;">Surveyor</th>
                <th style="padding:10px;">Tgl Inspeksi</th>
                <th style="padding:10px;">Alasan</th>
                <th style="padding:10px;">Progres</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyekPending as $p)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $p->noppjp }}</td>
                <td style="padding:10px;">{{ $p->debitur }}</td>
                <td style="padding:10px;">{{ $p->lokasi }}</td>
                <td style="padding:10px;">{{ $p->surveyor }}</td>
                <td style="padding:10px;">{{ $p->tgl_inspeksi }}</td>
                <td style="padding:10px;">{{ $p->alasan }}</td>

                <td style="padding:10px;">
                    <select onchange="updateProgres('pending', {{ $p->id }}, this)"
                        class="status-select" data-status="{{ $p->progres }}"
                        style="padding:6px; border-radius:5px; border:1px solid #ccc;">
                        <option value="Pending" {{ $p->progres=='Pending'?'selected':'' }}>Pending</option>
                        <option value="Proses" {{ $p->progres=='Proses'?'selected':'' }}>Proses</option>
                        <option value="Selesai" {{ $p->progres=='Selesai'?'selected':'' }}>Selesai</option>
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

    if (value === "Selesai") selectElement.style.color = "green";
    else if (value === "Pending") selectElement.style.color = "#E65100";
    else if (value === "Review") selectElement.style.color = "blue";
    else selectElement.style.color = "orange";
}

// Saat halaman load → set warna
document.querySelectorAll('.status-select').forEach(select => applyColor(select));

function updateProgres(tipe, id, element) {
    applyColor(element);

    fetch(`/superadmin/admin/update-proyek/${tipe}/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            progres: element.value
        })
    })
    .then(res => res.json())
    .then(res => console.log(res))
    .catch(err => console.error(err));
}
document.getElementById("formTambahProyek").addEventListener("submit", function(e) {
    const tipe = document.getElementById("tipeProyek").value;
    this.action = "{{ route('superadmin.admin.SAupdateProyek.store') }}";

});
</script>
@endsection
