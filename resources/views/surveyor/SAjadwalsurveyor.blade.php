@extends('superadmin.app2')

@section('title', 'Jadwal Surveyor Superadmin')

@section('content')
<h1><i class="fas fa-calendar-alt"></i> Jadwal Surveyor</h1>
<p>Kelola jadwal survei yang dibuat oleh para surveyor.</p>

{{--
<!-- Tombol Tambah Jadwal -->
<button onclick="document.getElementById('modalTambah').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Jadwal
</button>

<!-- Modal Tambah Jadwal -->
<div id="modalTambah" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    <div style="
    background:white; margin:auto; padding:20px; border-radius:10px; width:45%;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
    max-height: 80vh; overflow-y: auto;">

        <h2 style="margin-bottom:15px;">Tambah Jadwal Surveyor</h2>
        <form action="{{ route('superadmin.jadwal.store') }}" method="POST">
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
            <input type="text" name="nama_penilai" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Adendum</label>
            <input type="text" name="adendum"
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Status</label>
            <select name="status" required
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                <option value="Survey">Survey</option>
                <option value="Selesai">Selesai</option>
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
--}}


<!-- Modal Edit -->
<div id="modalEdit" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    <div style="
    background:white; margin:auto; padding:20px; border-radius:10px; width:45%;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
    max-height: 80vh; overflow-y: auto;">
    
        <h2 style="margin-bottom:15px;">Edit Jadwal Surveyor</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <label>Status</label>
            <select id="edit_status" name="status" required
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                <option value="Survey">Survey</option>
                <option value="Selesai">Selesai</option>
            </select>

            <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Perbarui
            </button>

            <button type="button"
                onclick="document.getElementById('modalEdit').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                Batal
            </button>
        </form>
    </div>
</div>

<!-- Tabel Jadwal -->
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse:collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">No</th>
                <th style="padding:10px; text-align:left;">No. PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Survey</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Nama Penilai</th>
                <th style="padding:10px; text-align:left;">Adendum</th>
                <th style="padding:10px; text-align:left;">Status</th>
                <th style="padding:10px; text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $index => $item)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $index + 1 }}</td>
                <td style="padding:10px;">{{ $item->no_ppjp }}</td>
                <td style="padding:10px;">{{ $item->tanggal_survey }}</td>
                <td style="padding:10px;">{{ $item->lokasi }}</td>
                <td style="padding:10px;">{{ $item->objek_penilaian }}</td>
                <td style="padding:10px;">{{ $item->pemberi_tugas }}</td>
                <td style="padding:10px;">{{ $item->nama_penilai }}</td>
                <td style="padding:10px;">{{ $item->adendum ?? '-' }}</td>
                <td style="padding:10px;">
                    @if($item->status == 'Selesai')
                        <span style="background:#28a745; color:white; padding:5px 10px; border-radius:5px;">Selesai</span>
                    @else
                        <span style="background:#007BFF; color:white; padding:5px 10px; border-radius:5px;">Survey</span>
                    @endif
                </td>
                <td style="padding:10px; text-align:center;">
                    <button onclick="openEdit({{ $item->id }}, '{{ $item->no_ppjp }}', '{{ $item->tanggal_survey }}', '{{ $item->lokasi }}', '{{ $item->objek_penilaian }}', '{{ $item->pemberi_tugas }}', '{{ $item->nama_penilai }}', '{{ $item->adendum }}', '{{ $item->status }}')"
                        style="background:#ffc107; color:white; border:none; padding:6px 10px; border-radius:5px; cursor:pointer; margin-right:5px;">
                        <i class="fas fa-edit"></i>
                    </button>

                    <form action="{{ route('superadmin.jadwal.delete', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus?')"
                            style="background:#dc3545; color:white; border:none; padding:6px 10px; border-radius:5px; cursor:pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" style="padding:10px; text-align:center;">Belum ada jadwal.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function openEdit(id, no_ppjp, tanggal_survey, lokasi, objek_penilaian, pemberi_tugas, nama_penilai, adendum, status) {
    document.getElementById('modalEdit').style.display = 'block';
    document.getElementById('edit_status').value = status;

    document.getElementById('editForm').action = `/superadmin/jadwal-surveyor/update/${id}`;
}
</script>

@endsection
