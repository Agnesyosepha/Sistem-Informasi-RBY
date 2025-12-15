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
            <p><strong>Daftar Adendum yang Diajukan</strong></p>
        </div>
    </a>
    <a href="{{ route('admin.suratTugas') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-file-signature"></i> Surat Tugas</h3>
            <p><strong>Surat Tugas yang Diterbitkan</strong></p>
        </div>
    </a>
    
    <a href="{{ route('admin.laporanTugasHarian') }}" style="text-decoration:none; color:inherit;">
        <div class="dashboard-card">
            <h3><i class="fas fa-book"></i> Laporan Tugas Harian</h3>
            <p><strong>{{ $laporanFinal->count() }} Laporan Selesai</strong></p>
       </div> 
    </a>
    <a href="{{ route('admin.tim') }}" class="dashboard-card" style="display:block; color:inherit; text-decoration:none;">
        <h3><i class="fas fa-user"></i> Admin</h3>
        <p><strong>2 Staff</strong></p>
    </a>
</div>

<!-- Di bawah dashboard-cards -->
@if(auth()->user()->unreadNotifications()->count() > 0)
<div class="card mb-4 border-left-warning">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
        </div>
    </div>
</div>
@endif

<!-- Tabel Aktivitas -->
<div class="dashboard-card" style="margin-top:30px;">
    <h3><i class="fas fa-clipboard-list"></i> Tugas Harian</h3>

    <form method="GET" action="{{ route('admin') }}" style="margin-bottom:20px;">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Cari..." 
               style="padding:8px; width:250px; border:1px solid #ccc; border-radius:5px;">

        <select name="bulan" style="padding:8px; border:1px solid #ccc; border-radius:5px;">
            <option value="">-- Bulan Survei --</option>
            @for($i=1; $i<=12; $i++)
                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                </option>
            @endfor
        </select>

        <button type="submit" 
                style="padding:8px 15px; background:#007BFF; color:white; border:none; border-radius:5px; cursor:pointer;">
            Filter
        </button>

        @if(request('search') || request('bulan'))
        <a href="{{ route('admin') }}" 
           style="padding:8px 15px; background:#777; color:white; border-radius:5px; margin-left:5px; text-decoration:none; display:inline-block;">
           Reset
        </a>
        @endif
    </form>

    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left; width:40px;">No</th>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Debitur</th>
                <th style="padding:10px; text-align:left;">No.PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Survei</th>
                <th style="padding:10px; text-align:left;">Tim Lapangan</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        @foreach($tugasHarian as $index => $tugas)
            <tr class="tugas-row" style="border-bottom:1px solid #ddd; cursor: pointer;" data-id="{{ $tugas->id }}">
                <!-- NO -->
                <td style="padding:10px; text-align:left; width:40px;">
                    {{ $index + 1 }}
                </td>

                <!-- Pemberi Tugas -->
                <td style="padding:10px; text-align:left;">
                    {{ $tugas->pemberi_tugas }}
                </td>

                <td style="padding:10px; text-align:left;">
                    {{ $tugas->debitur }}
                </td>

                <td style="padding:10px; text-align:left;">
                    {{ $tugas->no_ppjp }}
                </td>

                <td style="padding:10px; text-align:left;">
                    {{ $tugas->tanggal_survei }}
                </td>

                <td style="padding:10px; text-align:left;">
                    {{ $tugas->tim_lapangan }}
                </td>

                <td style="padding:10px; text-align:left; font-weight:600;">
                    <span class="status-label" data-status="{{ $tugas->status }}">
                        {{ $tugas->status }}
                    </span>
                </td>
            </tr>
                
            <!-- Baris dropdown untuk tahapan (awalnya disembunyikan) -->
            <tr class="tahapan-row" id="tahapan-{{ $tugas->id }}" style="display: none; background-color: #f8f9fa;">
                <td colspan="7" style="padding: 15px;">
                    <div class="tahapan-container">
                        <h4 style="margin-top: 0; margin-bottom: 15px; text-align: center;">Tahapan Pekerjaan</h4>
                        
                        @php
                            // Buat array asosiatif untuk mempermudah pencarian file berdasarkan tahapan_id
                            $filesByTahapan = $tugas->files->keyBy(function($file) {
                                return $file->tahapan_id . '_' . ($file->is_revision ? 'revision' : 'original');
                            });

                            // Data untuk setiap tahapan (diperbarui menjadi 15 tahapan)
                            $tahapanData = [
                                1 => ['value' => 'Pengumpulan Data', 'title' => 'Pengumpulan Data (Admin)'],
                                2 => ['value' => 'Pembuatan Invoice DP', 'title' => 'Pembuatan Invoice DP (Finance)'],
                                3 => ['value' => 'Penjadwalan Inspeksi', 'title' => 'Penjadwalan Inspeksi (Admin)'],
                                4 => ['value' => 'Inspeksi', 'title' => 'Inspeksi (Surveyor)'],
                                5 => ['value' => 'Proses Analisa', 'title' => 'Proses Analisa (Surveyor)'],
                                6 => ['value' => 'Review Nilai', 'title' => 'Review Nilai (Surveyor)'],
                                7 => ['value' => 'Kirim Draft Resume', 'title' => 'Kirim Draft Resume (Surveyor)'],
                                8 => ['value' => 'Draft Laporan', 'title' => 'Draft Laporan (EDP)'],
                                9 => ['value' => 'Final', 'title' => 'Final (Admin)'],
                                10 => ['value' => 'Review', 'title' => 'Review (Reviewer)'],
                                11 => ['value' => 'Review Approval', 'title' => 'Review Approval (Reviewer)'],
                                12 => ['value' => 'Invoice Pelunasan', 'title' => 'Invoice Pelunasan (Finance)'],
                                13 => ['value' => 'Nomor Laporan', 'title' => 'Nomor Laporan (EDP)'],
                                14 => ['value' => 'Laporan Lengkap', 'title' => 'Laporan Lengkap (EDP)'],
                                15 => ['value' => 'Rangkap 3 LPA dan Pengiriman Dokumen', 'title' => 'Rangkap 3 LPA dan Pengiriman Dokumen (EDP dan Admin)'],
                            ];
                        @endphp

                        @for ($i = 1; $i <= 15; $i++)
                            @php
                                $data = $tahapanData[$i];
                                $hasFile = $filesByTahapan->has($i . '_original');
                                $hasRevisionFile = $filesByTahapan->has($i . '_revision');
                                $file = $hasFile ? $filesByTahapan->get($i . '_original') : null;
                                $revisionFile = $hasRevisionFile ? $filesByTahapan->get($i . '_revision') : null;
                                
                                // Check if previous stage is completed
                                $previousStageCompleted = ($i == 1) ? true : $filesByTahapan->has(($i - 1) . '_original');
                                // Check if this stage is locked (not completed and previous stage not completed)
                                $isLocked = !$hasFile && !$previousStageCompleted;
                            @endphp

                            <div class="tahapan-item {{ $hasFile ? 'active' : '' }} {{ $isLocked ? 'locked' : '' }}" data-value="{{ $data['value'] }}" data-tahapan-id="{{ $i }}">
                                <div class="tahapan-header">
                                    <span class="tahapan-number">{{ $i }}.</span>
                                    <span class="tahapan-title">{{ $data['title'] }}</span>
                                    <div class="tahapan-status">
                                        <input type="checkbox" class="tahapan-checkbox" id="tahapan{{ $i }}-{{ $tugas->id }}" data-tahapan="{{ $i }}" {{ $hasFile ? 'checked disabled' : '' }}>
                                            <label for="tahapan{{ $i }}-{{ $tugas->id }}">Selesai</label>
                                        </div>
                                </div>
                                <div class="tahapan-details" style="{{ $hasFile ? 'display: block;' : '' }}">
                                    @if($i == 1)
                                        <p><strong>Catatan:</strong> Upload dengan penamaan yang benar</p>
                                    @elseif($i == 2)
                                        <p><strong>Catatan:</strong> Upload bukti DP Invoice</p>
                                    @elseif($i == 3)
                                        <p><strong>Catatan:</strong> Upload Surat Tugas</p>
                                    @elseif($i == 4)
                                        <p><strong>Catatan:</strong> Upload dalam ZIP berisi ttd surat tugas setelah survey, ttd berita acara inspeksi, dan foto dengan pendamping</p>
                                    @elseif($i == 5)
                                        <p><strong>Catatan:</strong> Upload working paper dalam Excel</p>
                                    @elseif($i == 6)
                                        <p><strong>Catatan:</strong> Upload dengan penamaan yang benar</p>
                                    @elseif($i == 7)
                                        <p><strong>Catatan:</strong> Upload dengan penamaan yang benar</p>
                                    @elseif($i == 8)
                                        <p><strong>Catatan:</strong> Upload cover laporan</p>
                                    @elseif($i == 9)
                                        <p><strong>Catatan:</strong> Upload bukti screenshoot final dari debitur (chat/email)</p>
                                    @elseif($i == 10)
                                        <p><strong>Catatan:</strong> Upload dengan penamaan yang benar</p>
                                    @elseif($i == 11)
                                        <p><strong>Catatan:</strong> Upload dokumen review approval dari review nilai</p>
                                    @elseif($i == 12)
                                        <p><strong>Catatan:</strong> Upload bukti pelunasan invoice</p>
                                    @elseif($i == 13)
                                        <p><strong>Catatan:</strong> Upload nomor laporan penilaian</p>
                                    @elseif($i == 14)
                                        <p><strong>Catatan:</strong> Upload softcopy LPA</p>
                                    @elseif($i == 15)
                                        <p><strong>Catatan:</strong> Upload dalam ZIP keseluruhan dokumen dan bukti dokumen sudah dikirim</p>
                                    @endif
                                    
                                    @if($isLocked)
                                        <div class="locked-notice">
                                            <i class="fas fa-lock"></i> Tahapan ini akan terbuka setelah tahapan {{ $i - 1 }} selesai
                                            </div>
                                    @endif
                                    
                                    <!-- File Utama -->
                                    <div class="file-section">
                                        <h5>File Utama:</h5>
                                        <div class="file-upload-container">
                                            <input type="file" id="file-tahapan{{ $i }}-{{ $tugas->id }}" class="file-input" data-tahapan="{{ $i }}" data-tugas="{{ $tugas->id }}" {{ $hasFile || $isLocked ? 'disabled' : '' }}>
                                                <label for="file-tahapan{{ $i }}-{{ $tugas->id }}" class="file-label {{ $isLocked ? 'disabled' : '' }}" {{ $hasFile || $isLocked ? 'style="pointer-events: none; opacity: 0.6;"' : '' }}>
                                                    <i class="fas fa-upload"></i> Pilih File
                                                </label>
                                                <span class="file-name" id="file-name-tahapan{{ $i }}-{{ $tugas->id }}">
                                                    {{ $hasFile ? $file->filename : ($isLocked ? 'Tahapan Terkunci' : 'Belum ada file') }}
                                                </span>
                                                <button class="upload-btn" id="upload-btn-tahapan{{ $i }}-{{ $tugas->id }}" data-tahapan="{{ $i }}" data-tugas="{{ $tugas->id }}" {{ $hasFile || $isLocked ? 'disabled' : '' }}>
                                                    {{ $hasFile ? 'File Terupload' : ($isLocked ? 'Tahapan Terkunci' : 'Upload') }}
                                                </button>
                                                
                                                <!-- Tambahkan tombol download untuk tahapan 3 -->
                                                @if($i == 3 && $hasFile)
                                                <a href="{{ route('admin.tugas-harian.downloadFile', $file->id) }}" class="download-btn" target="_blank">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    
                                    <!-- File Revisi -->
                                    <div class="file-section" style="margin-top: 15px;">
                                        <h5>File Revisi:</h5>
                                        <div class="file-upload-container">
                                            <input type="file" id="file-revisi-tahapan{{ $i }}-{{ $tugas->id }}" class="file-input" data-tahapan="{{ $i }}" data-tugas="{{ $tugas->id }}" data-revision="true" {{ $hasRevisionFile ? 'disabled' : '' }}>
                                                <label for="file-revisi-tahapan{{ $i }}-{{ $tugas->id }}" class="file-label" {{ $hasRevisionFile ? 'style="pointer-events: none; opacity: 0.6;"' : '' }}>
                                                    <i class="fas fa-upload"></i> Pilih File Revisi
                                                </label>
                                                <span class="file-name" id="file-name-revisi-tahapan{{ $i }}-{{ $tugas->id }}">
                                                    {{ $hasRevisionFile ? $revisionFile->filename : 'Belum ada file revisi' }}
                                                </span>
                                                <button class="upload-btn" id="upload-btn-revisi-tahapan{{ $i }}-{{ $tugas->id }}" data-tahapan="{{ $i }}" data-tugas="{{ $tugas->id }}" data-revision="true" {{ $hasRevisionFile ? 'disabled' : '' }}>
                                                    {{ $hasRevisionFile ? 'File Revisi Terupload' : 'Upload Revisi' }}
                                                </button>
                                                
                                                <!-- Tambahkan tombol download untuk revisi tahapan 3 -->
                                                @if($i == 3 && $hasRevisionFile)
                                                <a href="{{ route('admin.tugas-harian.downloadFile', $revisionFile->id) }}" class="download-btn" target="_blank">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
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
// Define tahapan data in JavaScript to access it on client side
const tahapanData = {
    1: 'Pengumpulan Data',
    2: 'Pembuatan Invoice DP',
    3: 'Penjadwalan Inspeksi',
    4: 'Inspeksi',
    5: 'Proses Analisa',
    6: 'Review Nilai',
    7: 'Kirim Draft Resume',
    8: 'Draft Laporan',
    9: 'Final',
    10: 'Review',
    11: 'Review Approval',
    12: 'Invoice Pelunasan',
    13: 'Nomor Laporan',
    14: 'Laporan Lengkap',
    15: 'Rangkap 3 LPA dan Pengiriman Dokumen'
};

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initializeSidebarToggle();
    initializeStatusLabels();
    initializeTaskRows();
    initializeSaveButtons();
    
    // Initialize all tahapan items for all tasks
    document.querySelectorAll('.tugas-row').forEach(row => {
        const tugasId = row.getAttribute('data-id');
        setActiveTahapan(tugasId);
    });
    
    // Check for URL parameters to open specific task
    checkUrlParameters();
});

