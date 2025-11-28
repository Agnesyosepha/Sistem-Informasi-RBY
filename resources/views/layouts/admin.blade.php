@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<h1><i class="fas fa-user-cog"></i> Dashboard Admin</h1>
<p>Panel kontrol administrator untuk mengelola sistem dan pengguna.</p>

<!-- Statistik Utama -->
<div class="dashboard-cards">
    <a href="{{ route('admin.proposal') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file-invoice"></i> Daftar Proposal</h3>
            <p><strong>{{ $jumlahProposal }} Record</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.adendum') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-plus-square"></i> Adendum</h3>
            <p><strong style="color:green;">Online</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.suratTugas') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file-signature"></i> Surat Tugas</h3>
            <p><strong>350</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.draftResume') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file"></i> Draft Resume</h3>
            <p><strong>2 dokumen</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.draftLaporan') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file"></i> Draft Laporan</h3>
            <p><strong>2 dokumen</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.laporanFinal') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-book"></i> Buku Laporan Final</h3>
            <p><strong>6 dokumen</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.tim') }}" class="dashboard-card" style="display:block; color:inherit; text-decoration:none;">
        <h3><i class="fas fa-user"></i> Admin</h3>
        <p><strong>2 Staff</strong></p>
    </a>
</div>

<!-- Tabel Aktivitas -->
<div class="dashboard-card" style="margin-top:30px;">
    <h3><i class="fas fa-clipboard-list"></i> Tugas Harian</h3>
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Debitur</th>
                <th style="padding:10px; text-align:left;">No.PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Survei</th>
                <th style="padding:10px; text-align:left;">Tim Lapangan</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugasHarian as $tugas)
                <tr class="tugas-row" style="border-bottom:1px solid #ddd; cursor: pointer;" data-id="{{ $tugas->id }}">
                    <td style="padding:10px; text-align:left;">{{ $tugas->pemberi_tugas }}</td>
                    <td style="padding:10px; text-align:left;">{{ $tugas->debitur }}</td>
                    <td style="padding:10px; text-align:left;">{{ $tugas->no_ppjp }}</td>
                    <td style="padding:10px; text-align:left;">{{ $tugas->tanggal_survei }}</td>
                    <td style="padding:10px; text-align:left;">{{ $tugas->tim_lapangan }}</td>
                    <td style="padding:10px; text-align:left; font-weight:600;">
                        <span class="status-label" data-status="{{ $tugas->status }}">
                            {{ $tugas->status }}
                        </span>
                    </td>
                </tr>
                
                <!-- Baris dropdown untuk tahapan (awalnya disembunyikan) -->
                <tr class="tahapan-row" id="tahapan-{{ $tugas->id }}" style="display: none; background-color: #f8f9fa;">
                    <td colspan="6" style="padding: 15px;">
                        <div class="tahapan-container">
                            <h4 style="margin-top: 0; margin-bottom: 15px; text-align: center;">Tahapan Pekerjaan</h4>
                            
                            <!-- Tahapan 1 -->
                            <div class="tahapan-item" data-value="pengumpulan awal">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">1.</span>
                                    <span class="tahapan-title">Pengumpulan Awal</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan1-{{ $tugas->id }}">
                                        <label for="tahapan1-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Mengumpulkan semua dokumen awal dari debitur</p>
                                    <p><strong>Ciri-ciri:</strong> Dokumen lengkap, identitas terverifikasi, data awal terkumpul</p>
                                    <p><strong>Waktu Estimasi:</strong> 1-2 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 2 -->
                            <div class="tahapan-item" data-value="pembuatan invoice DP">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">2.</span>
                                    <span class="tahapan-title">Pembuatan Invoice DP</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan2-{{ $tugas->id }}">
                                        <label for="tahapan2-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Membuat invoice untuk pembayaran uang muka</p>
                                    <p><strong>Ciri-ciri:</strong> Nomor invoice tergenerate, detail pembayaran jelas</p>
                                    <p><strong>Waktu Estimasi:</strong> 1 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 3 -->
                            <div class="tahapan-item" data-value="penjadwalan inspeksi">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">3.</span>
                                    <span class="tahapan-title">Penjadwalan Inspeksi</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan3-{{ $tugas->id }}">
                                        <label for="tahapan3-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Menjadwalkan waktu inspeksi dengan debitur</p>
                                    <p><strong>Ciri-ciri:</strong> Tanggal dan waktu disepakati, lokasi ditentukan</p>
                                    <p><strong>Waktu Estimasi:</strong> 1-2 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 4 -->
                            <div class="tahapan-item" data-value="inspeksi">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">4.</span>
                                    <span class="tahapan-title">Inspeksi</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan4-{{ $tugas->id }}">
                                        <label for="tahapan4-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Melakukan inspeksi lapangan terhadap objek</p>
                                    <p><strong>Ciri-ciri:</strong> Foto dokumentasi, data lapangan terkumpul, checklist terisi</p>
                                    <p><strong>Waktu Estimasi:</strong> 1 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 5 -->
                            <div class="tahapan-item" data-value="proses analisa">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">5.</span>
                                    <span class="tahapan-title">Proses Analisa</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan5-{{ $tugas->id }}">
                                        <label for="tahapan5-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Menganalisis data yang telah dikumpulkan</p>
                                    <p><strong>Ciri-ciri:</strong> Data terverifikasi, perhitungan awal selesai</p>
                                    <p><strong>Waktu Estimasi:</strong> 2-3 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 6 -->
                            <div class="tahapan-item" data-value="review nilai">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">6.</span>
                                    <span class="tahapan-title">Review Nilai</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan6-{{ $tugas->id }}">
                                        <label for="tahapan6-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Review hasil analisa oleh senior appraiser</p>
                                    <p><strong>Ciri-ciri:</strong> Nilai disetujui, catatan review ditindaklanjuti</p>
                                    <p><strong>Waktu Estimasi:</strong> 1-2 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 7 -->
                            <div class="tahapan-item" data-value="kirim draft resume">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">7.</span>
                                    <span class="tahapan-title">Kirim Draft Resume</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan7-{{ $tugas->id }}">
                                        <label for="tahapan7-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Mengirim draft resume kepada klien</p>
                                    <p><strong>Ciri-ciri:</strong> Draft resume terkirim, bukti pengiriman tersimpan</p>
                                    <p><strong>Waktu Estimasi:</strong> 1 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 8 -->
                            <div class="tahapan-item" data-value="draft laporan">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">8.</span>
                                    <span class="tahapan-title">Draft Laporan</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan8-{{ $tugas->id }}">
                                        <label for="tahapan8-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Menyusun draft laporan lengkap</p>
                                    <p><strong>Ciri-ciri:</strong> Laporan terstruktur, data lengkap, analisa mendalam</p>
                                    <p><strong>Waktu Estimasi:</strong> 2-3 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 9 -->
                            <div class="tahapan-item" data-value="review/final">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">9.</span>
                                    <span class="tahapan-title">Review/Final</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan9-{{ $tugas->id }}">
                                        <label for="tahapan9-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Review final laporan sebelum pencetakan</p>
                                    <p><strong>Ciri-ciri:</strong> Laporan bebas error, format sesuai standar</p>
                                    <p><strong>Waktu Estimasi:</strong> 1 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 10 -->
                            <div class="tahapan-item" data-value="nomor laporan">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">10.</span>
                                    <span class="tahapan-title">Nomor Laporan</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan10-{{ $tugas->id }}">
                                        <label for="tahapan10-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Memberikan nomor resmi pada laporan</p>
                                    <p><strong>Ciri-ciri:</strong> Nomor laporan tergenerate, tercatat dalam sistem</p>
                                    <p><strong>Waktu Estimasi:</strong> Setengah hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 11 -->
                            <div class="tahapan-item" data-value="laporan rangkap">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">11.</span>
                                    <span class="tahapan-title">Laporan Rangkap</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan11-{{ $tugas->id }}">
                                        <label for="tahapan11-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Mencetak laporan dalam beberapa rangkap</p>
                                    <p><strong>Ciri-ciri:</strong> Laporan tercetak lengkap, disimpan dengan baik</p>
                                    <p><strong>Waktu Estimasi:</strong> 1 hari</p>
                                </div>
                            </div>
                            
                            <!-- Tahapan 12 -->
                            <div class="tahapan-item" data-value="pengiriman dokumen">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">12.</span>
                                    <span class="tahapan-title">Pengiriman Dokumen</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan12-{{ $tugas->id }}">
                                        <label for="tahapan12-{{ $tugas->id }}">Selesai</label>
                                    </div>
                                </div>
                                <div class="tahapan-details">
                                    <p><strong>Tugas:</strong> Mengirim dokumen lengkap kepada klien</p>
                                    <p><strong>Ciri-ciri:</strong> Dokumen terkirim, bukti pengiriman tersimpan</p>
                                    <p><strong>Waktu Estimasi:</strong> 1-2 hari</p>
                                </div>
                            </div>
                            
                            <div class="tahapan-current">
                                <strong>Tahapan Saat Ini:</strong> 
                                <span id="current-tahapan-{{ $tugas->id }}">{{ $tugas->tahapan ?? 'Belum ditentukan' }}</span>
                            </div>
                            
                            <div class="tahapan-actions">
                                <button class="btn-save-tahapan" data-id="{{ $tugas->id }}">Simpan Progress</button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('sidebar')
