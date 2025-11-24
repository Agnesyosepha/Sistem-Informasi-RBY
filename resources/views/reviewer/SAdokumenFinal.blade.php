@extends('superadmin.app2')

@section('title', 'Dokumen Final')

@section('content')
<h1><i class="fas fa-check-circle"></i> Dokumen Final</h1>
<p>Daftar dokumen yang telah selesai direvisi dan disetujui sebagai dokumen final oleh tim reviewer.</p>

<!-- Tombol Tambah -->
<button onclick="document.getElementById('modalFinal').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-bottom:20px;">
    + Tambah Dokumen Final
</button>

<!-- Modal -->
<div id="modalFinal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
background:rgba(0,0,0,0.5); z-index:1000; padding-top:80px;">
    
    <div style="background:white; width:40%; margin:auto; padding:20px; border-radius:10px;">
        <h2>Tambah Dokumen Final</h2>

        <form action="{{ route('reviewer.storeDokumenFinal') }}" method="POST">
            @csrf
            
            <label>Nama Dokumen:</label>
            <input type="text" name="nama" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Tanggal Disetujui:</label>
            <input type="date" name="tanggal" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Reviewer:</label>
            <input type="text" name="reviewer" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <input type="hidden" name="status" value="Final">

            <button type="submit" style="background:#007bff; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button" style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; margin-left:8px; cursor:pointer;"
                onclick="document.getElementById('modalFinal').style.display='none'">
                Batal
            </button>

        </form>
    </div>
</div>


<div class="dashboard-card" style="margin-top:30px;">
  <h3><i class="fas fa-folder-open"></i> Daftar Dokumen Final</h3>

  <table style="width:100%; border-collapse:collapse; margin-top:20px; background:white; border-radius:8px; overflow:hidden;">
      <thead style="background:#007BFF; color:white;">
          <tr>
              <th style="padding:12px 14px; text-align:left; width:60px;">No</th>
              <th style="padding:12px 14px; text-align:left;">Nama Dokumen</th>
              <th style="padding:12px 14px; text-align:left;">Tanggal Disetujui</th>
              <th style="padding:12px 14px; text-align:left;">Reviewer</th>
              <th style="padding:12px 14px; text-align:left;">Status</th>
          </tr>
      </thead>
      <tbody>
          @forelse($dokumenFinal as $index => $d)
          <tr style="border-bottom:1px solid #e5e5e5;">
              <td style="padding:12px 14px;">{{ $index + 1 }}</td>
              <td style="padding:12px 14px;">{{ $d['nama'] }}</td>
              <td style="padding:12px 14px;">{{ $d['tanggal'] }}</td>
              <td style="padding:12px 14px;">{{ $d['reviewer'] }}</td>
              <td style="padding:10px; font-weight:600; color:green;">{{ $d['status'] }}</td>
          </tr>
          @empty
          <tr>
              <td colspan="5" style="text-align:center; padding:18px; color:#777;">Belum ada dokumen final.</td>
          </tr>
          @endforelse
      </tbody>
  </table>
</div>
@endsection
