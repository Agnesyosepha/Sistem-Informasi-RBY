@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Reset dan base styles */
    * {
        box-sizing: border-box;
    }
    
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        color: #333;
        margin: 0;
        padding: 0;
    }
    
    /* Main content area */
    .content-wrapper {
        padding: 20px 5px 3px; /* Mengurangi padding atas dan bawah */
        min-height: auto; /* Mengubah dari 100vh ke auto */
    }
    
    .dashboard-content {
        max-width: 1400px;
        margin: 0 auto;
    }

    .layout-two-col {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 35px;
        margin-bottom: 30px; /* Mengurangi margin bawah dari 50px ke 30px */
    }

    @media(max-width: 900px) {
        .layout-two-col {
            grid-template-columns: 1fr;
        }
        
        .content-wrapper {
            padding: 70px 15px 15px; /* Mengurangi padding untuk mobile */
        }
    }

    .left-box, .right-box {
        background: #ffffff;
        padding: 30px; /* Mengurangi padding dari 35px ke 30px */
        border-radius: 18px;
        border: 2px solid #D4AF37;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        position: relative;
        overflow: hidden;
    }

    .left-box::before {
        content:"";
        position:absolute;
        top:0; left:0;
        width:100%; height:100%;
        background:url('{{ asset('images/home.jpg') }}');
        background-size:cover;
        background-position:center;
        opacity:0.07;
        border-radius:16px;
    }

    .left-content {
        position: relative;
        z-index: 2;
    }

    .section-divider {
        margin: 20px 0; /* Mengurangi margin dari 25px ke 20px */
        border: none;
        height: 2px;
        background: linear-gradient(to right, #cbd5e1, #D4AF37, #cbd5e1);
        border-radius: 5px;
    }

    .title-accent {
        width: 55px;
        height: 5px;
        background: #D4AF37;
        border-radius: 5px;
        margin-bottom: 12px;
    }

    .tugas-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px; /* Mengurangi padding sedikit */
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(6px);
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        text-decoration: none;
        color: #111;
        transition: .25s ease;
        position: relative;
        overflow: hidden;
    }

    .tugas-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        background: rgba(255,255,255,0.95);
    }

    .tugas-card-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        transition: .25s ease;
    }

    .tugas-card:hover .tugas-card-icon {
        background: #D4AF37;
        color: white;
    }

    .tugas-card-title {
        font-weight: 700;
        font-size: 16px;
    }

    .chart-container {
        margin-top: 15px; /* Mengurangi margin dari 20px ke 15px */
        padding: 20px; /* Mengurangi padding dari 25px ke 20px */
        background-color: #fff;
        border-radius: 18px;
        border: 2px solid #D4AF37;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }

    .chart-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #0278AE;
        padding-bottom: 10px;
        border-bottom: 2px solid #D4AF37;
        width: fit-content;
    }

    /* Footer styles */
    .footer-wrapper {
        background:#f8f9fa;
        padding:30px 10px; /* Mengurangi padding dari 40px ke 30px */
        margin-top:20px; /* Mengurangi margin dari 40px ke 20px */
        border-top:1px solid #e5e5e5;
    }
</style>

