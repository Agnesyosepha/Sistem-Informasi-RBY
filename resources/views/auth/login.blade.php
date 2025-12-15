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
      background: #000;
    }

    /* ===== Background utama (jernih, tidak blur) ===== */
    .background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: url("{{ asset('images/home.jpg') }}") center/cover no-repeat;
      z-index: 0;
    }

    /* ===== Overlay premium (soft gold + blur tipis) ===== */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: linear-gradient(
        rgba(247, 204, 81, 0.18),
        rgba(247, 204, 81, 0.05)
      );
      backdrop-filter: blur(2px); 
      z-index: 1;
    }

    /* ===== Spotlight agar fokus ke popup ===== */
    .spotlight {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: radial-gradient(
        circle at center,
        rgba(255, 255, 255, 0.25) 0%,
        rgba(0,0,0,0.65) 100%
      );
      opacity: 0.35;
      z-index: 1.5;
    }

    /* ===== Popup Login (Glassmorphism premium) ===== */
    .login-container {
    position: relative;
    z-index: 3;
    width: 330px;
    padding: 35px 28px;
    margin: auto;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;

    background: rgba(255, 255, 255, 0.18); /* lebih terang */
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);

    border-radius: 14px;

    /* PERUBAHAN utama — GARIS emas lebih jelas */
    border: 2px solid rgba(247, 204, 81, 0.7);

    box-shadow: 0 10px 28px rgba(0,0,0,0.45);
    animation: fadeInPopup 0.7s ease;
  }

    @keyframes fadeInPopup {
      from { opacity: 0; transform: translateY(-45%); }
      to { opacity: 1; transform: translateY(-50%); }
    }

    .login-container h2 {
       color: #151515;;
      margin-bottom: 15px;
      font-weight: 600;
      letter-spacing: 1px;
      position: relative;
    }

    .login-container h2::after {
      content: "";
      display: block;
      width: 60%;
      margin: 10px auto 0 auto;
      height: 2px;
      background: linear-gradient(to right, transparent, #101010, transparent);
      opacity: 0.9;
    }
    .login-container img {
      width: 190px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 12px;
      position: relative;
    }

    .form-group input {
       width: 100%;
      padding: 12px 12px 12px 40px;
      border: 1.8px solid rgba(255,255,255,0.55);
      border-radius: 8px;
      outline: none;
      font-size: 14px;

      color: #fff; /* teks putih lebih kontras */
      background: rgba(0,0,0,0.35);  /* lebih gelap → tulisan lebih jelas */
      backdrop-filter: blur(5px);
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

    .error-text {
      font-size: 12px;
      color: #ff6d6d;
      margin: 5px 0 10px 3px;
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
      transition: 0.3s ease;
      color: #000;
      box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }

    .btn-login:hover {
      background: #e7bd47;
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.35);
    }

    .register-link {
      margin-top: 18px;
      font-size: 14px;
      color: #ddd;
    }

    .register-link a {
      color: #F7CC51;
      font-weight: 600;
      text-decoration: none;
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
      background-color: rgba(247, 204, 81, 0.2);
      color: #F7CC51;
      border: 1px solid #F7CC51;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
      animation: fadeIn 0.8s ease-in-out;
      backdrop-filter: blur(4px);
    }
  </style>
</head>

<body>
  <div class="background"></div>
  <div class="overlay"></div>
  <div class="spotlight"></div>

  <div class="login-container">

    @if (session('success'))
      <div class="alert-success" id="success-alert">
        <i class="fa-solid fa-circle-check" style="margin-right:6px;"></i>
        {{ session('success') }}
      </div>
    @endif

    <h2>Login</h2>
    <img src="{{ asset('images/rby-logo3.jpg') }}" alt="RBY Logo">

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
    {{--
    <p class="register-link">
      Belum punya akun?
      <a href="{{ route('register') }}">Register</a>
    </p>
    --}}
  </div>


  <script>
    const alertBox = document.getElementById('success-alert');
    if (alertBox) {
      setTimeout(() => {
        alertBox.style.animation = 'fadeOut 0.8s ease-in-out forwards';
        setTimeout(() => alertBox.remove(), 800);
      }, 3500);
    }
  </script>

</body>
</html>