<aside class="sidebar" id="sidebar">
    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i><span> Home</span></a></li>
            <li><a href="{{ route('admin') }}" class="{{ request()->routeIs('admin*') ? 'active' : '' }}"><i class="fas fa-user-cog"></i><span> Admin</span></a></li>
            <li><a href="{{ route('surveyor') }}" class="{{ request()->routeIs('surveyor*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i><span> Surveyor</span></a></li>
            <li><a href="{{ route('edp') }}" class="{{ request()->routeIs('edp*') ? 'active' : '' }}"><i class="fas fa-desktop"></i><span> EDP</span></a></li>
            <li><a href="{{ route('reviewer') }}" class="{{ request()->routeIs('reviewer*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i><span> Reviewer</span></a></li>
            <li><a href="{{ route('finance') }}" class="{{ request()->routeIs('finance*') ? 'active' : '' }}"><i class="fas fa-file-invoice-dollar"></i><span> Finance</span></a></li>
            <li><a href="{{ route('it') }}" class="{{ request()->routeIs('it*') ? 'active' : '' }}"><i class="fas fa-server"></i><span> IT</span></a></li>
        </ul>
    </nav>
</aside>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        document.querySelector('.main-content').classList.toggle('collapsed');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".status-label").forEach(function(label) {
        const value = label.getAttribute("data-status");

        if (value === "Urgent") {
            label.style.color = "orange";
        } 
        else if (value === "Sangat Urgent") {
            label.style.color = "red";
            }
        });
    });

    // Event listener untuk klik pada baris tugas
    document.querySelectorAll('.tugas-row').forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const tahapanRow = document.getElementById(`tahapan-${id}`);
            
            // Toggle visibility
            if (tahapanRow.style.display === 'none') {
                // Close all other dropdowns first
                document.querySelectorAll('.tahapan-row').forEach(row => {
                    row.style.display = 'none';
                });
                
                tahapanRow.style.display = 'table-row';
            } else {
                tahapanRow.style.display = 'none';
            }
        });
    });

    // Event listener untuk checkbox tahapan
    document.querySelectorAll('.tahapan-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const tahapanItem = this.closest('.tahapan-item');
            const tahapanRow = this.closest('.tahapan-row');
            const id = tahapanRow.id.replace('tahapan-', '');
            const currentTahapanSpan = document.getElementById(`current-tahapan-${id}`);
            
            // Update current tahapan based on checked item
            if (this.checked) {
                currentTahapanSpan.textContent = tahapanItem.getAttribute('data-value');
                
                // Remove active class from all items
                document.querySelectorAll(`#tahapan-${id} .tahapan-item`).forEach(item => {
                    item.classList.remove('active');
                });
                
                // Add active class to selected item
                tahapanItem.classList.add('active');
            }
        });
    });

    // Event listener untuk tombol simpan
    document.querySelectorAll('.btn-save-tahapan').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const id = this.getAttribute('data-id');
            const currentTahapanSpan = document.getElementById(`current-tahapan-${id}`);
            const currentTahapan = currentTahapanSpan.textContent;
            
            // Collect all checked stages
            const checkedStages = [];
            document.querySelectorAll(`#tahapan-${id} .tahapan-checkbox:checked`).forEach(checkbox => {
                const tahapanItem = checkbox.closest('.tahapan-item');
                checkedStages.push(tahapanItem.getAttribute('data-value'));
            });
            
            // Send update to server
            fetch(`/admin/tugas-harian/update-tahapan/${id}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ 
                    tahapan: currentTahapan,
                    checked_stages: checkedStages
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data.message);
                // Show success message
                const successMsg = document.createElement('div');
                successMsg.className = 'alert alert-success';
                successMsg.textContent = 'Progress berhasil disimpan!';
                successMsg.style.position = 'fixed';
                successMsg.style.top = '20px';
                successMsg.style.right = '20px';
                successMsg.style.padding = '10px 20px';
                successMsg.style.backgroundColor = '#28a745';
                successMsg.style.color = 'white';
                successMsg.style.borderRadius = '5px';
                successMsg.style.zIndex = '9999';
                
                document.body.appendChild(successMsg);
                
                setTimeout(() => {
                    successMsg.remove();
                }, 3000);
            })
            .catch(err => console.error(err));
        });
    });

    // Set active class for current tahapan
    document.querySelectorAll('.tahapan-row').forEach(row => {
        const id = row.id.replace('tahapan-', '');
        const currentTahapanSpan = document.getElementById(`current-tahapan-${id}`);
        const currentTahapan = currentTahapanSpan.textContent;
        
        if (currentTahapan !== 'Belum ditentukan') {
            document.querySelectorAll(`#tahapan-${id} .tahapan-item`).forEach(item => {
                if (item.getAttribute('data-value') === currentTahapan) {
                    item.classList.add('active');
                    // Check the corresponding checkbox
                    const checkbox = item.querySelector('.tahapan-checkbox');
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                }
            });
        }
    });

