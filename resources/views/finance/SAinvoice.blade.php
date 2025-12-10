@extends('superadmin.app2')

@section('title', 'Invoice Admin')

@section('content')

<h1><i class="fas fa-file-invoice"></i> Invoice Admin</h1>
<p>Data - data keuangan yang perlu divalidasi.</p>

<!-- Tombol Tambah -->
<button onclick="document.getElementById('modalTambah').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Invoice
</button>

<!-- Modal Tambah Invoice -->
<div id="modalTambah" style="
    display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); padding-top:60px;">

    <div style="
    background:white; margin:auto; padding:20px; border-radius:10px; width:45%;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
    max-height: 80vh; overflow-y: auto;">
    
        <h3>Tambah Invoice</h3>

        <form method="POST" action="{{ route('superadmin.finance.storeInvoice') }}" enctype="multipart/form-data">
            @csrf

            <label>Tanggal:</label>
            <input type="date" name="tanggal_pembuat" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>No Invoice:</label>
            <input type="text" name="no_invoice" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>No PPJP / Adendum:</label>
            <input type="text" name="no_ppjp" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Debitur:</label>
            <input type="text" name="nama_klien" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Pemberi Tugas:</label>
            <input type="text" name="pemberi_tugas" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Pengguna Laporan:</label> 
            <input type="text" name="pengguna_laporan" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Termin:</label>
            <select name="termin" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                <option value="DP">DP</option>
                <option value="DP 2">DP 2</option>
                <option value="Pelunasan">Pelunasan</option>
                <option value="Lunas">Lunas</option>
            </select>

            <label>Biaya Jasa:</label>
            <div style="display: flex; margin-bottom:10px;">
                <span style="padding:8px; border:1px solid #ccc; border-radius:0 5px 0 5px; background:#f8f9fa;">Rp</span>
                <input type="number" name="biaya_jasa" step="0.01" required
                    style="width:100%; padding:8px; border:1px solid #ccc; border-radius:0 5px 5px 0;">
            </div>

            <label>Status:</label>
            <select name="status" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
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

