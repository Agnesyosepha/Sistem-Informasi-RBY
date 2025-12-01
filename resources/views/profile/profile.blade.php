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

        /* --- MOBILE SMALL (max-width: 576px) --- */
@media (max-width: 576px) {

    .profile-container {
        margin-left: 0;
        padding: 20px;
        margin-top: 100px;
    }

    .profile-card {
        flex-direction: column;
        padding: 20px;
        gap: 20px;
    }

    .profile-card.upgraded {
        flex-direction: column;
        padding: 25px;
        gap: 25px;
    }

    .profile-left {
        border-right: none;
        padding-right: 0;
        border-bottom: 2px dashed #e8e8e8;
        padding-bottom: 20px;
        text-align: center;
    }

    .profile-grid {
        grid-template-columns: 1fr;
    }

    .sidebar {
        width: 200px;
    }

    #menu-toggle {
        font-size: 24px;
    }

    .header {
        height: 70px;
        padding: 0 15px;
    }

    .logo-container img {
        height: 45px;
    }
}


/* --- TABLET PORTRAIT & MOBILE LARGE (max-width: 768px) --- */
@media (max-width: 768px) {

    .sidebar {
        position: fixed;
        width: 230px;
        transform: translateX(-100%);
    }

    .sidebar.open {
        transform: translateX(0);
    }

    .profile-container {
        margin-left: 0;
        padding: 30px 20px;
    }

    .profile-card {
        flex-direction: column;
        gap: 30px;
    }

    .profile-left {
        border-right: none;
        padding-right: 0;
        border-bottom: 2px dashed #e8e8e8;
        padding-bottom: 20px;
        text-align: center;
    }
}
/* --- TABLET LANDSCAPE (max-width: 1024px) --- */
@media (max-width: 1024px) {

    .sidebar {
        width: 200px;
    }

    .profile-container {
        margin-left: 220px;
        padding: 30px;
    }

    .profile-card {
        padding: 25px;
        gap: 25px;
    }

    .profile-grid {
        gap: 18px 25px;
    }
}
/* --- DESKTOP --- */
@media (min-width: 1025px) {
    .profile-container {
        margin-left: 250px;
    }
}


        /* --- Header --- */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background-color: #898AC4; color: white;
            color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-sizing: border-box;
            z-index: 1000;
            border-bottom: 3px solid #FF8F8F;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .warn-icon {
            width: 100px;
            height: 100px;
            border: 4px solid #e6b17a;   
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
            position: fixed; 
            top: 80px; 
            left: 0;
            width: 250px; 
            height: calc(100% - 80px);
            background: linear-gradient(180deg, #898AC4, #3C467B);
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

        /* Profile Section */
        .profile-container {
            margin-left: 250px;
            margin-top: 120px;
            padding: 40px;
            transition: 0.3s;
        }

        .profile-card.upgraded {
            display: flex;
            background: #ffffff;
            border-radius: 25px;
            padding: 40px 50px;
            gap: 50px;
            width: 100%;
            max-width: 950px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            border: 1px solid #ececec;
            animation: fadeSlideUp 0.4s ease;
        }

        .profile-card {
            display: flex;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            padding: 30px;
            gap: 40px;
        }

        .profile-left {
            flex: 1;
            text-align: center;
            border-right: 2px dashed #e8e8e8;
            padding-right: 40px;
        }
        .upgraded-photo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(135deg, #d4a15a, #f7d9a1);
            color: #fff;
            font-size: 85px;
            border: 6px solid #fff;
            box-shadow: 0 5px 20px rgba(212,161,90,0.4);
        }

        .name-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

.email-text {
    font-size: 14px;
    color: #777;
    margin-bottom: 20px;
}

.upgrade-edit {
    background: #e6b17a;
    padding: 10px 25px;
    border-radius: 25px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
}

.upgrade-edit:hover {
    background: #ffcb6b;
}

/* Right */
.profile-right {
    flex: 2;
}
.section-title {
    font-size: 20px;
    font-weight: 700;
    padding-bottom: 10px;
    margin-bottom: 25px;
    border-bottom: 3px solid #e6b17a;
    width: fit-content;
}

.profile-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px 40px;
}