// Function to initialize sidebar toggle
function initializeSidebarToggle() {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            const mainContent = document.querySelector('.main-content') || document.querySelector('.content-area');
            if (mainContent) {
                mainContent.classList.toggle('collapsed');
            }
        });
    }
}

// Function to initialize status labels
function initializeStatusLabels() {
    document.querySelectorAll(".status-label").forEach(function(label) {
        const value = label.getAttribute("data-status");
        if (value === "Urgent") {
            label.style.color = "orange";
        } else if (value === "Sangat Urgent") {
            label.style.color = "red";
        }
    });
}

// Function to initialize task rows
function initializeTaskRows() {
    document.querySelectorAll('.tugas-row').forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const tahapanRow = document.getElementById(`tahapan-${id}`);
            
            if (tahapanRow) {
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
            }
        });
    });
}

// Function to check URL parameters and open specific task
function checkUrlParameters() {
    console.log('Checking URL parameters...');
    
    const urlParams = new URLSearchParams(window.location.search);
    const openTaskId = urlParams.get('task_id');
    const shouldOpen = urlParams.get('open') === 'true';
    
    console.log('Open Task ID:', openTaskId);
    console.log('Should Open:', shouldOpen);
    
    if (openTaskId && shouldOpen) {
        // Wait a bit for DOM to be fully ready
        setTimeout(() => {
            // Find the task row
            const taskRow = document.querySelector(`.tugas-row[data-id="${openTaskId}"]`);
            
            console.log('Task Row Found:', taskRow);
            
            if (taskRow) {
                // Find the tahapan row
                const tahapanRow = document.getElementById(`tahapan-${openTaskId}`);
                
                console.log('Tahapan Row Found:', tahapanRow);
                
                if (tahapanRow) {
                    // Close all other dropdowns first
                    document.querySelectorAll('.tahapan-row').forEach(row => {
                        row.style.display = 'none';
                    });
                    
                    // Open this dropdown
                    tahapanRow.style.display = 'table-row';
                    
                    // Scroll to task
                    taskRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Highlight temporarily
                    taskRow.style.backgroundColor = '#fff3cd';
                    tahapanRow.style.backgroundColor = '#fff3cd';
                    
                    // Remove highlight after 3 seconds
                    setTimeout(() => {
                        taskRow.style.backgroundColor = '';
                        tahapanRow.style.backgroundColor = '';
                    }, 3000);
                    
                    // Initialize event listeners for this row
                    initializeEventListeners(openTaskId);
                    
                    // Get task notifications to highlight relevant stage
                    highlightRelevantStage(openTaskId);
                }
            } else {
                console.error('Task row not found for ID:', openTaskId);
            }
        }, 500);
    }
}

