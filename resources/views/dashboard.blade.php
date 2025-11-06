@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
<style>
    .main-content {
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .content {
        width: 100%;
        max-width: 1100px;         
    }

    .dashboard-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .dashboard-card {
        flex: 1 1 calc(50% - 20px);
        box-sizing: border-box;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .dashboard-card h3 {
        margin-top: 0;
        margin-bottom: 10px;
        color: #007bff;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dashboard-card p {
        margin: 0;
        color: #555;
    }

    @media (max-width: 768px) {
        .dashboard-card {
            flex: 1 1 100%;
        }
    }
</style>

<div class="main-content" id="main-content">
    <main class="content">
        <h1>Selamat Datang!</h1>
        <p>Ini adalah area konten utama Anda. Silakan kembangkan sesuai kebutuhan.</p>

        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h3><i class="fas fa-users"></i> Surat Tugas</h3>
                <p>Jumlah user terdaftar: 120</p>
            </div>
            <div class="dashboard-card">
                <h3><i class="fas fa-chart-line"></i> Tugas Harian</h3>
                <p>Kunjungan bulan ini: 3.500</p>
            </div>
            <div class="dashboard-card">
                <h3><i class="fas fa-wallet"></i> Proposal</h3>
                <p>Pendapatan bulan ini: Rp 75.000.000</p>
            </div>
            <div class="dashboard-card">
                <h3><i class="fas fa-tasks"></i> Adendum</h3>
                <p>Proyek aktif: 8</p>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        }
    });
</script>
@endsection
