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
            
            @php
                // Buat array asosiatif untuk mempermudah pencarian file berdasarkan tahapan_id
                $filesByTahapan = $tugas->files->keyBy('tahapan_id');

                // Data untuk setiap tahapan
                $tahapanData = [
                    1 => ['value' => 'pengumpulan awal', 'title' => 'Pengumpulan Data'],
                    2 => ['value' => 'pembuatan invoice DP', 'title' => 'Pembuatan Invoice DP'],
                    3 => ['value' => 'penjadwalan inspeksi', 'title' => 'Penjadwalan Inspeksi'],
                    4 => ['value' => 'inspeksi', 'title' => 'Inspeksi'],
                    5 => ['value' => 'proses analisa', 'title' => 'Proses Analisa'],
                    6 => ['value' => 'review nilai', 'title' => 'Review Nilai', 'is_final' => true],
                    7 => ['value' => 'kirim draft resume', 'title' => 'Kirim Draft Resume'],
                    8 => ['value' => 'draft laporan', 'title' => 'Draft Laporan'],
                    9 => ['value' => 'review/final', 'title' => 'Review/Final'],
                    10 => ['value' => 'nomor laporan', 'title' => 'Nomor Laporan'],
                    11 => ['value' => 'laporan rangkap', 'title' => 'Laporan Rangkap'],
                    12 => ['value' => 'pengiriman dokumen', 'title' => 'Pengiriman Dokumen'],
                ];
            @endphp

            @for ($i = 1; $i <= 12; $i++)
                @php
                    $data = $tahapanData[$i];
                    $hasFile = $filesByTahapan->has($i);
                    $file = $hasFile ? $filesByTahapan->get($i) : null;
                @endphp

                <div class="tahapan-item {{ $hasFile ? 'active' : '' }}" data-value="{{ $data['value'] }}">
                    <div class="tahapan-header">
                        <span class="tahapan-number">{{ $i }}.</span>
                        <span class="tahapan-title">{{ $data['title'] }}</span>
                        <div class="tahapan-status">
                            <input type="checkbox" class="tahapan-checkbox" id="tahapan{{ $i }}-{{ $tugas->id }}" data-tahapan="{{ $i }}" {{ $hasFile ? 'checked disabled' : '' }}>
                            <label for="tahapan{{ $i }}-{{ $tugas->id }}">Selesai</label>
                        </div>
                    </div>
                    <div class="tahapan-details" style="{{ $hasFile ? 'display: block;' : '' }}">
                        @if(isset($data['is_final']) && $data['is_final'])
                            <p>Upload file <strong style="color: red;">FINAL</strong></p>
                        @endif
                        <p><strong>Catatan:</strong> Upload dengan penamaan yang benar</p>
                        <div class="file-upload-container">
                            <input type="file" id="file-tahapan{{ $i }}-{{ $tugas->id }}" class="file-input" data-tahapan="{{ $i }}" data-tugas="{{ $tugas->id }}" {{ $hasFile ? 'disabled' : '' }}>
                            <label for="file-tahapan{{ $i }}-{{ $tugas->id }}" class="file-label" {{ $hasFile ? 'style="pointer-events: none; opacity: 0.6;"' : '' }}>
                                <i class="fas fa-upload"></i> Pilih File
                            </label>
                            <span class="file-name" id="file-name-tahapan{{ $i }}-{{ $tugas->id }}">
                                {{ $hasFile ? $file->filename : 'Belum ada file' }}
                            </span>
                            <button class="upload-btn" id="upload-btn-tahapan{{ $i }}-{{ $tugas->id }}" data-tahapan="{{ $i }}" data-tugas="{{ $tugas->id }}" {{ $hasFile ? 'disabled' : '' }}>
                                {{ $hasFile ? 'File Terupload' : 'Upload' }}
                            </button>
                        </div>
                    </div>
                </div>
            @endfor
            
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
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.tugas-row').forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const tahapanRow = document.getElementById(`tahapan-${id}`);
            
            // Toggle visibility
            if (tahapanRow.style.display === 'none' || tahapanRow.style.display === '') {
                // Close all other dropdowns first
                document.querySelectorAll('.tahapan-row').forEach(row => {
                    row.style.display = 'none';
                });
                
                tahapanRow.style.display = 'table-row';
                
                // Initialize event listeners for this row
                initializeEventListeners(id);
            } else {
                tahapanRow.style.display = 'none';
            }
        });
    });
});

