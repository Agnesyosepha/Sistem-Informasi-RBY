<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to top right, #f4f7f9, #e9edf2);
            color: #333;
        }

        /* --- Header --- */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background-color: #4FB7B3;
            color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-sizing: border-box;
            z-index: 1000;
            border-bottom: 3px solid #FFFD8F;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .warn-icon {
            width: 100px;
            height: 100px;
            border: 4px solid #e6b17a;   /* warna lingkaran */
            border-radius: 50%;          /* biar bulat */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;             /* ukuran tanda seru */
            font-weight: bold;
            color: #e6b17a;              /* warna tanda seru */
            margin: 0 auto 20px auto;    /* biar center */
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        #menu-toggle {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 24px;
            cursor: pointer;
            margin-right: 20px;
        }

        .logo-container {
            height: 65px;
        }
        .logo-container img {
            height: 100%;
            width: auto;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: auto;
        }
        
        .profile-icon {
            font-size: 22px;
            cursor: pointer;
            color: #ffffff;
        }

        /* Logout Button */
        .logout-btn {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            background: #c82333;
        }

        /* --- Sidebar --- */
        .sidebar {
            position: fixed; top: 80px; left: 0;
            width: 250px; height: calc(100% - 80px);
            background: linear-gradient(180deg, #4FB7B3, #222);
            padding-top: 20px;
            transition: width 0.3s ease-in-out;
            z-index: 999; box-shadow: 2px 0 8px rgba(0,0,0,0.3);
            overflow-x: hidden;
        }
        .sidebar.collapsed { width: 80px; }
        .sidebar nav ul { list-style: none; padding: 0; margin: 0; }
        .sidebar nav ul li a {
            display: flex; align-items: center;
            padding: 14px 25px; color: #f1f1f1; text-decoration: none;
            margin: 8px 10px; border-radius: 8px; font-weight: 500;
            transition: all 0.2s ease; white-space: nowrap;
        }
        .sidebar nav ul li a:hover, .sidebar nav ul li a.active {
            background-color: #ffc107; color: #111;
        }
        .sidebar nav ul li a i {
            margin-right: 20px; font-size: 18px;
            min-width: 30px; text-align: center;
        }
        .sidebar.collapsed nav ul li a span { display: none; }
        .sidebar.collapsed nav ul li a i { margin-right: 0; }

        .sidebar.collapsed ~ .profile-container {
            padding-left: 70px;
        }

        

        /* --- Modal Logout --- */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(3px);
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .modal-box {
            position: relative;
            background: #fff;
            padding: 25px 35px;
            border-radius: 15px;
            text-align: center;
            max-width: 380px;
            width: 100%;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.3s ease-out;
        }

        .modal-box h3 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn-yes {
            background: #28a745;
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-yes:hover {
            background: #218838;
        }

        .btn-no {
            background: #dc3545;
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-no:hover {
            background: #c82333;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: scale(0.9);}
            to {opacity: 1; transform: scale(1);}
        }
    </style>
</head>
<body>
    
    {{-- Sidebar --}}
        <aside class="sidebar" id="sidebar">
    <nav>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="{{ Route::is('dashboard') ? 'active' : '' }}">
                   <i class="fas fa-home"></i><span> Home</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin') }}" 
                   class="{{ Route::is('admin') ? 'active' : '' }}">
                   <i class="fas fa-user-cog"></i><span> Admin</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('surveyor') }}" 
                   class="{{ Route::is('surveyor') ? 'active' : '' }}">
                   <i class="fas fa-clipboard-list"></i><span> Surveyor</span>
                </a>
            </li>
            <li>
                <a href="{{ route('edp') }}" 
                   class="{{ Route::is('edp') ? 'active' : '' }}">
                   <i class="fas fa-desktop"></i><span> EDP</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reviewer') }}" 
                   class="{{ Route::is('reviewer') ? 'active' : '' }}">
                   <i class="fas fa-file-signature"></i><span> Reviewer</span>
                </a>
            </li>
            <li>
                <a href="{{ route('finance') }}" 
                   class="{{ Route::is('finance') ? 'active' : '' }}">
                   <i class="fas fa-file-invoice-dollar"></i><span> Finance</span>
                </a>
            </li>
            <li>
                <a href="{{ route('it') }}" 
                   class="{{ Route::is('it') ? 'active' : '' }}">
                   <i class="fas fa-server"></i><span> IT</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button id="menu-toggle"><i class="fas fa-bars"></i></button>
            <div class="logo-container">
                <a href="{{ route('dashboard') }}" >
                <img src="{{ asset('images/rby-logo2.png') }}" alt="Company Logo">
                </a>
            </div>
        </div>

        <div class="header-right">
            <a href="#" class="profile-icon">
                <i class="fas fa-user"></i>
            </a>

            <!-- Tombol Logout -->
            <button type="button" class="logout-btn" id="logoutBtn">Logout</button>
        </div>
    </header>

    <!--  Content -->
    

    <!-- Modal Logout -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <div class="warn-icon">
                !
            </div>

            <h3>Apakah Anda yakin ingin keluar?</h3>
            <div class="modal-actions">
                <button class="btn-yes" id="confirmLogout">Ya</button>
                <button class="btn-no" id="cancelLogout">Tidak</button>
            </div>
        </div>
    </div>

    <!-- Form logout hidden -->
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });

            // Modal Logout
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');
            const logoutForm = document.getElementById('logoutForm');
            const closeLogout = document.getElementById('closeLogout');

            logoutBtn.addEventListener('click', () => {
                logoutModal.style.display = 'flex';
            });

            cancelLogout.addEventListener('click', () => {
                logoutModal.style.display = 'none';
            });

            confirmLogout.addEventListener('click', () => {
                logoutForm.submit();
            });

            closeLogout.addEventListener('click', () => {
                logoutModal.style.display = 'none';
            });
        });
    </script>

</body>
</html>
