<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - RBY</title>
  
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

    /* ===== Popup Login ===== */
    .login-container {
      position: relative;
      z-index: 2;
      background: #000;
      padding: 40px 25px;
      border-radius: 12px;
      width: 320px;
      text-align: center;
      box-shadow: 0 4px 14px rgba(0,0,0,0.4);
      margin: auto;
      top: 50%;
      transform: translateY(-50%);
      border: 2px solid transparent;
      background-clip: padding-box;
    }

    /* Border gradient keemasan */
    .login-container::before {
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

    .login-container h2 {
      color: #fff;
      margin-bottom: 15px;
      font-weight: 600;
    }

    .login-container img {
      width: 200px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 10px;
      position: relative;
    }

    .form-group input {
      width: 100%;
      padding: 12px 12px 12px 40px;
      border: 1px solid #ddd;
      border-radius: 8px;
      outline: none;
      font-size: 14px;
      box-sizing: border-box; 
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
      pointer-events: none;
    }

    .error-text {
      font-size: 12px;
      color: red;
      margin: 5px 0 10px 5px;
      text-align: left;
    }

    .btn-login {
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

    .btn-login:hover {
      background: #e6b842;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }

    .register-link {
      margin-top: 18px;
      font-size: 14px;
      color: #ccc;
    }

    .register-link a {
      color: #F7CC51;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.2s;
    }

    .register-link a:hover {
      color: #e6b842;
    }

    /* Animasi notifikasi */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeOut {
      from { opacity: 1; transform: translateY(0); }
      to { opacity: 0; transform: translateY(-10px); }
    }

    .alert-success {
      background-color: rgba(247, 204, 81, 0.15);
      color: #F7CC51;
      border: 1px solid #F7CC51;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
    }
  </style>
</head>

<body>
  <!-- Background dan overlay -->
  <div class="background"></div>
  <div class="overlay"></div>

  <!-- Popup login -->
  <div class="login-container">

    {{-- ✅ Notifikasi sukses setelah registrasi --}}
    @if (session('success'))
      <div class="alert-success" id="success-alert">
        <i class="fa-solid fa-circle-check" style="margin-right:6px;"></i>
        {{ session('success') }}
      </div>
    @endif

    <h2>Login</h2>
    <img src="{{ asset('images/rby-logo.png') }}" alt="RBY Logo">
    
    <form method="POST" action="{{ route('login') }}" autocomplete="off">
      @csrf

      <div class="form-group">
        <span class="icon"><i class="fa-solid fa-user"></i></span>
        <input type="text" name="username" placeholder="Username" required autocomplete="off">
      </div>
      @if ($errors->has('username'))
        <p class="error-text">{{ $errors->first('username') }}</p>
      @endif

      <div class="form-group">
        <span class="icon"><i class="fa-solid fa-lock"></i></span>
        <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
      </div>
      @if ($errors->has('password'))
        <p class="error-text">{{ $errors->first('password') }}</p>
      @endif

      @if(session('error'))
        <p class="error-text">{{ session('error') }}</p>
      @endif

      <button type="submit" class="btn-login">Masuk</button>
    </form>

    <p style="margin-top:15px; color:#fff; font-size:14px;">
      Belum punya akun?
      <a href="{{ route('register') }}" style="color:#F7CC51; font-weight:600;">Register</a>
    </p>
  </div>

  <!-- Script untuk auto-hide notifikasi -->
  <script>
    const alertBox = document.getElementById('success-alert');
    if (alertBox) {
      setTimeout(() => {
        alertBox.style.animation = 'fadeOut 0.8s ease-in-out forwards';
        setTimeout(() => alertBox.remove(), 800);
      }, 4000); // hilang setelah 4 detik
    }
  </script>
</body>
</html>
