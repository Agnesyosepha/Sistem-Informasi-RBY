@extends('superadmin.app2')

@section('title', 'Dokumen Final')

@section('content')
<h1><i class="fas fa-check-circle"></i> Dokumen Final</h1>
<p>Daftar seluruh dokumen final dari reviewer.</p>

<div class="dashboard-card" style="margin-top:30px;">
  <table style="width:100%; border-collapse:collapse; background:white;">
      <thead style="background:#007BFF; color:white;">
          <tr>
              <th style="padding:10px; text-align:left;">Tanggal</th>
              <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
              <th style="padding:10px; text-align:left;">Pemberi</th>
              <th style="padding:10px; text-align:left;">Pengguna</th>
              <th style="padding:10px; text-align:left;">Surveyor</th>
              <th style="padding:10px; text-align:left;">Lokasi</th>
              <th style="padding:10px; text-align:left;">Objek</th>
              <th style="padding:10px; text-align:left;">Status</th>
              <th style="padding:10px; text-align:left;">Aksi</th>
          </tr>
      </thead>

      <tbody>
          @forelse($dokumenFinal as $data)
          <tr style="border-bottom:1px solid #ddd;">
              <td style="padding:10px;">{{ $data->tanggal }}</td>
              <td style="padding:10px;">{{ $data->jenis }}</td>
              <td style="padding:10px;">{{ $data->pemberi }}</td>
              <td style="padding:10px;">{{ $data->pengguna }}</td>
              <td style="padding:10px;">{{ $data->surveyor }}</td>
              <td style="padding:10px;">{{ $data->lokasi }}</td>
              <td style="padding:10px;">{{ $data->objek }}</td>
              <td style="padding:10px; font-weight:600; 
                    color:
                        @if($data->status === 'Final EDP') #007bff
                        @elseif($data->status === 'Selesai') #28a745
                        @else #dc3545 @endif;">
                  {{ $data->status }}
              </td>
              <td style="padding:10px;">
                  <button onclick="openEditStatusModal('{{ $data->id }}', '{{ $data->status }}')"
                      style="background:#17a2b8; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">
                      Edit
                  </button>
              </td>
          </tr>
          @empty
          <tr>
              <td colspan="9" style="text-align:center; padding:18px;">
                  Tidak ada dokumen final.
              </td>
          </tr>
          @endforelse
      </tbody>
  </table>
</div>

{{-- ================================
    MODAL EDIT STATUS
================================ --}}
<div id="modalEditStatus"
    style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
           background:rgba(0,0,0,0.5); padding-top:60px;">

    <div style="background:white; margin:auto; padding:20px; border-radius:10px;
                width:30%; max-height:60vh; box-shadow:0 4px 12px rgba(0,0,0,0.2);">

        <h2>Edit Status</h2>

        <form id="formEditStatus" method="POST">
            @csrf
            @method('PUT')

            <label>Status Progres:</label>
            <select name="status" id="edit_status" required class="input-field">
                <option value="Selesai">Selesai</option>
                <option value="Final EDP">Final EDP</option>
            </select>

            <button type="submit" class="btn-primary">Simpan</button>
            <button type="button"
                onclick="document.getElementById('modalEditStatus').style.display='none'"
                class="btn-danger" style="margin-left:10px;">Batal</button>
        </form>
    </div>
</div>

<style>
.input-field {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.btn-primary {
    background:#007BFF; 
    color:white; 
    padding:10px 18px; 
    border:none; 
    border-radius:6px; 
    cursor:pointer;
}
.btn-danger {
    background:#dc3545; 
    color:white; 
    padding:10px 18px; 
    border:none; 
    border-radius:6px; 
    cursor:pointer;
}
</style>

<script>
function openEditStatusModal(id, currentStatus) {
    document.getElementById('modalEditStatus').style.display = 'block';

    document.getElementById('formEditStatus').action =
        "/superadmin/reviewer/dokumen-final/update-status/" + id;

    document.getElementById('edit_status').value = currentStatus;
}

document.getElementById('formEditStatus').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const action = this.action;
    
    fetch(action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Jika data dipindahkan, reload halaman
            if (data.moved) {
                location.reload();
            } else {
                // Jika hanya update status, reload halaman
                location.reload();
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

</script>

@endsection
