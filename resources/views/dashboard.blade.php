<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fc;
            height: 100%;
            color: #333;
        }

        .main-container {
            display: flex;
            height: 100vh;
        }

        /* --- Sidebar --- */
        .sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            width: 250px;
            height: calc(100% - 80px);
            background: linear-gradient(180deg, #111, #222);
            padding-top: 20px;
            transition: width 0.3s ease-in-out;
            z-index: 999;
            box-shadow: 2px 0 8px rgba(0,0,0,0.3);
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav ul li a {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            color: #f1f1f1;
            text-decoration: none;
            margin: 8px 10px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .sidebar nav ul li a:hover,
        .sidebar nav ul li a.active {
            background-color: #ffc107;
            color: #111;
        }

        .sidebar.collapsed nav ul li a:hover,
        .sidebar.collapsed nav ul li a.active {
            transform: scale(1.1);
        }

        .sidebar nav ul li a i {
            margin-right: 20px;
            font-size: 18px;
            min-width: 30px;
            text-align: center;
        }

        .sidebar.collapsed nav ul li a span {
            display: none;
        }
        .sidebar.collapsed nav ul li a i {
            margin-right: 0;
        }

        /* --- Header (PERUBAHAN CSS DI SINI) --- */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background-color: #000;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 3px solid #007BFF;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar */
        }

        /* Bagian Kiri: Menu dan Logo */
        .header-left {
            display: flex;
            align-items: center;
            flex-shrink: 0; /* Mencegah bagian ini menyusut */
        }

        /* Bagian Tengah: Search Bar */
        .header-center {
            flex-grow: 1; /* Mengambil ruang kosong di tengah */
            display: flex;
            justify-content: center; /* Pusatkan search bar di tengah */
            min-width: 150px; /* Lebar minimum agar tidak terlalu kecil */
        }
        
        /* Bagian Kanan: Ikon */
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        #menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            margin-right: 20px;
        }

        .logo-container {
            height: 55px;
        }
        .logo-container img {
            height: 100%;
            width: auto;
        }

        .search-bar {
            position: relative;
            width: 100%;
            max-width: 400px; /* Beri lebar maksimal agar tidak terlalu besar di layar lebar */
        }

        .search-bar input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #555;
            border-radius: 25px;
            background-color: #fff;
            font-size: 15px;
            box-sizing: border-box;
        }
        .search-bar .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
            font-size: 18px;
            pointer-events: none;
        }

        .header-right .icon-btn {
            font-size: 22px;
            cursor: pointer;
            color: #fff;
            transition: color 0.3s;
        }
        .header-right .icon-btn:hover {
            color: #ffc107;
        }

        /* --- Main Content --- */
        .main-content {
            width: 100%;
            padding-top: 90px;
            padding-left: 250px;
            transition: padding-left 0.3s ease-in-out;
        }

        .sidebar.collapsed ~ .main-content {
            padding-left: 70px;
        }

        .content {
            padding: 30px;
            animation: fadeIn 0.5s ease-in;
        }

        /* Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .dashboard-card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .dashboard-card h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #007BFF;
        }
        .dashboard-card p {
            font-size: 14px;
            margin: 0;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <header class="header">
            <div class="header-left">
                <button id="menu-toggle"><i class="fas fa-bars"></i></button>
                <div class="logo-container">
                    <img src="{{ asset('images/rby-logo2.png') }}" alt="Company Logo">
                </div>
            </div>

            <div class="header-center">
                <div class="search-bar">
                    <input type="text" placeholder="Telusuri">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>

            <div class="header-right">
                <a href="{{ route('profile') }}" class="icon-btn">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </header>

        <aside class="sidebar" id="sidebar">
            <nav>
                <ul>
                    <li><a href="#" class="active"><i class="fas fa-user-cog"></i><span> Admin</span></a></li>
                    <li><a href="#"><i class="fas fa-clipboard-list"></i><span> Surveyor</span></a></li>
                    <li><a href="#"><i class="fas fa-desktop"></i><span> EDP</span></a></li>
                    <li><a href="#"><i class="fas fa-file-invoice-dollar"></i><span> Finance</span></a></li>
                    <li><a href="#"><i class="fas fa-server"></i><span> IT</span></a></li>
                </ul>
            </nav>
        </aside>

        <div class="main-content" id="main-content">
            <main class="content">
                <h1>Selamat Datang!</h1>
                <p>Ini adalah area konten utama Anda. Silakan kembangkan sesuai kebutuhan.</p>

                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-users"></i> Users</h3>
                        <p>Jumlah user terdaftar: 120</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><i class="fas fa-chart-line"></i> Statistik</h3>
                        <p>Kunjungan bulan ini: 3.500</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><i class="fas fa-wallet"></i> Finance</h3>
                        <p>Pendapatan bulan ini: Rp 75.000.000</p>
                    </div>
                    <div class="dashboard-card">
                        <h3><i class="fas fa-tasks"></i> Task</h3>
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
</body>
</html>