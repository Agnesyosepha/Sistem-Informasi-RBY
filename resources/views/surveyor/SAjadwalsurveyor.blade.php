@extends('superadmin.app2')

@section('title', 'Jadwal Surveyor Superadmin')

@section('content')
<h1><i class="fas fa-calendar-alt"></i> Jadwal Surveyor</h1>
<p>Kelola jadwal survei yang dibuat oleh para surveyor.</p>

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
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);">
        <h2 style="margin-bottom:15px;">Tambah Jadwal Surveyor</h2>
        <form action="{{ route('superadmin.jadwal.store') }}" method="POST">
            @csrf

            <label>Nama Surveyor</label>
            <input type="text" name="nama_surveyor" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Tanggal</label>
            <input type="date" name="tanggal" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Lokasi</label>
            <input type="text" name="lokasi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Deskripsi</label>
            <input type="text" name="deskripsi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Status</label>
            <select name="status" required
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                <option value="Proses">Proses</option>
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

<!-- Modal Edit -->
<div id="modalEdit" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);">
        <h2 style="margin-bottom:15px;">Edit Jadwal Surveyor</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <label>Nama Surveyor</label>
            <input id="edit_nama" type="text" name="nama_surveyor" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Tanggal</label>
            <input id="edit_tanggal" type="date" name="tanggal" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Lokasi</label>
            <input id="edit_lokasi" type="text" name="lokasi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Deskripsi</label>
            <input id="edit_deskripsi" type="text" name="deskripsi" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Status</label>
            <select id="edit_status" name="status" required
                style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                <option value="Proses">Proses</option>
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
                <th style="padding:10px;">No</th>
                <th style="padding:10px;">Nama Surveyor</th>
                <th style="padding:10px;">Tanggal</th>
                <th style="padding:10px;">Lokasi</th>
                <th style="padding:10px;">Status</th>
                <th style="padding:10px; text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $index => $item)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $index + 1 }}</td>
                <td style="padding:10px;">{{ $item->nama_surveyor }}</td>
                <td style="padding:10px;">{{ $item->tanggal }}</td>
                <td style="padding:10px;">{{ $item->lokasi }}</td>
                <td style="padding:10px;">
                    @if($item->status == 'Selesai')
                        <span style="background:#28a745; color:white; padding:5px 10px; border-radius:5px;">Selesai</span>
                    @else
                        <span style="background:#fd7e14; color:white; padding:5px 10px; border-radius:5px;">Proses</span>
                    @endif
                </td>
                <td style="padding:10px; text-align:center;">
                    <button onclick="openEdit({{ $item->id }}, '{{ $item->nama_surveyor }}', '{{ $item->tanggal }}', '{{ $item->lokasi }}', '{{ $item->status }}', '{{ $item->deskripsi }}')"
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
                <td colspan="6" style="padding:10px; text-align:center;">Belum ada jadwal.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function openEdit(id, nama, tanggal, lokasi, status, deskripsi) {
    document.getElementById('modalEdit').style.display = 'block';
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_tanggal').value = tanggal;
    document.getElementById('edit_lokasi').value = lokasi;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit_deskripsi').value = deskripsi;

    document.getElementById('editForm').action = `/superadmin/jadwal-surveyor/update/${id}`;
}
</script>

@endsection
