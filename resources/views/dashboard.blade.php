<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout</title>
    {{-- Font Awesome CDN untuk Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* CSS Reset and Basic Styling */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            height: 100%;
        }

        .main-container {
            display: flex;
            height: 100vh;
        }

        /* --- Sidebar --- */
        .sidebar {
            position: fixed;
            top: 60px; /* Di bawah header */
            left: 0;
            width: 250px;
            height: calc(100% - 60px); /* Tinggi penuh dikurangi tinggi header */
            background-color: #111;
            padding-top: 20px;
            transform: translateX(-100%); /* Sembunyikan sidebar di awal */
            transition: transform 0.3s ease-in-out;
            z-index: 999;
        }

        .sidebar.active {
            transform: translateX(0); /* Tampilkan sidebar */
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav ul li a {
            display: flex;
            align-items: center;
            background-color: #E0A800; /* Warna kuning pada tombol */
            color: #111; /* Warna teks hitam */
            padding: 15px 20px;
            text-decoration: none;
            margin: 10px 15px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .sidebar nav ul li a:hover {
            background-color: #ffc107;
        }

        .sidebar nav ul li a i {
            margin-right: 15px;
            width: 20px; /* Agar ikon sejajar */
            text-align: center;
        }

        /* --- Header --- */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #000;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 3px solid #007BFF; /* Garis biru di bawah header */
            box-sizing: border-box;
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        #menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            margin-right: 20px;
        }

        /* === PERUBAHAN CSS UNTUK LOGO === */
        .logo-container {
            height: 50px; /* Atur tinggi container logo */
        }

        .logo-container img {
            height: 100%; /* Buat gambar mengisi tinggi container */
            width: auto; /* Lebar akan menyesuaikan */
        }
        /* ================================== */

        .header-center {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .search-bar {
            position: relative;
            width: 50%;
            max-width: 400px;
        }

        .search-bar input {
            width: 100%;
            padding: 8px 15px;
            border: 1px solid #555;
            border-radius: 20px;
            background-color: #fff;
            color: #000;
        }
        
        .search-bar .search-icon {
            display: none;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        
        .sidebar.active ~ .main-content .header .search-icon {
             display: block;
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        .profile-icon {
            font-size: 24px;
            cursor: pointer;
        }

        /* --- Main Content --- */
        .main-content {
            width: 100%;
            padding-top: 60px; /* Jarak dari header */
            padding-left: 0;
            transition: padding-left 0.3s ease-in-out;
        }

        .sidebar.active ~ .main-content {
            padding-left: 250px;
        }

        .content {
            padding: 20px;
            background-color: white;
            min-height: calc(100vh - 60px);
        }

    </style>
</head>
<body>

    <div class="main-container">
        <aside class="sidebar" id="sidebar">
            <nav>
                <ul>
                    <li><a href="#"><i class="fas fa-user-cog"></i> Admin</a></li>
                    <li><a href="#"><i class="fas fa-clipboard-list"></i> Surveyor</a></li>
                    <li><a href="#"><i class="fas fa-desktop"></i> EDP</a></li>
                    <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> Finance</a></li>
                    <li><a href="#"><i class="fas fa-server"></i> IT</a></li>
                </ul>
            </nav>
        </aside>

        <div class="main-content" id="main-content">
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
                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </header>

            <main class="content">
                <h1>Selamat Datang!</h1>
                <p>Ini adalah area konten utama Anda. Silakan kembangkan sesuai kebutuhan.</p>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        });
    </script>
</body>
</html>