<div class="dashboard-card" style="margin-top:20px;">
    <h3><i class="fas fa-receipt"></i> Data Invoice</h3>

    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr style="background:#007BFF; color:white;">
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">No. Invoice</th>
                <th style="padding:10px; text-align:left;">No. PPJP/No. Adendum</th>
                <th style="padding:10px; text-align:left;">Debitur</th>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
                <th style="padding:10px; text-align:left;">Termin</th>
                <th style="padding:10px; text-align:left;">Biaya Jasa</th>
                <th style="padding:10px; text-align:left;">Bukti DP</th>
                <th style="padding:10px; text-align:left;">Bukti Pelunasan</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($invoice as $item)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ \Carbon\Carbon::parse($item->tanggal_pembuat)->format('d-m Y') }}</td>
                <td style="padding:10px;">{{ $item['no_invoice'] }}</td>
                <td style="padding:10px;">{{ $item['no_ppjp'] }}</td>
                <td style="padding:10px;">{{ $item['nama_klien'] }}</td>
                <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
                <td style="padding:10px;">{{ $item['pengguna_laporan'] }}</td>
                <td style="padding:10px;">
                    <select onchange="changeColor(this); updateInvoice({{ $item->id }}, 'termin', this.value)"
                        style="padding:6px; font-weight:600; border-radius:5px;">       
                        <option value="DP" {{ $item->termin == 'DP' ? 'selected' : '' }}>DP</option>        
                        <option value="DP 2" {{ $item->termin == 'DP 2' ? 'selected' : '' }}>DP 2</option>    
                        <option value="Pelunasan" {{ $item->termin == 'Pelunasan' ? 'selected' : '' }}>Pelunasan</option>    
                        <option value="Lunas" {{ $item->termin == 'Lunas' ? 'selected' : '' }}>Lunas</option>    
                    </select>
                </td>
                <td style="padding:10px;">Rp {{ number_format($item->biaya_jasa, 2, ',', '.') }}</td>
                <td style="padding:10px;">
                    <!-- Bukti DP 1 -->
                    <div class="file-upload-container" style="margin-bottom: 5px;">
                        @if($item->bukti_dp)
                            <a href="{{ asset('storage/' . $item->bukti_dp) }}" target="_blank" 
                               style="color:#007BFF; text-decoration:none; margin-right: 5px;">
                                <i class="fas fa-file-download"></i>
                            </a>
                        @else
                            <input type="file" id="bukti_dp_{{ $item->id }}" class="file-input" accept="image/*,.pdf" 
                                   onchange="handleFileUpload(this)">
                            <label for="bukti_dp_{{ $item->id }}" class="file-label">
                                <i class="fas fa-upload"></i>
                            </label>
                        @endif
                    </div>
                    
                    <!-- Bukti DP 2 -->
                    <div class="file-upload-container">
                        @if($item->bukti_dp_2)
                            <a href="{{ asset('storage/' . $item->bukti_dp_2) }}" target="_blank" 
                               style="color:#007BFF; text-decoration:none; margin-right: 5px;">
                                <i class="fas fa-file-download"></i>
                            </a>
                        @else
                            <input type="file" id="bukti_dp_2_{{ $item->id }}" class="file-input" accept="image/*,.pdf" 
                                   onchange="handleFileUpload(this)">
                            <label for="bukti_dp_2_{{ $item->id }}" class="file-label">
                                <i class="fas fa-upload"></i>
                            </label>
                        @endif
                    </div>
                </td>
                <td style="padding:10px;">
                    @if($item->bukti_pelunasan)
                        <a href="{{ asset('storage/' . $item->bukti_pelunasan) }}" target="_blank" 
                           style="color:#007BFF; text-decoration:none;">
                            <i class="fas fa-file-download"></i>
                        </a>
                    @else
                        <input type="file" id="bukti_pelunasan_{{ $item->id }}" class="file-input" accept="image/*,.pdf" 
                               onchange="handleFileUpload(this)">
                        <label for="bukti_pelunasan_{{ $item->id }}" class="file-label">
                            <i class="fas fa-upload"></i>
                        </label>
                    @endif
                </td>
                <td style="padding:10px;">
                    <select onchange="changeColor(this); updateInvoice({{ $item->id }}, 'status', this.value)"
                        style="padding:6px; font-weight:600; border-radius:5px;">       
                        <option value="Paid" {{ $item->status == 'Paid' ? 'selected' : '' }}>Paid</option>        
                        <option value="Unpaid" {{ $item->status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>    
                    </select>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection

<script>
function updateInvoice(id, field, value) {
    fetch("{{ route('superadmin.finance.updateStatus') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            id: id,
            [field]: value
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("Updated:", data);
        if (data.success) {
            showNotification('Data berhasil diperbarui', 'success');
        } else {
            showNotification('Gagal memperbarui data', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        showNotification('Terjadi kesalahan', 'error');
    });
}

function changeColor(selectEl) {
    // Reset semua warna
    selectEl.style.color = "#333";
    
    if (selectEl.value === "Paid") {
        selectEl.style.color = "green";
    } else if (selectEl.value === "Unpaid") {
        selectEl.style.color = "red";
    } else if (selectEl.value === "DP") {
        selectEl.style.color = "#007BFF";
    } else if (selectEl.value === "DP 2") {
        selectEl.style.color = "#6f42c1"; // Ungu untuk DP 2
    } else if (selectEl.value === "Pelunasan") {
        selectEl.style.color = "#28a745"; // Hijau untuk Pelunasan
    } else if (selectEl.value === "Lunas") {
        selectEl.style.color = "#17a2b8"; // Biru muda untuk Lunas
    }
}

// FUNGSI UNTUK UPLOAD FILE
function handleFileUpload(input) {
    if (!input.files || !input.files[0]) {
        showNotification('Pilih file terlebih dahulu', 'error');
        return;
    }

    // 1. Dapatkan ID dan nama field dari ID input
    const idParts = input.id.split('_');
    const id = idParts[idParts.length - 1];
    
    // Menangani kasus khusus untuk bukti_dp_2
    let field;
    if (input.id.includes('bukti_dp_2')) {
        field = 'bukti_dp_2';
    } else {
        field = idParts.slice(0, -1).join('_');
    }
    
    // 2. Siapkan FormData
    const formData = new FormData();
    formData.append('file', input.files[0]);
    formData.append('id', id);
    formData.append('field', field);
    formData.append('_token', '{{ csrf_token() }}');
    
    // 3. Tampilkan indikator loading pada tombol
    const uploadBtn = input.nextElementSibling; // Ini adalah label
    const originalContent = uploadBtn.innerHTML;
    uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ';
    uploadBtn.style.pointerEvents = 'none'; // Nonaktifkan klik saat upload
    
    // 4. Kirim request
    fetch("{{ route('superadmin.finance.uploadFile') }}", {
        method: "POST",
        body: formData
    })
    .then(res => {
        // Check if response is OK
        if (!res.ok) {
            throw new Error('Network response was not ok');
        }
        return res.json();
    })
    .then(data => {
        console.log('Response data:', data); // Debugging
        
        // Check if response has a success property or if it has an error property
        if (data.success === true || !data.error) {
            showNotification('File berhasil diupload', 'success');
            // Reload halaman setelah 1 detik untuk menampilkan perubahan
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showNotification(data.message || data.error || 'Gagal mengupload file', 'error');
            // Kembalikan tombol ke keadaan semula jika gagal
            uploadBtn.innerHTML = originalContent;
            uploadBtn.style.pointerEvents = 'auto';
        }
    })
    .catch(err => {
        console.error('Error:', err);
        showNotification('Terjadi kesalahan saat mengupload file', 'error');
        // Kembalikan tombol ke keadaan semula jika error
        uploadBtn.innerHTML = originalContent;
        uploadBtn.style.pointerEvents = 'auto';
    });
}

function showNotification(message, type) {
    // Buat elemen notifikasi
    const notification = document.createElement('div');
    notification.className = 'notification ' + type;
    notification.textContent = message;
    
    // Tambahkan ke body
    document.body.appendChild(notification);
    
    // Tampilkan notifikasi
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Sembunyikan notifikasi setelah 3 detik
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Set warna saat halaman di-load
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("select").forEach(sel => changeColor(sel));
});
</script>

<style>
.file-upload-container {
    display: flex;
    align-items: center;
    gap: 5px;
}

.file-input {
    display: none;
}

.file-label {
    display: inline-block;
    padding: 6px 12px;
    background-color: #f8f9fa;
    border: 1px solid #ccc;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s;
    font-size: 12px;
}

.file-label:hover {
    background-color: #e9ecef;
}

.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    opacity: 0;
    transform: translateY(-20px);
    transition: opacity 0.3s, transform 0.3s;
    z-index: 9999;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.notification.success {
    background-color: #28a745;
}

.notification.error {
    background-color: #dc3545;
}

.notification.show {
    opacity: 1;
    transform: translateY(0);
}
</style>