.info-item label {
    font-size: 13px;
    font-weight: 600;
    color: #5d5d5d;
}

    .info-item p {
        margin-top: 5px;
        background: #f8f9fb;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid #ececec;
        font-size: 14px;
        color: #444;
    }

    /* Animation */
    @keyframes fadeSlideUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
        .profile-photo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid #e6b17a;
            margin: 0 auto 20px;
            background: #f0f0f0;
        }

        .profile-photo i {
            font-size: 100px;
            color: #aaa;
            line-height: 180px;
        }

        .profile-left h3 {
            margin: 10px 0 5px;
            font-size: 22px;
            font-weight: 600;
        }

        .profile-left p {
            color: #666;
            font-size: 14px;
        }

        .edit-btn {
            background: #e6b17a;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .edit-btn:hover {
            background: #ffc107;
        }

        .profile-right {
            flex: 2;
        }

        .profile-right h4 {
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid #e6b17a;
            display: inline-block;
            padding-bottom: 5px;
        }

        .profile-field {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .profile-field label {
            width: 120px;
            font-weight: 500;
            color: #555;
        }

        .profile-field input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9fafb;
        }

        .profile-field input:focus {
            outline: none;
            border-color: #e6b17a;
            background: #fff;
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

        /* ========= RESPONSIVE ========= */

        /* MOBILE (≤576px) */
        @media (max-width: 576px) {
            .profile-card {
                flex-direction: column;
                padding: 25px;
                gap: 20px;
            }
            .profile-left {
                border-right: none;
                padding-right: 0;
                border-bottom: 2px dashed #e8e8e8;
                padding-bottom: 20px;
            }
            .profile-grid {
                grid-template-columns: 1fr;
            }
            .sidebar {
                width: 230px;
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .profile-container {
                margin-left: 0;
                padding: 120px 20px;
            }
        }

        /* TABLET (576px–768px) */
        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
            }
            .sidebar {
                width: 230px;
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .profile-container {
                margin-left: 0;
                padding: 120px 25px;
            }
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        /* SMALL DESKTOP (≤1024px) */
        @media (max-width: 1024px) {
            .profile-container {
                margin-left: 200px;
            }
            .sidebar {
                width: 200px;
            }
        }
        .form-label {
            font-weight: 600;
        }

        .form-control {
            background-color: #f7f9fc;
            border-radius: 10px;
            height: 42px;
        }
        .info-grid-modern {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px 40px;
            margin-top: 5px;
        }

        .info-box label {
            font-weight: 600;
            font-size: 14px;
            color: #5e5e5e;
        }

        .info-box p {
            margin-top: 6px;
            padding: 12px 15px;
            border-radius: 12px;
            background: #f8f9fc;
            border: 1px solid #e5e7eb;
            color: #444;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .info-grid-modern {
                grid-template-columns: 1fr;
            }
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
                <img src="{{ asset('images/rby-logo3.jpg') }}" alt="Company Logo">
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
    <div class="profile-card upgraded">
        
        <!-- Left -->
        <div class="profile-left">
            <div class="profile-photo upgraded-photo">
                <i class="fas fa-user"></i>
            </div>

            <h3 class="name-title">{{ $user->nama }}</h3>

            <p class="email-text">{{ $user->email }}</p>

            <button class="edit-btn upgrade-edit">Edit Profil</button>
        </div>

        <!-- Right -->
        <div class="profile-right">
            <h4 class="section-title">Informasi Akun</h4>
        
            <div class="info-grid-modern">

            <!-- Nama -->
            <div class="info-box">
            <label>Nama</label>
            <p>{{ $user->nama }}</p>
        </div>

        <div class="info-box">
            <label>Divisi</label>
            <p>{{ $user->divisi }}</p>
        </div>

        <div class="info-box">
            <label>Alamat</label>
            <p>{{ $user->alamat ?? '-' }}</p>
        </div>

        <div class="info-box">
            <label>Jabatan</label>
            <p>{{ $user->jabatan ?? '-' }}</p>
        </div>

        <div class="info-box">
            <label>No. HP</label>
            <p>{{ $user->nohp ?? '-' }}</p>
        </div>

        <div class="info-box">
            <label>Nomor MAPPI</label>
            <p>{{ $user->mappi ?? '-' }}</p>
        </div>

        </div>

    </div>
</div>

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
                // Jika layar kecil (mobile)
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('open');   // gunakan .open untuk mobile
                } else {
                    sidebar.classList.toggle('collapsed');  // gunakan .collapsed untuk desktop
                }
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('open'); 
                }
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
