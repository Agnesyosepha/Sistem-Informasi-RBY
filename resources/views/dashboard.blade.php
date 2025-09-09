@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });

            // Tambahan untuk placeholder "Telusuri"
            const searchInput = document.querySelector('.search-bar input');
            const placeholderText = searchInput.placeholder;

            searchInput.addEventListener('focus', function() {
                this.placeholder = '';
            });

            searchInput.addEventListener('blur', function() {
                if (this.value === '') {
                    this.placeholder = placeholderText;
                }
            });
        });
    </script>

</body>
</html>