<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body, html {
            margin: 0; padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: #333;
            min-height: 100vh;
        }

        /* --- Header --- */
        .header {
            position: fixed; top: 0; left: 0;
            width: 100%; height: 80px;
            background: linear-gradient(90deg, #0278AE, #008DDA, #41C9E2);
            color: #fff;
            display: flex; align-items: center;
            padding: 0 20px; box-sizing: border-box;
            z-index: 1000;
            border-bottom: 3px solid #FFFA8D;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .header-left { display: flex; align-items: center; }
        #menu-toggle {
            background: rgba(255,255,255,0.15); border: none;
            color: #fff; font-size: 24px;
            cursor: pointer; margin-right: 20px;
            width: 45px; height: 45px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease;
        }
        #menu-toggle:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.05);
        }
        .logo-container { height: 65px; }
        .logo-container img { height: 100%; width: auto; border-radius: 8px; }

        .header-right {
            display: flex; align-items: center; gap: 15px; margin-left: auto;
        }
        .profile-icon, .notification-icon { 
            font-size: 22px; 
            cursor: pointer; 
            color: #fff; 
            position: relative;
            background: rgba(255,255,255,0.15);
            width: 45px; height: 45px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease;
        }
        .profile-icon:hover, .notification-icon:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.05);
        }
        .logout-btn {
            background: linear-gradient(90deg, #dc3545, #c82333); color: #fff;
            border: none; padding: 8px 16px;
            border-radius: 20px; cursor: pointer;
            font-weight: 600; transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(220,53,69,0.3);
        }
        .logout-btn:hover { 
            background: linear-gradient(90deg, #c82333, #bd2130);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(220,53,69,0.4);
        }

        /* --- Sidebar --- */
        .sidebar {
            position: fixed; top: 80px; left: 0;
            width: 250px; height: calc(100% - 80px);
            background: linear-gradient(180deg, #0278AE, #3FC5F0);
            padding-top: 20px; transition: all 0.3s ease;
            z-index: 999; box-shadow: 4px 0 15px rgba(0,0,0,0.2);
            overflow-x: hidden;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar.collapsed { width: 80px; }
        .sidebar nav ul { list-style: none; padding: 0; margin: 0; }
        .sidebar nav ul li a {
            display: flex; align-items: center;
            padding: 14px 25px; color: rgba(255, 255, 255, 0.9);
            text-decoration: none; margin: 8px 10px;
            border-radius: 12px; font-weight: 500;
            transition: all 0.3s ease; white-space: nowrap;
            position: relative;
            overflow: hidden;
        }
        .sidebar nav ul li a::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        .sidebar nav ul li a:hover::before {
            left: 100%;
        }
        .sidebar nav ul li a:hover,
        .sidebar nav ul li a.active {
            background: linear-gradient(90deg, #FFC107, #FFC107);
            color: #111;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
            transform: translateX(5px);
        }
        .sidebar nav ul li a i {
            margin-right: 20px; font-size: 18px;
            min-width: 30px; text-align: center;
            transition: all 0.3s ease;
        }
        .sidebar nav ul li a:hover i {
            transform: scale(1.2);
        }
        .sidebar.collapsed nav ul li a span { display: none; }
        .sidebar.collapsed nav ul li a i { margin-right: 0; }

        /* --- Content --- */
        .content-area {
            margin-left: 260px;
            padding: 0;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .sidebar.collapsed ~ .content-area { margin-left: 100px; }

        /* --- Profile Section --- */
        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            box-sizing: border-box;
            margin-top: 100px;
        }

        .profile-card {
            display: flex;
            background: #fff;
            border-radius: 25px;
            padding: 40px 50px;
            gap: 50px;
            width: 100%;
            max-width: 950px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            border: 2px solid #D4AF37;
            margin: 0 auto;
        }

        .profile-left {
            flex: 1;
            text-align: center;
            border-right: 2px dashed #e8e8e8;
            padding-right: 40px;
        }

        .profile-photo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0278AE, #3FC5F0);
            color: #fff;
            font-size: 85px;
            border: 6px solid #D4AF37;
            box-shadow: 0 5px 20px rgba(2, 120, 174, 0.4);
            overflow: hidden;
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .name-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #0278AE;
        }

        .email-text {
            font-size: 14px;
            color: #777;
            margin-bottom: 20px;
        }

        .edit-btn {
            background: linear-gradient(90deg, #D4AF37, #F2D16B);
            color: #fff;
            padding: 10px 25px;
            border-radius: 25px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.3);
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(212, 175, 55, 0.4);
        }

        .profile-right {
            flex: 2;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            padding-bottom: 10px;
            margin-bottom: 25px;
            border-bottom: 3px solid #D4AF37;
            width: fit-content;
            color: #0278AE;
        }

        .info-grid {
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
            border-left: 3px solid #D4AF37;
        }

        /* --- Logout Modal --- */
        .modal-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
            align-items: center; justify-content: center;
            z-index: 2000;
        }
        .modal-box {
            background: #fff; padding: 25px 35px;
            border-radius: 15px; text-align: center;
            max-width: 380px; width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            border: 2px solid #D4AF37;
        }
        .warn-icon {
            width: 100px; height: 100px;
            background: linear-gradient(135deg, #D4AF37, #F2D16B);
            border-radius: 50%;
            display: flex; align-items: center;
            justify-content: center;
            font-size: 60px; font-weight: bold;
            color: #fff;
            margin: 0 auto 20px;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }
        .modal-actions { display: flex; justify-content: center; gap: 20px; }
        .btn-yes, .btn-no {
            border: none; padding: 10px 25px;
            border-radius: 8px; cursor: pointer;
            font-weight: 600; color: white;
            transition: all 0.3s ease;
        }
        .btn-yes { 
            background: linear-gradient(90deg, #28a745, #218838);
            box-shadow: 0 4px 10px rgba(40,167,69,0.3);
        }
        .btn-yes:hover { 
            background: linear-gradient(90deg, #218838, #1e7e34);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(40,167,69,0.4);
        }
        .btn-no { 
            background: linear-gradient(90deg, #dc3545, #c82333);
            box-shadow: 0 4px 10px rgba(220,53,69,0.3);
        }
        .btn-no:hover { 
            background: linear-gradient(90deg, #c82333, #bd2130);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(220,53,69,0.4);
        }

        .notification-badge {
            background: linear-gradient(90deg, #ff3b3b, #ff6b6b);
            color: #fff;
            font-size: 12px;
            padding: 2px 7px;
            border-radius: 12px;
            position: absolute;
            top: -8px;
            right: -8px;
            font-weight: 600;
            min-width: 18px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(255,59,59,0.3);
        }

        /* --- Animations --- */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Responsive --- */
        @media (max-width: 768px) {
            .sidebar { width: 230px; transform: translateX(-100%); top: 65px; height: calc(100% - 65px); }
            .sidebar.open { transform: translateX(0); }
            .header { height: 65px; padding: 0 15px; }
            #menu-toggle { font-size: 26px; }
            .logo-container img { height: 45px; }
            .content-area { 
                margin-left: 0 !important; 
                padding: 0;
                justify-content: center;
                align-items: center;
            }
            
            .profile-card {
                flex-direction: column;
                padding: 25px;
                gap: 25px;
            }
            
            .profile-left {
                border-right: none;
                padding-right: 0;
                border-bottom: 2px dashed #e8e8e8;
                padding-bottom: 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 1024px) {
            .sidebar { width: 200px; }
            .content-area { margin-left: 210px; }
            .sidebar.collapsed ~ .content-area { margin-left: 90px; }
            
            .profile-card {
                padding: 30px;
                gap: 30px;
            }
        }
    </style>
</head>

<body>
    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> <span>Home</span></a></li>
                <li><a href="{{ route('admin') }}" class="{{ Route::is('admin*') ? 'active' : '' }}"><i class="fas fa-user-cog"></i> <span>Admin</span></a></li>
                <li><a href="{{ route('surveyor') }}" class="{{ Route::is('surveyor*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> <span>Surveyor</span></a></li>
                <li><a href="{{ route('edp') }}" class="{{ Route::is('edp*') ? 'active' : '' }}"><i class="fas fa-desktop"></i> <span>EDP</span></a></li>
                <li><a href="{{ route('reviewer') }}" class="{{ Route::is('reviewer*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i> <span>Reviewer</span></a></li>
                <li><a href="{{ route('finance') }}" class="{{ Route::is('finance*') ? 'active' : '' }}"><i class="fas fa-file-invoice-dollar"></i> <span>Finance</span></a></li>
                <li><a href="{{ route('it') }}" class="{{ Route::is('it*') ? 'active' : '' }}"><i class="fas fa-server"></i> <span>IT</span></a></li>
            </ul>
        </nav>
    </aside>

    {{-- Header --}}
    <header class="header">
        <div class="header-left">
            <button id="menu-toggle"><i class="fas fa-bars"></i></button>
            <div class="logo-container">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/rby-logo3.jpg') }}" alt="Company Logo">
                </a>
            </div>
        </div>

        <div class="header-right">
            <a href="{{ route('notifications.index') }}" class="notification-icon">
                <i class="fas fa-bell"></i>
                @if(auth()->user()->unreadNotificationsCount() > 0)
                    <span class="notification-badge">{{ auth()->user()->unreadNotificationsCount() }}</span>
                @endif
            </a>
            <a href="{{ route('profile') }}" class="profile-icon"><i class="fas fa-user"></i></a>
            <button class="logout-btn" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="content-area">
        <div class="profile-container">
            <div class="profile-card">
                
                <!-- Left -->
                <div class="profile-left">
                    <div class="profile-photo">
                        @if($user->photo)
                            <img 
                                src="{{ asset('storage/'.$user->photo) }}"
                                alt="Foto Profil"
                            >
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>

                    <h3 class="name-title">{{ $user->nama }}</h3>

                    <p class="email-text">{{ $user->email }}</p>

                    <button type="button" 
                            class="edit-btn" 
                            id="editPhotoBtn">
                        Edit Profil
                    </button>
                    <form id="photoForm" 
                        action="{{ route('profile.photo') }}" 
                        method="POST" 
                        enctype="multipart/form-data"
                        style="display:none;">
                        @csrf
                        <input type="file" 
                            name="photo" 
                            id="photoInput" 
                            accept="image/*">
                    </form>
                </div>

                <!-- Right -->
                <div class="profile-right">
                    <h4 class="section-title">Informasi Akun</h4>
                
                    <div class="info-grid">

                    <!-- Nama -->
                    <div class="info-item">
                    <label>Nama</label>
                    <p>{{ $user->nama }}</p>
                </div>

                <div class="info-item">
                    <label>Divisi</label>
                    <p>{{ $user->divisi }}</p>
                </div>

                <div class="info-item">
                    <label>Alamat</label>
                    <p>{{ $user->alamat ?? '-' }}</p>
                </div>

                <div class="info-item">
                    <label>Jabatan</label>
                    <p>{{ $user->jabatan ?? '-' }}</p>
                </div>

                <div class="info-item">
                    <label>No. HP</label>
                    <p>{{ $user->nohp ?? '-' }}</p>
                </div>

                <div class="info-item">
                    <label>Nomor MAPPI</label>
                    <p>{{ $user->mappi ?? '-' }}</p>
                </div>

                </div>

            </div>
        </div>
    </main>

    {{-- Logout Modal --}}
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <div class="warn-icon">!</div>
            <h3>Apakah Anda yakin ingin keluar?</h3>
            <div class="modal-actions">
                <button class="btn-yes" id="confirmLogout">Ya</button>
                <button class="btn-no" id="cancelLogout">Tidak</button>
            </div>
        </div>
    </div>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menu-toggle');

            menuToggle.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('open');
                } else {
                    sidebar.classList.toggle('collapsed');
                }
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });

            // Logout Modal
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');
            const logoutForm = document.getElementById('logoutForm');

            logoutBtn.addEventListener('click', () => logoutModal.style.display = 'flex');
            cancelLogout.addEventListener('click', () => logoutModal.style.display = 'none');
            confirmLogout.addEventListener('click', () => logoutForm.submit());
            
            // Close modal when clicking outside
            logoutModal.addEventListener('click', function(event) {
                if (event.target === logoutModal) {
                    logoutModal.style.display = 'none';
                }
            });

            // Edit Photo
            const editBtn = document.getElementById('editPhotoBtn');
            const photoInput = document.getElementById('photoInput');
            const photoForm = document.getElementById('photoForm');

            editBtn.addEventListener('click', function () {
                photoInput.click();
            });

            photoInput.addEventListener('change', function () {
                if (this.files.length > 0) {
                    photoForm.submit();
                }
            });
        });
    </script>
</body>
</html>