// Set active class for current tahapan
document.addEventListener('DOMContentLoaded', function() {
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
                        checkbox.disabled = true; // Make checkbox read-only
                    }
                    
                    // Disable file input and upload button if file exists
                    const fileInput = item.querySelector('.file-input');
                    const uploadBtn = item.querySelector('.upload-btn');
                    if (fileInput && uploadBtn) {
                        fileInput.disabled = true;
                        uploadBtn.disabled = true;
                        uploadBtn.textContent = 'File Terupload';
                    }
                }
            });
        }
    });
});

// Function to initialize event listeners for a specific row
function initializeEventListeners(tugasId) {
    // Initialize tahapan header click to toggle details
    document.querySelectorAll(`#tahapan-${tugasId} .tahapan-header`).forEach(header => {
        header.addEventListener('click', function(e) {
            e.stopPropagation();
            const tahapanItem = this.closest('.tahapan-item');
            const details = tahapanItem.querySelector('.tahapan-details');
            
            // Toggle visibility of details
            if (details.style.display === 'block') {
                details.style.display = 'none';
            } else {
                details.style.display = 'block';
            }
        });
    });
    
    // Initialize file input change listeners
    document.querySelectorAll(`#tahapan-${tugasId} .file-input`).forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Belum ada file';
            const fileNameSpan = document.getElementById(`file-name-${this.id.replace('file-', '')}`);
            if (fileNameSpan) {
                fileNameSpan.textContent = fileName;
            }
        });
    });
    
    // Initialize upload button click listeners
    document.querySelectorAll(`#tahapan-${tugasId} .upload-btn`).forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const tugasId = this.getAttribute('data-tugas');
            const tahapanId = this.getAttribute('data-tahapan');
            const fileInput = document.getElementById(`file-tahapan${tahapanId}-${tugasId}`);
            const checkbox = document.getElementById(`tahapan${tahapanId}-${tugasId}`);
            const tahapanItem = this.closest('.tahapan-item');
            const currentTahapanSpan = document.getElementById(`current-tahapan-${tugasId}`);
            
            if (!fileInput || fileInput.files.length === 0) {
                showError('Pilih file terlebih dahulu!');
                return;
            }
            
            const formData = new FormData();
            formData.append('file', fileInput.files[0]);
            formData.append('tugas_id', tugasId);
            formData.append('tahapan_id', tahapanId);
            
            // Show loading indicator
            const originalText = this.textContent;
            this.textContent = 'Mengupload...';
            this.disabled = true;
            
            // Send file to server
            fetch(`/admin/tugas-harian/upload-file/${tugasId}/${tahapanId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                // Reset button
                this.textContent = originalText;
                this.disabled = false;
                
                if (data.success) {
                    // Check the checkbox
                    if (checkbox) {
                        checkbox.checked = true;
                        checkbox.disabled = true; // Make checkbox read-only
                    }
                    
                    // Update current tahapan
                    if (currentTahapanSpan && tahapanItem) {
                        currentTahapanSpan.textContent = tahapanItem.getAttribute('data-value');
                        
                        // Remove active class from all items
                        document.querySelectorAll(`#tahapan-${tugasId} .tahapan-item`).forEach(item => {
                            item.classList.remove('active');
                        });
                        
                        // Add active class to selected item
                        tahapanItem.classList.add('active');
                    }
                    
                    // Disable file input and upload button
                    fileInput.disabled = true;
                    this.disabled = true;
                    this.textContent = 'File Terupload';
                    
                    showSuccess('File berhasil diupload!');
                } else {
                    showError(data.message || 'Gagal mengupload file!');
                }
            })
            .catch(err => {
                // Reset button
                this.textContent = originalText;
                this.disabled = false;
                
                console.error(err);
                showError('Terjadi kesalahan saat mengupload file!');
            });
        });
    });
    
    // Initialize checkbox change listeners
    document.querySelectorAll(`#tahapan-${tugasId} .tahapan-checkbox`).forEach(checkbox => {
        checkbox.addEventListener('change', function(e) {
            e.stopPropagation();
            
            const tahapanItem = this.closest('.tahapan-item');
            const currentTahapanSpan = document.getElementById(`current-tahapan-${tugasId}`);
            
            // Update current tahapan based on checked item
            if (this.checked && currentTahapanSpan && tahapanItem) {
                currentTahapanSpan.textContent = tahapanItem.getAttribute('data-value');
                
                // Remove active class from all items
                document.querySelectorAll(`#tahapan-${tugasId} .tahapan-item`).forEach(item => {
                    item.classList.remove('active');
                });
                
                // Add active class to selected item
                tahapanItem.classList.add('active');
            }
        });
    });
}