</script>

<style>
.tahapan-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.tahapan-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.tahapan-item:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.tahapan-item.active {
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
}

.tahapan-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    background-color: #f8f9fa;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.tahapan-number {
    font-weight: bold;
    color: #007bff;
    margin-right: 10px;
    font-size: 18px;
}

.tahapan-title {
    font-weight: 600;
    flex-grow: 1;
}

.tahapan-status {
    display: flex;
    align-items: center;
}

.tahapan-status input[type="checkbox"] {
    margin-right: 5px;
}

.tahapan-details {
    padding: 15px;
    display: none;
    background-color: #fff;
}

.tahapan-item.active .tahapan-details {
    display: block;
}

.tahapan-details p {
    margin: 0 0 10px 0;
}

.tahapan-details p:last-child {
    margin-bottom: 0;
}

.tahapan-current {
    margin-top: 15px;
    padding: 10px;
    background-color: #e9ecef;
    border-radius: 4px;
    text-align: center;
    font-weight: 600;
}

.tahapan-actions {
    margin-top: 15px;
    text-align: center;
}

.btn-save-tahapan {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.2s;
}

.btn-save-tahapan:hover {
    background-color: #218838;
}

.alert {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px;
    border-radius: 4px;
    color: white;
    font-weight: 600;
    z-index: 9999;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.alert-success {
    background-color: #28a745;
}

.alert-error {
    background-color: #dc3545;
}
</style>
@endsection