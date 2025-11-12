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
    }

    body {
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
    }

    /* ===== Background utama ===== */
    .background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: url("{{ asset('images/home.jpg') }}") center/cover no-repeat;
      filter: blur(6px);
      z-index: 0;
    }

    /* ===== Overlay hitam semi transparan ===== */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: rgba(0,0,0,0.3);
      z-index: 1;
    }

    /* ===== Popup Register ===== */
    .register-container {
      position: relative;
      z-index: 2;
      background: #000;
      padding: 40px 25px;
      border-radius: 12px;
      width: 340px;
      text-align: center;
      box-shadow: 0 4px 14px rgba(0,0,0,0.4);
      margin: auto;
      top: 50%;
      transform: translateY(-50%);
      border: 2px solid transparent;
      background-clip: padding-box;
    }

    /* Border gradient seperti login */
    .register-container::before {
      content: "";
      position: absolute;
      inset: 0;
      padding: 2px;
      border-radius: 12px;
      background: linear-gradient(135deg, #cacacb, #c4c4c6, #cacacb);
      -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
              mask-composite: exclude;
      z-index: -1;
    }

    .register-container h2 {
      color: #fff;
      margin-bottom: 15px;
      font-weight: 600;
    }

    .register-container img {
      width: 200px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 15px;
      position: relative;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 12px 12px 40px;
      border: 1px solid #ddd;
      border-radius: 8px;
      outline: none;
      font-size: 14px;
      box-sizing: border-box;
      background: #fff;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
    }

    .form-group input::placeholder {
      color: #aaa;
    }

    .form-group .icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 16px;
      color: #444;
    }

    .form-group.select-group::after {
      content: "\f078";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #444;
      pointer-events: none;
    }

    .btn-register {
      margin-top: 15px;
      width: 100%;
      padding: 12px;
      background: #F7CC51;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
      color: #000;
      box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    }

    .btn-register:hover {
      background: #e6b842;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }

    .login-link {
      margin-top: 15px;
      font-size: 13px;
      color: #fff;
    }

    .login-link a {
      color: #F7CC51;
      font-weight: 600;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Background dan overlay -->
  <div class="background"></div>
  <div class="overlay"></div>

  <!-- Popup Register -->
  <div class="register-container">
    <h2>Register</h2>
    <img src="{{ asset('images/rby-logo.png') }}" alt="RBY Logo">

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

</body>
</html>