// Function to highlight relevant stage based on notifications
function highlightRelevantStage(taskId) {
    console.log('Highlighting relevant stage for task:', taskId);
    
    fetch(`/notifications/get-task-notifications/${taskId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Notifications data:', data);
            
            if (data.success && data.notifications.length > 0) {
                // Get the latest notification
                const latestNotification = data.notifications[0];
                
                console.log('Latest notification:', latestNotification);
                
                // Determine which stage to highlight based on notification type
                let stageToHighlight = null;
                
                if (latestNotification.title.includes('Pengumpulan Data')) {
                    stageToHighlight = 1;
                } else if (latestNotification.title.includes('Invoice')) {
                    stageToHighlight = 2;
                } else if (latestNotification.title.includes('Inspeksi')) {
                    stageToHighlight = 4;
                } else if (latestNotification.title.includes('Analisa')) {
                    stageToHighlight = 5;
                } else if (latestNotification.title.includes('Review')) {
                    stageToHighlight = 6;
                } else if (latestNotification.title.includes('Draft Resume')) {
                    stageToHighlight = 7;
                } else if (latestNotification.title.includes('Draft Laporan')) {
                    stageToHighlight = 8;
                }
                
                console.log('Stage to highlight:', stageToHighlight);
                
                if (stageToHighlight) {
                    // Wait a bit for the dropdown to be fully opened
                    setTimeout(() => {
                        // Find the tahapan item
                        const tahapanItem = document.querySelector(`#tahapan-${taskId} .tahapan-item[data-tahapan-id="${stageToHighlight}"]`);
                        
                        console.log('Tahapan item found:', tahapanItem);
                        
                        if (tahapanItem) {
                            // Find the tahapan details
                            const tahapanDetails = tahapanItem.querySelector('.tahapan-details');
                            
                            if (tahapanDetails) {
                                // Open the stage details
                                tahapanDetails.style.display = 'block';
                                
                                // Add special highlighting
                                tahapanItem.style.border = '2px solid #ffc107';
                                tahapanItem.style.boxShadow = '0 0 10px rgba(255, 193, 7, 0.5)';
                                
                                // Scroll to the stage
                                tahapanItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                
                                // Show special message
                                const specialMessage = document.createElement('div');
                                specialMessage.className = 'alert alert-warning';
                                specialMessage.innerHTML = `
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Perhatian!</strong> Tahapan ini memerlukan tindakan Anda berdasarkan notifikasi terbaru.
                                `;
                                specialMessage.style.cssText = `
                                    position: fixed;
                                    top: 80px;
                                    right: 20px;
                                    left: 20px;
                                    z-index: 9999;
                                    background: #856404;
                                    color: white;
                                    padding: 15px;
                                    border-radius: 8px;
                                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                                `;
                                
                                document.body.appendChild(specialMessage);
                                
                                // Remove message and highlighting after 5 seconds
                                setTimeout(() => {
                                    if (specialMessage.parentNode) {
                                        specialMessage.parentNode.removeChild(specialMessage);
                                    }
                                    tahapanItem.style.border = '';
                                    tahapanItem.style.boxShadow = '';
                                }, 5000);
                            }
                        } else {
                            console.error('Tahapan item not found for stage:', stageToHighlight);
                        }
                    }, 1000);
                }
            }
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
        });
}

