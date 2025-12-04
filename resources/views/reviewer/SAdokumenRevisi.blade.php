@extends('superadmin.app2')

@section('title', 'Dokumen Revisi')

@section('content')
<h1><i class="fas fa-file-alt"></i> Dokumen Revisi</h1>
<p>Daftar dokumen revisi dari semua reviewer.</p>

<div class="dashboard-card" style="margin-top:30px;">
  <table style="width:100%; border-collapse: collapse; background:white;">
    <thead style="background:#007BFF; color:white;">
        <tr>
            <th style="padding:10px; text-align:left;">Tanggal</th>
            <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
            <th style="padding:10px; text-align:left;">Pemberi</th>
            <th style="padding:10px; text-align:left;">Pengguna</th>
            <th style="padding:10px; text-align:left;">Surveyor</th>
            <th style="padding:10px; text-align:left;">Lokasi</th>
            <th style="padding:10px; text-align:left;">Objek</th>
            <th style="padding:10px; text-align:left;">Reviewer</th>
            <th style="padding:10px; text-align:left;">Status</th>
            <th style="padding:10px; text-align:left;">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($dokumenRevisi as $data)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px; text-align:left;">{{ $data->tanggal }}</td>
            <td style="padding:10px; text-align:left;">{{ $data->jenis }}</td>
            <td style="padding:10px; text-align:left;">{{ $data->pemberi }}</td>
            <td style="padding:10px; text-align:left;">{{ $data->pengguna }}</td>
            <td style="padding:10px; text-align:left;">{{ $data->surveyor }}</td>
            <td style="padding:10px; text-align:left;">{{ $data->lokasi }}</td>
            <td style="padding:10px; text-align:left;">{{ $data->objek }}</td>
            <td style="padding:10px; text-align:left;">{{ $data->reviewer }}</td>
            <td style="font-weight:600; color:{{ $data->status === 'Selesai' ? '#28a745' : '#ffc107' }}">
                {{ $data->status }}
            </td>
            <td>
                <button
                    onclick="openEditStatusModal('{{ $data->id }}', '{{ $data->status }}', '{{ $data->reviewer }}')"
                    style="background:#007bff; color:white; padding:6px 10px; border:none; border-radius:6px;">
                    Edit
                </button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" style="text-align:center; padding:18px;">Tidak ada data revisi.</td>
        </tr>
        @endforelse
    </tbody>
  </table>
</div>

<!-- ============================= -->
<!--          MODAL EDIT           -->
<!-- ============================= -->
<div id="modalStatus" style="
    display:none; position:fixed; top:0; left:0;
    width:100%; height:100%; background:rgba(0,0,0,0.5);
    padding-top:80px;
">
  <div style="background:white; width:360px; margin:auto; padding:20px; border-radius:10px;">
    <h3>Edit Status Dokumen</h3>

    <form id="formEditStatus" method="POST">
      @csrf
      @method('PUT')

      <label>Reviewer (opsional)</label>
      <input type="text" name="reviewer" id="modal_reviewer"
          style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:6px;">

      <label>Status</label>
      <select name="status" id="modal_status"
          style="width:100%; padding:8px; margin-bottom:12px; border:1px solid #ccc; border-radius:6px;">
          <option value="Dalam Revisi">Dalam Revisi</option>
          <option value="Selesai">Selesai</option>
      </select>

      <div style="display:flex; justify-content:flex-end; gap:8px;">
        <button type="submit"
            style="background:#28a745; color:white; padding:8px 14px; border:none; border-radius:6px;">
            Simpan
        </button>

        <button type="button"
            onclick="document.getElementById('modalStatus').style.display='none'"
            style="background:#dc3545; color:white; padding:8px 14px; border:none; border-radius:6px;">
            Batal
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function openEditStatusModal(id, status, reviewer) {
    document.getElementById('modalStatus').style.display = 'block';

    document.getElementById('modal_status').value = status;
    document.getElementById('modal_reviewer').value = reviewer ?? '';

    document.getElementById('formEditStatus').action =
        '/reviewer/dokumen-revisi/update-status/' + id;
}
</script>

@endsection
