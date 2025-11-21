@extends('superadmin.app2')

@section('title', 'Surat Tugas')

@section('content')
    <h1><i class="fas fa-file-signature"></i> Input Surat Tugas</h1>
    <p>Berikut adalah daftar surat tugas yang telah dibuat oleh admin.</p>

    <!-- Tombol Tambah Surat Tugas -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Surat Tugas
    </button>

    <!-- Modal -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">
        
        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Surat Tugas</h2>

            <form action="{{ route('superadmin.admin.SAsuratTugas.store') }}" method="POST">
                @csrf

                <label>Nomor PPJP</label>
                <input type="text" name="no_ppjp" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal</label>
                <input type="date" name="tanggal" required
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
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Pending">Pending</option>
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

    <!-- Tabel Surat Tugas -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nomor PPJP</th>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Penilai</th>
                    <th style="padding:10px; text-align:left;">Adendum</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suratTugas as $st)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $st->no_ppjp }}</td>
                        <td style="padding:10px;">{{ $st->tanggal }}</td>
                        <td style="padding:10px;">{{ $st->pemberi_tugas }}</td>
                        <td style="padding:10px;">{{ $st->nama_penilai }}</td>
                        <td style="padding:10px;">{{ $st->adendum ?? '-' }}</td>
                        <td style="padding:10px; text-align:center;">
                            <select 
                                onchange="applyColor(this)" 
                                style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                                class="status-select"
                                data-status="{{ $st->status }}">
                                <option value="Proses" {{ $st->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ $st->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Pending" {{ $st->status == 'Pending' ? 'selected' : '' }}>Pending</option>
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

    if(value === 'Selesai') selectElement.style.color = 'green';
    else if(value === 'Proses') selectElement.style.color = 'blue';
    else if(value === 'Pending') selectElement.style.color = 'orange';
}

// Inisialisasi warna saat load
document.querySelectorAll('.status-select').forEach(select => applyColor(select));
</script>
@endsection
