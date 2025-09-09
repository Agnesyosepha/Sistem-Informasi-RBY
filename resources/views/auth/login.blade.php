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
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .login-container {
        background: #000;
        padding: 40px 25px;   
        border-radius: 12px;
        width: 320px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
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
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Login</h2>
    <img src="{{ asset('images/rby-logo.png') }}" alt="RBY Logo">
    
    <!-- autocomplete dimatikan -->
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

      <!-- Error umum (misalnya username / password salah) -->
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

</body>
</html>
