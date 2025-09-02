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
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .register-container {
        background: #000;
        padding: 40px 25px;   
        border-radius: 12px;
        width: 340px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
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

    /* Hanya untuk select (dropdown) */
    .form-group.select-group {
      position: relative;
    }

    .form-group.select-group::after {
      content: "\f078"; /* caret down */
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
