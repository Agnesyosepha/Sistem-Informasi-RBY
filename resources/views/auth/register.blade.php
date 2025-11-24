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
      background: #000;
    }

    /* Background */
    .background {
      position: fixed;
      inset: 0;
      background: url("{{ asset('images/home.jpg') }}") center/cover no-repeat;
      z-index: 0;
    }

    /* Overlay gold halus */
    .overlay {
      position: fixed;
      inset: 0;
      background: linear-gradient(
        rgba(247, 204, 81, 0.18),
        rgba(247, 204, 81, 0.05)
      );
      backdrop-filter: blur(2px);
      z-index: 1;
    }

    /* Spotlight */
    .spotlight {
      position: fixed;
      inset: 0;
      background: radial-gradient(
        circle at center,
        rgba(255, 255, 255, 0.25) 0%,
        rgba(0,0,0,0.65) 100%
      );
      opacity: 0.35;
      z-index: 1.5;
    }

    /* Container */
    .register-container {
      position: relative;
      z-index: 3;
      width: 330px;
      padding: 35px 28px;
      margin: auto;
      top: 50%;
      transform: translateY(-50%);
      text-align: center;

      background: rgba(255, 255, 255, 0.18);
      backdrop-filter: blur(14px);
      border-radius: 14px;
      border: 2px solid rgba(247, 204, 81, 0.7);

      box-shadow: 0 10px 28px rgba(0,0,0,0.45);
      animation: fadeInPopup 0.7s ease;
    }

    @keyframes fadeInPopup {
      from { opacity: 0; transform: translateY(-45%); }
      to { opacity: 1; transform: translateY(-50%); }
    }

    .register-container h2 {
      color: #151515;
      margin-bottom: 15px;
      font-weight: 600;
      letter-spacing: 1px;
      position: relative;
    }

    .register-container h2::after {
      content: "";
      display: block;
      width: 60%;
      margin: 10px auto 0 auto;
      height: 2px;
      background: linear-gradient(to right, transparent, #F7CC51, transparent);
      opacity: 0.9;
    }

    .register-container img {
      width: 190px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 12px;
      position: relative;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 12px 12px 40px;
      border: 1.8px solid rgba(255,255,255,0.55);
      border-radius: 8px;
      outline: none;
      font-size: 14px;

      color: #fff;
      background: rgba(0,0,0,0.35);
      backdrop-filter: blur(5px);

      /* Hilangkan panah bawaan */
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
    }

    .form-group input::placeholder {
      color: #fff;
      font-weight: 500;
      text-shadow: 0 0 6px rgba(0,0,0,0.6);
    }

    .form-group .icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 17px;
      color: #FFD76A;
      font-weight: 700;
      text-shadow:
        0 0 3px rgba(0,0,0,1),
        0 0 5px rgba(0,0,0,0.9),
        0 0 7px rgba(247, 225, 56, 0.8);
    }

    /* Panah custom FA */
    .select-group::after {
      content: "\f0d7";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #FFD76A;
      font-size: 15px;
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
      color: #000;
      transition: 0.3s ease;
      box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }

    .btn-register:hover {
      background: #e7bd47;
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.35);
    }

    .login-link {
      margin-top: 18px;
      font-size: 14px;
      color: #ddd;
    }

    .login-link a {
      color: #F7CC51;
      font-weight: 600;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="background"></div>
  <div class="overlay"></div>
  <div class="spotlight"></div>

  <div class="register-container">
    <h2>Register</h2>
    <img src="{{ asset('images/rby-logo3.jpg') }}" alt="RBY Logo">

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
          <option disabled selected>Pilih Divisi</option>
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

      <button class="btn-register" type="submit">Daftar</button>
    </form>

    <p class="login-link">
      Sudah punya akun?
      <a href="{{ route('login') }}">Login</a>
    </p>
  </div>

</body>
</html>