// Function to initialize event listeners for a specific task
function initializeEventListeners(tugasId) {
    console.log('Initializing event listeners for task:', tugasId);
    
    // Initialize tahapan headers
    document.querySelectorAll(`#tahapan-${tugasId} .tahapan-header`).forEach(header => {
        header.addEventListener('click', function(e) {
            e.stopPropagation();
            const tahapanItem = this.closest('.tahapan-item');
            const details = tahapanItem.querySelector('.tahapan-details');
            
            if (details) {
                // Toggle visibility of details
                details.style.display = details.style.display === 'block' ? 'none' : 'block';
            }
        });
    });
    
    // Initialize file inputs for original files
    document.querySelectorAll(`#tahapan-${tugasId} .file-input:not([data-revision="true"])`).forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Belum ada file';
            const fileNameSpan = document.getElementById(`file-name-${this.id.replace('file-', '')}`);
            if (fileNameSpan) {
                fileNameSpan.textContent = fileName;
            }
        });
    });
    
    // Initialize file inputs for revision files
    document.querySelectorAll(`#tahapan-${tugasId} .file-input[data-revision="true"]`).forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Belum ada file revisi';
            const fileNameSpan = document.getElementById(`file-name-${this.id.replace('file-', '')}`);
            if (fileNameSpan) {
                fileNameSpan.textContent = fileName;
            }
        });
    });
    
    // Initialize upload buttons for original files
    initializeUploadButtons(tugasId, false);
    
    // Initialize upload buttons for revision files
    initializeUploadButtons(tugasId, true);
    
    // Initialize checkboxes
    initializeCheckboxes(tugasId);
    
    // Set active class for current tahapan
    setActiveTahapan(tugasId);
}

