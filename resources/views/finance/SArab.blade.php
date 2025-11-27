@extends('superadmin.app2')

@section('title', 'Data RAB')

@section('content')
<h1><i class="fas fa-file-invoice-dollar"></i> Data RAB</h1>
<p>Daftar RAB yang sudah dibuat oleh surveyor atau superadmin.</p>

<!-- Tombol Tambah RAB -->
<button onclick="document.getElementById('modalTambahRAB').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah RAB
</button>

<!-- Modal -->
<div id="modalTambahRAB" style="
    display:none; position:fixed; z-index:1000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;
">
    <div style="
        background:white; margin:auto; padding:20px; border-radius:10px;
        width:40%; max-height:80vh;
        overflow-y:auto;
        box-shadow:0 4px 12px rgba(0,0,0,0.2);
    ">
        <h2 style="margin-bottom:15px;">Tambah RAB</h2>

        <form action="{{ route('superadmin.rab.store') }}" method="POST">
            @csrf

            <label>No PPJP:</label>
            <input type="text" name="no_ppjp" required 
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Pemberi Tugas:</label>
            <input type="text" name="pemberi_tugas" required 
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Lokasi:</label>
            <input type="text" name="lokasi" required 
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Tanggal Survey:</label>
            <input type="date" name="tanggal_survey" required 
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Pelaksana Inspeksi:</label>
            <input type="text" name="pelaksana_inspeksi" required 
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Total Biaya (Rp):</label>
            <input type="number" name="total_biaya" required 
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

            <label>Status:</label>
            <select name="status" required 
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">
                <option value="Menunggu">Menunggu</option>
                <option value="Disetujui">Disetujui</option>
            </select>

            <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalTambahRAB').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
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
            <th style="padding:10px;">No PPJP</th>
            <th style="padding:10px;">Pemberi Tugas</th>
            <th style="padding:10px;">Lokasi</th>
            <th style="padding:10px;">Tanggal Survey</th>
            <th style="padding:10px;">Pelaksana Inspeksi</th>
            <th style="padding:10px;">Total Biaya</th>
            <th style="padding:10px;">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($rabs as $rab)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px;">{{ $rab->no_ppjp }}</td>
            <td style="padding:10px;">{{ $rab->pemberi_tugas }}</td>
            <td style="padding:10px;">{{ $rab->lokasi }}</td>
            <td style="padding:10px;">{{ $rab->tanggal_survey }}</td>
            <td style="padding:10px;">{{ $rab->pelaksana_inspeksi }}</td>
            <td style="padding:10px;">Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}</td>

            <!-- STATUS WARNA -->
            <td style="
                padding:10px; font-weight:600;
                color:
                    @if($rab->status === 'Disetujui')
                        #28a745
                    @elseif($rab->status === 'Menunggu')
                        #ffc107
                    @else
                        #dc3545
                    @endif
            ">
                {{ $rab->status }}
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
