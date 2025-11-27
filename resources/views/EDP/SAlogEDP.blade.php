@extends('superadmin.app2')

@section('title', 'Log Aktifitas EDP')

@section('content')
<h1><i class="fas fa-history"></i> Log Aktivitas</h1>
<p>Daftar log aktivitas EDP.</p>

<!-- Tombol Tambah Laporan -->
<button onclick="document.getElementById('modalTambahFinal').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Data Log
</button>

<!-- Modal -->
<div id="modalTambahFinal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
background:rgba(0,0,0,0.5); padding-top:80px;">

    <div style="background:white; width:450px; margin:auto; padding:20px; border-radius:8px;">
        <h3>Tambah Log Aktivitas EDP</h3>

        <form action="{{ route('superadmin.edp.storeLogEDP') }}" method="POST">
            @csrf

            <label>No Laporan</label>
            <input type="text" name="no_laporan" class="input" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Tanggal</label>
            <input type="date" name="tanggal" class="input" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Pemberi Tugas</label>
            <input type="text" name="pemberi_tugas" class="input" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Nama Penilai</label>
            <input type="text" name="penilai" class="input" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Nama Staff EDP</label>
            <input type="text" name="staff" class="input" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Status</label>
            <select name="status" class="input" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">
                <option value="On Progress">On Progress</option>
                <option value="Selesai">Selesai</option>
            </select>

            <button type="submit"
                style="background:#28a745; padding:10px 14px; border:none; margin-top:12px; color:white; border-radius:5px;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalTambahFinal').style.display='none'"
                style="background:red; padding:10px 14px; border:none; margin-top:12px; color:white; border-radius:5px;">
                Batal
            </button>
        </form>
    </div>

</div>

<!-- Tabel -->
<div class="dashboard-card" style="margin-top:30px;">
<table style="width:100%; border-collapse: collapse; margin-top:15px;">
    <thead style="background:#007BFF; color:white;">
        <tr>
            <th style="padding:10px; text-align:left;">No. Laporan</th>
            <th style="padding:10px; text-align:left;">Tanggal</th>
            <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
            <th style="padding:10px; text-align:left;">Nama Penilai</th>
            <th style="padding:10px; text-align:left;">Nama Staff EDP</th>
            <th style="padding:10px; text-align:center;">Status</th>
        </tr>
    </thead>

    <tbody>
      @foreach ($logAktivitas as $item)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px;">{{ $item['no_laporan'] }}</td>
            <td style="padding:10px;">{{ $item['tanggal'] }}</td>
            <td td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
            <td style="padding:10px;">{{ $item['penilai'] }}</td>
            <td style="padding:10px;">{{ $item['staff'] }}</td>
        
            <td style="padding:10px; text-align:center;
                font-weight:600; 
                color: {{ $item['status'] == 'Selesai' ? 'blue' : 'green' }};
            ">
                {{ $item['status'] }}
            </td>
        </tr>
      @endforeach
    </tbody>

</table>
</div>
@endsection