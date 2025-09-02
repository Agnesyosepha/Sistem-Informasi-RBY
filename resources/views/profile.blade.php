<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        /* --- Header --- */
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
            padding: 0 30px;
            border-bottom: 3px solid #007BFF;
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

        .search-bar {
            position: relative;
            width: 300px;
        }

        .search-bar input {
            width: 100%;
            padding: 8px 35px 8px 15px;
            border: 1px solid #555;
            border-radius: 20px;
        }

        .search-bar .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .profile-icon {
            font-size: 22px;
            cursor: pointer;
        }

        /* --- Profile Content --- */
        .profile-container {
            margin-top: 100px;
            padding: 30px;
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .profile-photo {
            width: 180px;
            height: 180px;
            border: 2px solid #000;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .profile-photo i {
            font-size: 100px;
            color: #111;
        }

        .profile-details {
            flex: 1;
        }

        .profile-details .field {
            background: #fff;
            border: 1px solid #111;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
            box-shadow: 2px 3px 5px rgba(0,0,0,0.2);
        }

        .edit-btn {
            display: inline-block;
            background-color: #E0A800;
            color: #000;
            border: 1px solid #000;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .edit-btn:hover {
            background-color: #ffc107;
        }

        .edit-container {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button id="menu-toggle"><i class="fas fa-bars"></i></button>
            <div class="logo-container">
                <img src="{{ asset('images/rby-logo2.png') }}" alt="Company Logo">
            </div>
        </div>

        <div class="header-right">
            <div class="search-bar">
                <input type="text" placeholder="Telusuri">
                <i class="fas fa-search search-icon"></i>
            </div>
            <a href="{{ route('profile') }}" class="profile-icon">
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

            <div class="edit-container">
                <button class="edit-btn">Edit Profil</button>
            </div>
        </div>
    </div>
</body>
</html>