// Function to initialize upload buttons
function initializeUploadButtons(tugasId, isRevision) {
    const selector = isRevision 
        ? `#tahapan-${tugasId} .upload-btn[data-revision="true"]` 
        : `#tahapan-${tugasId} .upload-btn:not([data-revision="true"])`;
    
    document.querySelectorAll(selector).forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const tugasId = this.getAttribute('data-tugas');
            const tahapanId = parseInt(this.getAttribute('data-tahapan'));
            const fileInputSelector = isRevision 
                ? `file-revisi-tahapan${tahapanId}-${tugasId}` 
                : `file-tahapan${tahapanId}-${tugasId}`;
            const fileInput = document.getElementById(fileInputSelector);
            
            if (!fileInput || fileInput.files.length === 0) {
                showError(isRevision ? 'Pilih file revisi terlebih dahulu!' : 'Pilih file terlebih dahulu!');
                return;
            }
            
            // For original files, check if previous stage is completed
            if (!isRevision && tahapanId > 1) {
                const prevStageCheckbox = document.getElementById(`tahapan${tahapanId - 1}-${tugasId}`);
                if (!prevStageCheckbox || !prevStageCheckbox.checked) {
                    showError(`Harap selesaikan tahapan ${tahapanId - 1} terlebih dahulu!`);
                    return;
                }
            }
            
            // Prepare form data
            const formData = new FormData();
            formData.append('file', fileInput.files[0]);
            formData.append('tugas_id', tugasId);
            formData.append('tahapan_id', tahapanId);
            formData.append('is_revision', isRevision ? '1' : '0');
            
            // Show loading indicator
            const originalText = this.textContent;
            this.textContent = 'Mengupload...';
            this.disabled = true;
            
            // Send file to server
            fetch(`/admin/tugas-harian/upload-file/${tugasId}/${tahapanId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(res => {
                if (!res.ok) {
                    // If server returns error status, parse the error message
                    return res.json().then(data => {
                        throw new Error(data.message || 'Server response was not ok');
                    });
                }
                return res.json();
            })
            .then(data => {
                // Reset button
                this.textContent = originalText;
                this.disabled = false;
                
                if (data.success) {
                    // For original files, update checkbox and current tahapan
                    if (!isRevision) {
                        const checkbox = document.getElementById(`tahapan${tahapanId}-${tugasId}`);
                        const tahapanItem = this.closest('.tahapan-item');
                        const currentTahapanSpan = document.getElementById(`current-tahapan-${tugasId}`);
                        
                        // Check checkbox
                        if (checkbox) {
                            checkbox.checked = true;
                            checkbox.disabled = true;
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
                        
                        // Add download button for tahapan 3
                        if (tahapanId == 3) {
                            const downloadBtn = document.createElement('a');
                            downloadBtn.href = data.file_url;
                            downloadBtn.className = 'download-btn';
                            downloadBtn.target = '_blank';
                            downloadBtn.innerHTML = '<i class="fas fa-download"></i> Download';
                            
                            const container = this.parentElement;
                            container.appendChild(downloadBtn);
                        }
                        
                        // Unlock next stage if exists
                        unlockNextStage(tugasId, tahapanId);
                    } else {
                        // For revision files, just disable input and button
                        fileInput.disabled = true;
                        this.disabled = true;
                        this.textContent = 'File Revisi Terupload';
                        
                        // Add download button for revision tahapan 3
                        if (tahapanId == 3) {
                            const downloadBtn = document.createElement('a');
                            downloadBtn.href = data.file_url;
                            downloadBtn.className = 'download-btn';
                            downloadBtn.target = '_blank';
                            downloadBtn.innerHTML = '<i class="fas fa-download"></i> Download Revisi';
                            
                            const container = this.parentElement;
                            container.appendChild(downloadBtn);
                        }
                    }
                    
                    showSuccess(isRevision ? 'File revisi berhasil diupload!' : 'File berhasil diupload!');
                }
            })
            .catch(err => {
                // Reset button
                this.textContent = originalText;
                this.disabled = false;
                
                console.error(err);
                showError(err.message || 'Terjadi kesalahan saat mengupload file!');
            });
        });
    });
}

// Function to initialize checkboxes
function initializeCheckboxes(tugasId) {
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

// Function to set active tahapan
function setActiveTahapan(tugasId) {
    const currentTahapanSpan = document.getElementById(`current-tahapan-${tugasId}`);
    
    if (currentTahapanSpan) {
        const currentTahapan = currentTahapanSpan.textContent;
        
        if (currentTahapan !== 'Belum ditentukan') {
            document.querySelectorAll(`#tahapan-${tugasId} .tahapan-item`).forEach(item => {
                if (item.getAttribute('data-value') === currentTahapan) {
                    item.classList.add('active');
                    
                    // Check corresponding checkbox
                    const checkbox = item.querySelector('.tahapan-checkbox');
                    if (checkbox) {
                        checkbox.checked = true;
                        checkbox.disabled = true;
                    }
                    
                    // Disable file input and upload button if file exists
                    const fileInput = item.querySelector('.file-input:not([data-revision="true"])');
                    const uploadBtn = item.querySelector('.upload-btn:not([data-revision="true"])');
                    if (fileInput && uploadBtn) {
                        fileInput.disabled = true;
                        uploadBtn.disabled = true;
                        uploadBtn.textContent = 'File Terupload';
                    }
                }
            });
        }
    }
}

