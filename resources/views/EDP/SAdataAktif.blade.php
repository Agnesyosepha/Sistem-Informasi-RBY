@extends('superadmin.app2')

@section('title', 'Data Aktif')

@section('content')
<h1><i class="fas fa-server"></i> Data Aktif</h1>
<p>Daftar data aktif yang sedang diproses.</p>


<!-- Tombol Tambah Laporan -->
<button onclick="document.getElementById('modalTambahFinal').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Data
</button>

<!-- Modal -->
<div id="modalTambahFinal" style="
    display:none; position:fixed; z-index:1000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;
">
    <div style="
    background:white; margin:auto; padding:20px; border-radius:10px;
    width:40%; max-height:80vh; 
    overflow-y:auto; /* scroll vertikal */
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
">
        <h2 style="margin-bottom:15px;">Tambah Data Aktif</h2>

    <form action="{{ route('superadmin.edp.storeDataAktif') }}" method="POST">
        @csrf

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">
        

        <label>Maksud & Tujuan:</label>
        <input type="text" name="jenis" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

        <label>Pemberi Tugas:</label>
        <input type="text" name="pemberi" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

        <label>Pengguna:</label>
        <input type="text" name="pengguna" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

        <label>Surveyor:</label>
        <input type="text" name="surveyor" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

        <label>Lokasi:</label>
        <input type="text" name="lokasi" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

        <label>Objek:</label>
        <input type="text" name="objek" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">

        <label>Status Progres:</label>
        <select name="status_progres" required
                style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;">
            <option value="Proses">Proses</option>
            <option value="Selesai">Selesai</option>
            <option value="Reviewer">Reviewer</option>
        </select>

        <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button"
                onclick="document.getElementById('modalTambahFinal').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                Batal
            </button>
        </form>
    </div>
</div>


<div class="dashboard-card" style="margin-top:30px;">
<table style="width:100%; border-collapse: collapse; margin-top:15px;">
    <thead style="background:#007BFF; color:white;">
        <tr>
            <th style="padding:10px; text-align:left;">Tanggal</th>
            <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
            <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
            <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
            <th style="padding:10px; text-align:left;">Surveyor</th>
            <th style="padding:10px; text-align:left;">Lokasi</th>
            <th style="padding:10px; text-align:left;">Objek Penilaian</th>
            <th style="padding:10px; text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($dataAktif as $data)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px; text-align:left;">{{ $data['tanggal'] }}</td>
            <td style="padding:10px; text-align:left;">{{ $data['jenis'] }}</td>
            <td style="padding:10px; text-align:left;">{{ $data['pemberi'] }}</td>
            <td style="padding:10px; text-align:left;">{{ $data['pengguna'] }}</td>

            {{-- KOLOM BARU --}}
            <td style="padding:10px; text-align:left;">
                {{ $data['surveyor'] ?? '-' }}
            </td>

            <td style="padding:10px; text-align:left;">
                {{ $data['lokasi'] ?? '-' }}
            </td>

            <td style="padding:10px; text-align:left;">
                {{ $data['objek'] ?? '-' }}
            </td>

            {{-- STATUS WARNA --}}
            <td style="
                padding:10px;
                text-align:left;
                font-weight:600; 
                color:
                    @if(($data['status_progres'] ?? '') === 'Selesai')
                        #28a745
                    @elseif(($data['status_progres'] ?? '') === 'Reviewer')
                        #007bff
                    @elseif(($data['status_progres'] ?? '') === 'Proses')
                        #ffc107
                    @else
                        #dc3545
                    @endif
            ">
                {{ $data['status_progres'] ?? 'Proses' }}
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
