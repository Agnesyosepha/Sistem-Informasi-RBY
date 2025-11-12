<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - RBY</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      height: 100vh;
      overflow: hidden;
    }

    .background {
      position: fixed;
      inset: 0;
      background: url("{{ asset('images/home.jpg') }}") center/cover no-repeat;
      filter: blur(8px);
      z-index: 0;
    }

    .overlay {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.5);
      z-index: 1;
    }

    .register-wrapper {
      position: relative;
      z-index: 2;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .register-container {
      position: relative;
      background: rgba(0, 0, 0, 0.75);
      padding: 40px 35px;
      border-radius: 16px;
      width: 380px;
      text-align: center;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.5);
      border: 2px solid transparent;
    }

    .register-container::before {
      content: "";
      position: absolute;
      inset: 0;
      padding: 2px;
      border-radius: 16px;
      background: linear-gradient(135deg, #c0c0c0, #ffffff, #d4d4d4);
      -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
              mask-composite: exclude;
      z-index: -1;
    }

    .register-container img {
      width: 180px;
      margin-bottom: 20px;
    }

    .register-container h2 {
      color: #fff;
      font-weight: 600;
      margin-bottom: 20px;
      letter-spacing: 0.5px;
    }

    /* ===== Input fields ===== */
    .form-group {
      position: relative;
      margin-bottom: 18px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 14px 12px 42px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 14px;
      outline: none;
      transition: 0.3s;
      background-color: #fff;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      color: #333;
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: #f7cc51;
      box-shadow: 0 0 8px rgba(247, 204, 81, 0.6);
    }

    .form-group .icon {
      position: absolute;
      top: 50%;
      left: 14px;
      transform: translateY(-50%);
      color: #555;
      font-size: 15px;
    }

    /* ===== Custom dropdown arrow (1 panah aja) ===== */
    .form-group.select-group::after {
      content: "\f0d7";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #f7cc51;
      font-size: 14px;
      pointer-events: none;
    }

    /* ===== Styling khusus dropdown ===== */
    select {
      background: linear-gradient(to bottom, #fff, #f5f5f5);
      border: 1px solid #bbb;
      border-radius: 8px;
      padding-right: 35px;
      cursor: pointer;
      font-weight: 500;
    }

    select:hover {
      border-color: #f7cc51;
      background: linear-gradient(to bottom, #fff, #faf1d1);
    }

    option {
      background: #fff;
      color: #333;
      padding: 10px;
    }

    option:checked {
      background-color: #f7cc51 !important;
      color: #000 !important;
      font-weight: 600;
    }

    /* ===== Tombol Register ===== */
    .btn-register {
      margin-top: 8px;
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #f7cc51, #e6b842);
      border: none;
      border-radius: 10px;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      color: #000;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .btn-register:hover {
      background: linear-gradient(135deg, #ffe27a, #f7cc51);
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.4);
    }

    .login-link {
      margin-top: 18px;
      font-size: 13px;
      color: #eee;
    }

    .login-link a {
      color: #f7cc51;
      font-weight: 600;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 420px) {
      .register-container {
        width: 90%;
        padding: 30px 25px;
      }
      .register-container img {
        width: 140px;
      }
    }
  </style>
</head>
<body>
  <div class="background"></div>
  <div class="overlay"></div>

  <div class="register-wrapper">
    <div class="register-container">
      <img src="{{ asset('images/rby-logo.png') }}" alt="RBY Logo">
      <h2>Register</h2>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
          <span class="icon"><i class="fa-solid fa-envelope"></i></span>
          <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
          <span class="icon"><i class="fa-solid fa-user"></i></span>
          <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="form-group select-group">
          <span class="icon"><i class="fa-solid fa-users"></i></span>
          <select name="divisi" required>
            <option value="" disabled selected>Pilih Divisi</option>
            <option value="Admin">Admin</option>
            <option value="Surveyor">Surveyor</option>
            <option value="EDP">EDP</option>
            <option value="Finance">Finance</option>
            <option value="IT">IT</option>
          </select>
        </div>

        <div class="form-group">
          <span class="icon"><i class="fa-solid fa-lock"></i></span>
          <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn-register">Daftar</button>
      </form>

      <div class="login-link">
        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
      </div>
    </div>
  </div>
</body>
</html>
