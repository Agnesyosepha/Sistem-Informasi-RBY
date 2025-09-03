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
            background-color: #000000;
            color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 30px;
            box-sizing: border-box;
            z-index: 1000;
            border-bottom: 3px solid #007BFF;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            position: fixed;
            top: 80px;
            left: 0;
            width: 250px;
            height: calc(100% - 80px);
            background: linear-gradient(180deg, #111, #222);
            padding-top: 20px;
            transition: width 0.3s ease;
            z-index: 999;
            box-shadow: 2px 0 8px rgba(0,0,0,0.3);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav ul li a {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: #f1f1f1;
            text-decoration: none;
            margin: 8px 15px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar nav ul li a:hover,
        .sidebar nav ul li a.active {
            background-color: #ffc107;
            color: #111;
            transform: translateX(5px);
        }

        .sidebar nav ul li a i {
            margin-right: 12px;
            font-size: 18px;
            min-width: 24px;
            text-align: center;
        }

        .sidebar.collapsed nav ul li a span {
            display: none;
        }

        /* --- Profile Content --- */
        .profile-container {
            margin-top: 120px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            transition: padding-left 0.3s ease;
            padding-left: 250px;
        }

        .sidebar.collapsed ~ .profile-container {
            padding-left: 70px;
        }

        .profile-photo {
            width: 200px;
            height: 200px;
            border: 5px solid #ffffff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #e0e0e0;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1), 0 5px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .profile-photo:hover {
            transform: scale(1.05);
        }
        .profile-photo i {
            font-size: 110px;
            color: #555;
        }
        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            width: 100%;
            max-width: 500px;
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-details .field {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: box-shadow 0.3s ease;
        }
        .profile-details .field:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .edit-container {
            width: 100%;
            max-width: 500px;
            text-align: right;
        }
        
        .edit-btn {
            display: inline-block;
            background-color: #E0A800;
            color: #000000;
            border: none;
            padding: 14px 30px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(224, 168, 0, 0.4);
            letter-spacing: 0.5px;
        }
        .edit-btn:hover {
            background-color: #ffc107;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.5);
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
    
    <!-- Sidebar -->
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

    <!-- Profile Content -->
    <div class="profile-container">
        <div class="profile-photo">
            <i class="fas fa-user"></i>
        </div>
        <div class="profile-details">
            <div class="field">Name Surname</div>
            <div class="field">Divisi</div>
        </div>

        <div class="edit-container">
            <button class="edit-btn">Edit Profil</button>
        </div>
    </div>

    <!-- Modal Logout -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
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

            logoutBtn.addEventListener('click', () => {
                logoutModal.style.display = 'flex';
            });

            cancelLogout.addEventListener('click', () => {
                logoutModal.style.display = 'none';
            });

            confirmLogout.addEventListener('click', () => {
                logoutForm.submit();
            });
        });
    </script>

</body>
</html>