// Event listener untuk tombol simpan
document.addEventListener('DOMContentLoaded', function() {
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
                showSuccess('Progress berhasil disimpan!');
            })
            .catch(err => {
                console.error(err);
                showError('Gagal menyimpan progress!');
            });
        });
    });
});

// Set active class for current tahapan
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.tahapan-row').forEach(row => {
        const id = row.id.replace('tahapan-', '');
        const currentTahapanSpan = document.getElementById(`current-tahapan-${id}`);
        
        if (currentTahapanSpan) {
            const currentTahapan = currentTahapanSpan.textContent;
            
            if (currentTahapan !== 'Belum ditentukan') {
                document.querySelectorAll(`#tahapan-${id} .tahapan-item`).forEach(item => {
                    if (item.getAttribute('data-value') === currentTahapan) {
                        item.classList.add('active');
                        // Check the corresponding checkbox
                        const checkbox = item.querySelector('.tahapan-checkbox');
                        if (checkbox) {
                            checkbox.checked = true;
                            checkbox.disabled = true; // Make checkbox read-only
                        }
                        
                        // Disable file input and upload button if file exists
                        const fileInput = item.querySelector('.file-input');
                        const uploadBtn = item.querySelector('.upload-btn');
                        if (fileInput && uploadBtn) {
                            fileInput.disabled = true;
                            uploadBtn.disabled = true;
                            uploadBtn.textContent = 'File Terupload';
                        }
                    }
                });
            }
        }
    });
});

// Helper functions for notifications
function showSuccess(message) {
    const successMsg = document.createElement('div');
    successMsg.className = 'alert alert-success';
    successMsg.textContent = message;
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
}

function showError(message) {
    const errorMsg = document.createElement('div');
    errorMsg.className = 'alert alert-error';
    errorMsg.textContent = message;
    errorMsg.style.position = 'fixed';
    errorMsg.style.top = '20px';
    errorMsg.style.right = '20px';
    errorMsg.style.padding = '10px 20px';
    errorMsg.style.backgroundColor = '#dc3545';
    errorMsg.style.color = 'white';
    errorMsg.style.borderRadius = '5px';
    errorMsg.style.zIndex = '9999';
    
    document.body.appendChild(errorMsg);
    
    setTimeout(() => {
        errorMsg.remove();
    }, 3000);
}
</script>

<style>
.tahapan-details {
    padding: 15px;
    display: none;
    background-color: #fff;
}

.tahapan-item.active .tahapan-details,
.tahapan-details.show {
    display: block;
}
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

.file-upload-container {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.file-input {
    display: none;
}

.file-label {
    display: inline-block;
    padding: 6px 12px;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.file-label:hover {
    background-color: #e9ecef;
}

.file-name {
    flex-grow: 1;
    font-size: 14px;
    color: #666;
}

.upload-btn {
    padding: 6px 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.upload-btn:hover:not(:disabled) {
    background-color: #0069d9;
}

.upload-btn:disabled {
    background-color: #6c757d;
    cursor: not-allowed;
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