// Function to initialize save buttons
function initializeSaveButtons() {
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
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    tahapan: currentTahapan,
                    checked_stages: checkedStages
                })
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Server response was not ok');
                }
                return res.json();
            })
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
}

// Function to unlock next stage
function unlockNextStage(tugasId, currentTahapanId) {
    const nextStageId = currentTahapanId + 1;
    
    // Check if next stage exists (max is 15)
    if (nextStageId > 15) return;
    
    // Find next stage item by its tahapan-id attribute
    const nextStageItem = document.querySelector(`#tahapan-${tugasId} .tahapan-item[data-tahapan-id="${nextStageId}"]`);
    
    if (nextStageItem) {
        // Remove locked class
        nextStageItem.classList.remove('locked');
        
        // Get all elements for next stage
        const nextStageFileInput = document.getElementById(`file-tahapan${nextStageId}-${tugasId}`);
        const nextStageUploadBtn = document.getElementById(`upload-btn-tahapan${nextStageId}-${tugasId}`);
        const nextStageLabel = document.querySelector(`label[for="file-tahapan${nextStageId}-${tugasId}"]`);
        const nextStageFileName = document.getElementById(`file-name-tahapan${nextStageId}-${tugasId}`);
        
        // Enable file input
        if (nextStageFileInput) {
            nextStageFileInput.disabled = false;
        }
        
        // Enable and update upload button
        if (nextStageUploadBtn) {
            nextStageUploadBtn.disabled = false;
            nextStageUploadBtn.textContent = 'Upload';
        }
        
        // Enable file label
        if (nextStageLabel) {
            nextStageLabel.classList.remove('disabled');
            nextStageLabel.style.pointerEvents = 'auto';
            nextStageLabel.style.opacity = '1';
        }
        
        // Update file name display
        if (nextStageFileName) {
            nextStageFileName.textContent = 'Belum ada file';
        }
        
        // Remove locked notice if exists
        const lockedNotice = nextStageItem.querySelector('.locked-notice');
        if (lockedNotice) {
            lockedNotice.remove();
        }
    }
}