<div class="content-wrapper">
    <div class="dashboard-content">
        <div class="layout-two-col">

            <!-- LEFT CONTENT -->
            <div class="left-box">
                <div class="left-content">

                    <div class="title-accent"></div>
                    <h2 style="font-weight:800; margin-bottom:8px; color: #0278AE;">
                        WELCOME TO
                    </h2>
                    <h3 style="font-size:28px; font-weight:700; margin-bottom:18px; font-family: 'Playfair Display', serif; color: #0278AE;">
                        KJPP RUDDY BARUS YENNY DAN REKAN
                    </h3>

                    <div class="info-list" style="margin-bottom:20px; font-family: 'Source Code Pro', monospace;">
                        <p>📌 NIKJPP : 2.17.0144</p>
                        <p>📌 No. KMK : 728/KM.1/2022</p>
                        <p>📌 STTD OJK : STTD-PP-212/PM.223/2022</p>
                        <p>📌 ATR BPN : 1166/SK-PT.01.01/VIII/2022</p>
                    </div>

                    <hr class="section-divider">

                    <h3 style="font-size:22px; font-weight:700; margin-bottom:12px; color: #0278AE;">
                        Informasi Umum
                    </h3>
                    <p style="line-height:1.75; color:#4b5563; font-size:15px; font-family: 'Great Vibes', cursive;">
                        Sistem ini dirancang untuk mendukung proses kerja tim KJPP RBY dalam pengelolaan data, 
                        dokumen, dan pelaporan secara lebih efisien. Gunakan menu yang tersedia untuk menjalankan 
                        tugas administrasi dan operasional harian.
                    </p>

                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="right-box">
                <h3 style="font-weight:700; font-size:22px; margin-bottom:18px; font-family: 'Pacifico', cursive; color: #0278AE;">Tugas Harian</h3>

                <div style="display:flex; flex-direction:column; gap:14px; font-family: 'Dancing Script', cursive; font-size:26px; font-weight:600;">
                    <a href="{{ route('admin') }}" class="tugas-card">
                        <div class="tugas-card-icon">👨‍💼</div>
                        <div class="tugas-card-title">Admin</div>
                    </a>

                    <a href="{{ route('surveyor') }}" class="tugas-card">
                        <div class="tugas-card-icon">🗺️</div>
                        <div class="tugas-card-title">Surveyor</div>
                    </a>

                    <a href="{{ route('edp') }}" class="tugas-card">
                        <div class="tugas-card-icon">📊</div>
                        <div class="tugas-card-title">EDP</div>
                    </a>

                    <a href="{{ route('reviewer') }}" class="tugas-card">
                        <div class="tugas-card-icon">🔍</div>
                        <div class="tugas-card-title">Reviewer</div>
                    </a>

                    <a href="{{ route('it') }}" class="tugas-card">
                        <div class="tugas-card-icon">🖥️</div>
                        <div class="tugas-card-title">IT Dept.</div>
                    </a>

                </div>
            </div>
        </div>

        <!-- Grafik Tugas Harian -->
        <div class="chart-container">
            <div class="chart-title">Grafik Tugas Harian ({{ date('Y') }})</div>
            <div style="height: 300px; position: relative;">
                <canvas id="tugasHarianChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- FOOTER --}}
<div class="footer-wrapper">
    <div class="container">

        <h2 style="
            text-align:center;
            font-size:26px;
            font-weight:700;
            margin-bottom:25px; /* Mengurangi margin dari 30px ke 25px */
            color: #0278AE;
        ">
            Our Office
        </h2>

        <div class="footer-grid" style="
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap:20px;
            margin-bottom:25px; /* Mengurangi margin dari 30px ke 25px */
        ">
            @php
                $offices = [
                    ['name' => 'Head Office', 'loc' => 'Jl. DI. Panjaitan No. 39, Surakarta', 'tel' => '0271-2921061', 'hp' => '085694160999', 'email' => 'adminpusat@kjpprby.com'],
                    ['name' => 'Bekasi Branch', 'loc' => 'Grand Galaxy City, Bekasi', 'tel' => '021-38711327', 'hp' => '08128582445', 'email' => 'adminbekasi@kjpprby.com'],
                    ['name' => 'Jakarta Branch', 'loc' => 'Ciplaz Klender, Jakarta Timur', 'tel' => '021-48672642', 'hp' => '081385466610', 'email' => 'adminjakarta@kjpprby.com'],
                    ['name' => 'Semarang Branch', 'loc' => 'Puri Anjasmoro, Semarang Barat', 'tel' => '024-76434980', 'hp' => '08156705690', 'email' => 'adminsemarang@kjpprby.com']
                ];
            @endphp

            @foreach($offices as $o)
            <div style="
                background:#ffffff;
                padding:15px; /* Mengurangi padding dari 18px ke 15px */
                border-radius:12px;
                border:1px solid #D4AF37;
                box-shadow:0 3px 10px rgba(0,0,0,0.05);
            ">
                <h3 style="font-size:18px; font-weight:700; margin-bottom:8px; color: #0278AE;">
                    {{ $o['name'] }}
                </h3>
                <p>📍 {{ $o['loc'] }}</p>
                <p>☎ {{ $o['tel'] }}</p>
                <p>📱 {{ $o['hp'] }}</p>
                <p>✉ {{ $o['email'] }}</p>
            </div>
            @endforeach
        </div>

        <p style="text-align:center; font-size:14px; color:#666;">
            © {{ date('Y') }} KJPP RBY – All Rights Reserved
        </p>
    </div>
</div>

@endsection

@section('scripts')
<!-- Tambahkan library Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize chart
    initializeChart();
});

// Function to initialize chart
function initializeChart() {
    const ctx = document.getElementById('tugasHarianChart').getContext('2d');
    
    // Ambil data dari server
    fetch('/api/tugas-harian-per-bulan')
        .then(response => response.json())
        .then(data => {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Jumlah Tugas Harian',
                        data: data.data,
                        backgroundColor: 'rgba(2, 120, 174, 0.5)',
                        borderColor: 'rgba(2, 120, 174, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Jumlah: ${context.raw} tugas`;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching chart data:', error);
        });
}
</script>
@endsection