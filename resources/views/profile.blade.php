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

        /* --- Sidebar --- */
        .sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            width: 250px;
            height: calc(100% - 80px);
            background: linear-gradient(180deg, #111, #222);
            padding-top: 20px;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            z-index: 999;
            box-shadow: 2px 0 8px rgba(0,0,0,0.3);
        }

        .sidebar.active {
            transform: translateX(0);
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
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
            height: calc(100% - 80px);
            background: rgba(0,0,0,0.5);
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
            z-index: 998;
        }
        .overlay.active {
            opacity: 1;
            visibility: visible;
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
    </style>
</head>
<body>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <nav>
            <ul>
                <li><a href="#" class="active"><i class="fas fa-user-cog"></i> Admin</a></li>
                <li><a href="#"><i class="fas fa-clipboard-list"></i> Surveyor</a></li>
                <li><a href="#"><i class="fas fa-desktop"></i> EDP</a></li>
                <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> Finance</a></li>
                <li><a href="#"><i class="fas fa-server"></i> IT</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button id="menu-toggle"><i class="fas fa-bars"></i></button>
            <div class="logo-container">
                <img src="{{ asset('images/rby-logo2.png') }}" alt="Company Logo">
            </div>
        </div>

        <div class="header-right">
            <a href="#" class="profile-icon">
                <i class="fas fa-user"></i>
            </a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
    </script>

</body>
</html>