// Helper functions for notifications
function showSuccess(message) {
    showNotification(message, 'success');
}

function showError(message) {
    showNotification(message, 'error');
}

function showNotification(message, type) {
    // Remove any existing notifications first
    const existingNotifications = document.querySelectorAll('.alert');
    existingNotifications.forEach(notification => notification.remove());
    
    const notification = document.createElement('div');
    notification.className = `alert alert-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 10px 20px;
        border-radius: 5px;
        z-index: 9999;
        background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
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
    gap: 25px;
}

.tahapan-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 15px;
}

.tahapan-item:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.tahapan-item.active {
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
}

.tahapan-item.locked {
    opacity: 0.7;
    border-color: #ccc;
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
    appearance: none;
    -webkit-appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #ccc;
    border-radius: 4px;
    outline: none;
    transition: all 0.3s;
    margin-right: 5px;
    position: relative;
    cursor: pointer;
}

.tahapan-status input[type="checkbox"]:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.tahapan-status input[type="checkbox"]:checked::after {
    content: '✓';
    position: absolute;
    top: -2px;
    left: 3px;
    color: white;
    font-size: 14px;
    font-weight: bold;
}

.tahapan-status input[type="checkbox"]:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.tahapan-status input[type="checkbox"]:disabled:checked {
    background-color: #0056b3;
    border-color: #0056b3;
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

.locked-notice {
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    color: #856404;
    padding: 8px 12px;
    border-radius: 4px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.file-section {
    margin-bottom: 15px;
}

.file-section h5 {
    margin-bottom: 10px;
    color: #495057;
    font-size: 14px;
}

.file-upload-container {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
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

.file-label:hover:not(.disabled) {
    background-color: #e9ecef;
}

.file-label.disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.file-name {
    flex-grow: 1;
    font-size: 14px;
    color: #666;
    min-width: 150px;
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


.download-btn {
    padding: 6px 10px;
    background-color: #17a2b8; /* Warna biru muda untuk membedakan */
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.download-btn:hover {
    background-color: #138496;
}
</style>
@endsection