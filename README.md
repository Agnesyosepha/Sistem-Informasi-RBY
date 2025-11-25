# Sistem-Informasi-RBY

@extends('superadmin.app2')

@section('title', 'Proposal')

@section('content')

<h1><i class="fas fa-file-invoice"></i> Daftar Proposal</h1>
<p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <!-- Tombol Tambah Proposal -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Proposal
    </button>

    <!-- Modal -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">

        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Proposal</h2>

            <form action="{{ route('superadmin.admin.SAproposal.store') }}" method="POST">
                @csrf

                <label>Nama Objek</label>
                <input type="text" name="judul" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Debitur</label>
                <input type="text" name="pengaju" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Disetujui</label>
                <input type="date" name="tgl_disetujui"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Berakhir</label>
                <input type="date" name="tgl_berakhir"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Menunggu Review">Menunggu Review</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Direvisi">Direvisi</option>
                    <option value="Proses">Proses</option>
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

    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_pengajuan'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_berakhir'] }}</td>
                        <td style="padding:10px; text-align:center;">
                          <select
                            onchange="updateStatus({{ $p->id }}, this)"
                            style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                            class="status-select"
                            data-status="{{ $p->status }}">
                            <option value="Menunggu Review" {{ $p->status == 'Menunggu Review' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="Disetujui" {{ $p->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Direvisi" {{ $p->status == 'Direvisi' ? 'selected' : '' }}>Direvisi</option>
                            <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                          </select>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button type="button"
                                onclick="openModal('{{ route('superadmin.admin.SAproposal.destroy', $p->id) }}')"
                                style="background:#dc3545; color:white; padding:6px 12px;
                                border:none; border-radius:5px; cursor:pointer;">
                                Hapus
                            </button>
                        </td>

                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" style="
    display:none; position:fixed; z-index:2000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="background:white; margin:auto; padding:20px;
        border-radius:10px; width:30%; text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        
        <h3 style="margin-bottom:15px;">Konfirmasi Hapus</h3>
        <p>Apakah kamu yakin ingin menghapus proposal ini?</p>

        <form id="formHapus" method="POST" style="display:flex; gap:10px; justify-content:center; margin-top:15px;">
        @csrf
        @method('DELETE')

        <button type="submit"
            style="background:#dc3545; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Ya, Hapus!
        </button>

        <button type="button" onclick="closeModal()"
            style="background:#6c757d; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Batal
        </button>
        </form>

    </div>

</div>

@section('scripts')

<script>
function applyColor(selectElement) {
    const value = selectElement.value;

    if (value === "Disetujui") {
        selectElement.style.color = "green";
    } 
    else if (value === "Menunggu Review") {
        selectElement.style.color = "orange";
    } 
    else if (value === "Direvisi") {
        selectElement.style.color = "blue";
    } 
    else if (value === "Proses") {
        selectElement.style.color = "blue";
    }
}

// Saat halaman pertama kali load
document.querySelectorAll('.status-select').forEach(select => {
    applyColor(select);
});

function updateStatus(id, selectElement) {
    applyColor(selectElement);

    fetch(`/admin/proposal/update-status/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: selectElement.value })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));
}

// Hapus
function openModal(actionUrl) {
    document.getElementById('formHapus').action = actionUrl;
    document.getElementById('modalHapus').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalHapus').style.display = 'none';
}

</script>

@endsection
@extends('superadmin.app2')

@section('title', 'Proposal')

@section('content')

<h1><i class="fas fa-file-invoice"></i> Daftar Proposal</h1>
<p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <!-- Tombol Tambah Proposal -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Proposal
    </button>

    <!-- Modal -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">

        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Proposal</h2>

            <form action="{{ route('superadmin.admin.SAproposal.store') }}" method="POST">
                @csrf

                <label>Nama Objek</label>
                <input type="text" name="judul" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Debitur</label>
                <input type="text" name="pengaju" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Disetujui</label>
                <input type="date" name="tgl_disetujui"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Berakhir</label>
                <input type="date" name="tgl_berakhir"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Menunggu Review">Menunggu Review</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Direvisi">Direvisi</option>
                    <option value="Proses">Proses</option>
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

    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_pengajuan'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_berakhir'] }}</td>
                        <td style="padding:10px; text-align:center;">
                          <select
                            onchange="updateStatus({{ $p->id }}, this)"
                            style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                            class="status-select"
                            data-status="{{ $p->status }}">
                            <option value="Menunggu Review" {{ $p->status == 'Menunggu Review' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="Disetujui" {{ $p->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Direvisi" {{ $p->status == 'Direvisi' ? 'selected' : '' }}>Direvisi</option>
                            <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                          </select>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button type="button"
                                onclick="openModal('{{ route('superadmin.admin.SAproposal.destroy', $p->id) }}')"
                                style="background:#dc3545; color:white; padding:6px 12px;
                                border:none; border-radius:5px; cursor:pointer;">
                                Hapus
                            </button>
                        </td>

                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" style="
    display:none; position:fixed; z-index:2000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="background:white; margin:auto; padding:20px;
        border-radius:10px; width:30%; text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        
        <h3 style="margin-bottom:15px;">Konfirmasi Hapus</h3>
        <p>Apakah kamu yakin ingin menghapus proposal ini?</p>

        <form id="formHapus" method="POST" style="display:flex; gap:10px; justify-content:center; margin-top:15px;">
        @csrf
        @method('DELETE')

        <button type="submit"
            style="background:#dc3545; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Ya, Hapus!
        </button>

        <button type="button" onclick="closeModal()"
            style="background:#6c757d; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Batal
        </button>
        </form>

    </div>

</div>

@section('scripts')

<script>
function applyColor(selectElement) {
    const value = selectElement.value;

    if (value === "Disetujui") {
        selectElement.style.color = "green";
    } 
    else if (value === "Menunggu Review") {
        selectElement.style.color = "orange";
    } 
    else if (value === "Direvisi") {
        selectElement.style.color = "blue";
    } 
    else if (value === "Proses") {
        selectElement.style.color = "blue";
    }
}

// Saat halaman pertama kali load
document.querySelectorAll('.status-select').forEach(select => {
    applyColor(select);
});

function updateStatus(id, selectElement) {
    applyColor(selectElement);

    fetch(`/admin/proposal/update-status/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: selectElement.value })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));
}

// Hapus
function openModal(actionUrl) {
    document.getElementById('formHapus').action = actionUrl;
    document.getElementById('modalHapus').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalHapus').style.display = 'none';
}

</script>

@endsection
@extends('superadmin.app2')

@section('title', 'Proposal')

@section('content')

<h1><i class="fas fa-file-invoice"></i> Daftar Proposal</h1>
<p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <!-- Tombol Tambah Proposal -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Proposal
    </button>

    <!-- Modal -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">

        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Proposal</h2>

            <form action="{{ route('superadmin.admin.SAproposal.store') }}" method="POST">
                @csrf

                <label>Nama Objek</label>
                <input type="text" name="judul" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Debitur</label>
                <input type="text" name="pengaju" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Disetujui</label>
                <input type="date" name="tgl_disetujui"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Berakhir</label>
                <input type="date" name="tgl_berakhir"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Menunggu Review">Menunggu Review</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Direvisi">Direvisi</option>
                    <option value="Proses">Proses</option>
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

    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_pengajuan'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_berakhir'] }}</td>
                        <td style="padding:10px; text-align:center;">
                          <select
                            onchange="updateStatus({{ $p->id }}, this)"
                            style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                            class="status-select"
                            data-status="{{ $p->status }}">
                            <option value="Menunggu Review" {{ $p->status == 'Menunggu Review' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="Disetujui" {{ $p->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Direvisi" {{ $p->status == 'Direvisi' ? 'selected' : '' }}>Direvisi</option>
                            <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                          </select>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button type="button"
                                onclick="openModal('{{ route('superadmin.admin.SAproposal.destroy', $p->id) }}')"
                                style="background:#dc3545; color:white; padding:6px 12px;
                                border:none; border-radius:5px; cursor:pointer;">
                                Hapus
                            </button>
                        </td>

                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" style="
    display:none; position:fixed; z-index:2000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="background:white; margin:auto; padding:20px;
        border-radius:10px; width:30%; text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        
        <h3 style="margin-bottom:15px;">Konfirmasi Hapus</h3>
        <p>Apakah kamu yakin ingin menghapus proposal ini?</p>

        <form id="formHapus" method="POST" style="display:flex; gap:10px; justify-content:center; margin-top:15px;">
        @csrf
        @method('DELETE')

        <button type="submit"
            style="background:#dc3545; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Ya, Hapus!
        </button>

        <button type="button" onclick="closeModal()"
            style="background:#6c757d; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Batal
        </button>
        </form>

    </div>

</div>

@section('scripts')

<script>
function applyColor(selectElement) {
    const value = selectElement.value;

    if (value === "Disetujui") {
        selectElement.style.color = "green";
    } 
    else if (value === "Menunggu Review") {
        selectElement.style.color = "orange";
    } 
    else if (value === "Direvisi") {
        selectElement.style.color = "blue";
    } 
    else if (value === "Proses") {
        selectElement.style.color = "blue";
    }
}

// Saat halaman pertama kali load
document.querySelectorAll('.status-select').forEach(select => {
    applyColor(select);
});

function updateStatus(id, selectElement) {
    applyColor(selectElement);

    fetch(`/admin/proposal/update-status/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: selectElement.value })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));
}

// Hapus
function openModal(actionUrl) {
    document.getElementById('formHapus').action = actionUrl;
    document.getElementById('modalHapus').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalHapus').style.display = 'none';
}

</script>

@endsection
@extends('superadmin.app2')

@section('title', 'Proposal')

@section('content')

<h1><i class="fas fa-file-invoice"></i> Daftar Proposal</h1>
<p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <!-- Tombol Tambah Proposal -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Proposal
    </button>

    <!-- Modal -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">

        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Proposal</h2>

            <form action="{{ route('superadmin.admin.SAproposal.store') }}" method="POST">
                @csrf

                <label>Nama Objek</label>
                <input type="text" name="judul" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Debitur</label>
                <input type="text" name="pengaju" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Disetujui</label>
                <input type="date" name="tgl_disetujui"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Berakhir</label>
                <input type="date" name="tgl_berakhir"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Menunggu Review">Menunggu Review</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Direvisi">Direvisi</option>
                    <option value="Proses">Proses</option>
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

    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_pengajuan'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_berakhir'] }}</td>
                        <td style="padding:10px; text-align:center;">
                          <select
                            onchange="updateStatus({{ $p->id }}, this)"
                            style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                            class="status-select"
                            data-status="{{ $p->status }}">
                            <option value="Menunggu Review" {{ $p->status == 'Menunggu Review' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="Disetujui" {{ $p->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Direvisi" {{ $p->status == 'Direvisi' ? 'selected' : '' }}>Direvisi</option>
                            <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                          </select>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button type="button"
                                onclick="openModal('{{ route('superadmin.admin.SAproposal.destroy', $p->id) }}')"
                                style="background:#dc3545; color:white; padding:6px 12px;
                                border:none; border-radius:5px; cursor:pointer;">
                                Hapus
                            </button>
                        </td>

                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" style="
    display:none; position:fixed; z-index:2000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="background:white; margin:auto; padding:20px;
        border-radius:10px; width:30%; text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        
        <h3 style="margin-bottom:15px;">Konfirmasi Hapus</h3>
        <p>Apakah kamu yakin ingin menghapus proposal ini?</p>

        <form id="formHapus" method="POST" style="display:flex; gap:10px; justify-content:center; margin-top:15px;">
        @csrf
        @method('DELETE')

        <button type="submit"
            style="background:#dc3545; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Ya, Hapus!
        </button>

        <button type="button" onclick="closeModal()"
            style="background:#6c757d; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Batal
        </button>
        </form>

    </div>

</div>

@section('scripts')

<script>
function applyColor(selectElement) {
    const value = selectElement.value;

    if (value === "Disetujui") {
        selectElement.style.color = "green";
    } 
    else if (value === "Menunggu Review") {
        selectElement.style.color = "orange";
    } 
    else if (value === "Direvisi") {
        selectElement.style.color = "blue";
    } 
    else if (value === "Proses") {
        selectElement.style.color = "blue";
    }
}

// Saat halaman pertama kali load
document.querySelectorAll('.status-select').forEach(select => {
    applyColor(select);
});

function updateStatus(id, selectElement) {
    applyColor(selectElement);

    fetch(`/admin/proposal/update-status/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: selectElement.value })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));
}

// Hapus
function openModal(actionUrl) {
    document.getElementById('formHapus').action = actionUrl;
    document.getElementById('modalHapus').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalHapus').style.display = 'none';
}

</script>

@endsection
@extends('superadmin.app2')

@section('title', 'Proposal')

@section('content')

<h1><i class="fas fa-file-invoice"></i> Daftar Proposal</h1>
<p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <!-- Tombol Tambah Proposal -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Proposal
    </button>

    <!-- Modal -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">

        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Proposal</h2>

            <form action="{{ route('superadmin.admin.SAproposal.store') }}" method="POST">
                @csrf

                <label>Nama Objek</label>
                <input type="text" name="judul" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Debitur</label>
                <input type="text" name="pengaju" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Disetujui</label>
                <input type="date" name="tgl_disetujui"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Berakhir</label>
                <input type="date" name="tgl_berakhir"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Menunggu Review">Menunggu Review</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Direvisi">Direvisi</option>
                    <option value="Proses">Proses</option>
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

    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_pengajuan'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_berakhir'] }}</td>
                        <td style="padding:10px; text-align:center;">
                          <select
                            onchange="updateStatus({{ $p->id }}, this)"
                            style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                            class="status-select"
                            data-status="{{ $p->status }}">
                            <option value="Menunggu Review" {{ $p->status == 'Menunggu Review' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="Disetujui" {{ $p->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Direvisi" {{ $p->status == 'Direvisi' ? 'selected' : '' }}>Direvisi</option>
                            <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                          </select>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button type="button"
                                onclick="openModal('{{ route('superadmin.admin.SAproposal.destroy', $p->id) }}')"
                                style="background:#dc3545; color:white; padding:6px 12px;
                                border:none; border-radius:5px; cursor:pointer;">
                                Hapus
                            </button>
                        </td>

                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" style="
    display:none; position:fixed; z-index:2000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="background:white; margin:auto; padding:20px;
        border-radius:10px; width:30%; text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        
        <h3 style="margin-bottom:15px;">Konfirmasi Hapus</h3>
        <p>Apakah kamu yakin ingin menghapus proposal ini?</p>

        <form id="formHapus" method="POST" style="display:flex; gap:10px; justify-content:center; margin-top:15px;">
        @csrf
        @method('DELETE')

        <button type="submit"
            style="background:#dc3545; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Ya, Hapus!
        </button>

        <button type="button" onclick="closeModal()"
            style="background:#6c757d; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Batal
        </button>
        </form>

    </div>

</div>

@section('scripts')

<script>
function applyColor(selectElement) {
    const value = selectElement.value;

    if (value === "Disetujui") {
        selectElement.style.color = "green";
    } 
    else if (value === "Menunggu Review") {
        selectElement.style.color = "orange";
    } 
    else if (value === "Direvisi") {
        selectElement.style.color = "blue";
    } 
    else if (value === "Proses") {
        selectElement.style.color = "blue";
    }
}

// Saat halaman pertama kali load
document.querySelectorAll('.status-select').forEach(select => {
    applyColor(select);
});

function updateStatus(id, selectElement) {
    applyColor(selectElement);

    fetch(`/admin/proposal/update-status/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: selectElement.value })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));
}

// Hapus
function openModal(actionUrl) {
    document.getElementById('formHapus').action = actionUrl;
    document.getElementById('modalHapus').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalHapus').style.display = 'none';
}

</script>

@endsection
@extends('superadmin.app2')

@section('title', 'Proposal')

@section('content')
<h1><i class="fas fa-file-invoice"></i> Daftar Proposal</h1>
<p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <!-- Tombol Tambah Proposal -->
    <button onclick="document.getElementById('modalTambah').style.display='block'"
        style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
        + Tambah Proposal
    </button>

    <!-- Modal -->
    <div id="modalTambah" style="
        display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
        background:rgba(0,0,0,0.5); padding-top:60px;">

        <div style="
            background:white; margin:auto; padding:20px; border-radius:10px; width:40%;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);">

            <h2 style="margin-bottom:15px;">Tambah Proposal</h2>

            <form action="{{ route('superadmin.admin.SAproposal.store') }}" method="POST">
                @csrf

                <label>Nama Objek</label>
                <input type="text" name="judul" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Debitur</label>
                <input type="text" name="pengaju" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal" required
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Disetujui</label>
                <input type="date" name="tgl_disetujui"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Tanggal Berakhir</label>
                <input type="date" name="tgl_berakhir"
                    style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

                <label>Status</label>
                <select name="status"
                    style="width:100%; padding:8px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
                    <option value="Menunggu Review">Menunggu Review</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Direvisi">Direvisi</option>
                    <option value="Proses">Proses</option>
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

    <!-- Tabel Proposal -->
    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_pengajuan'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal_berakhir'] }}</td>
                        <td style="padding:10px; text-align:center;">
                          <select
                            onchange="updateStatus({{ $p->id }}, this)"
                            style="padding:6px; border-radius:5px; border:1px solid #ccc; font-weight:600;"
                            class="status-select"
                            data-status="{{ $p->status }}">
                            <option value="Menunggu Review" {{ $p->status == 'Menunggu Review' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="Disetujui" {{ $p->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Direvisi" {{ $p->status == 'Direvisi' ? 'selected' : '' }}>Direvisi</option>
                            <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                          </select>
                        </td>
                        <td style="padding:10px; text-align:center;">
                            <button type="button"
                                onclick="openModal('{{ route('superadmin.admin.SAproposal.destroy', $p->id) }}')"
                                style="background:#dc3545; color:white; padding:6px 12px;
                                border:none; border-radius:5px; cursor:pointer;">
                                Hapus
                            </button>
                        </td>

                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" style="
    display:none; position:fixed; z-index:2000;
    left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">
    
    <div style="background:white; margin:auto; padding:20px;
        border-radius:10px; width:30%; text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        
        <h3 style="margin-bottom:15px;">Konfirmasi Hapus</h3>
        <p>Apakah kamu yakin ingin menghapus proposal ini?</p>

        <form id="formHapus" method="POST" style="display:flex; gap:10px; justify-content:center; margin-top:15px;">
        @csrf
        @method('DELETE')

        <button type="submit"
            style="background:#dc3545; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Ya, Hapus!
        </button>

        <button type="button" onclick="closeModal()"
            style="background:#6c757d; color:white; padding:10px 18px;
            border:none; border-radius:6px; cursor:pointer;">
            Batal
        </button>
        </form>

    </div>

</div>

@section('scripts')

<script>
function applyColor(selectElement) {
    const value = selectElement.value;

    if (value === "Disetujui") {
        selectElement.style.color = "green";
    } 
    else if (value === "Menunggu Review") {
        selectElement.style.color = "orange";
    } 
    else if (value === "Direvisi") {
        selectElement.style.color = "blue";
    } 
    else if (value === "Proses") {
        selectElement.style.color = "blue";
    }
}

// Saat halaman pertama kali load
document.querySelectorAll('.status-select').forEach(select => {
    applyColor(select);
});

function updateStatus(id, selectElement) {
    applyColor(selectElement);

    fetch(`/admin/proposal/update-status/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: selectElement.value })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));
}

// Hapus
function openModal(actionUrl) {
    document.getElementById('formHapus').action = actionUrl;
    document.getElementById('modalHapus').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalHapus').style.display = 'none';
}

</script>

@endsection

.
.
.
..
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
...
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
0
0
0
0
0
0
0
0
0
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
.
