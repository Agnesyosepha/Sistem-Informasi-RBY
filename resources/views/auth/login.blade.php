<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RBY</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #fff;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: #000;
            padding: 40px;
            border-radius: 6px;
            width: 320px;
            text-align: center;
        }

        .login-container h2 {
            color: #fff;
            margin-bottom: 20px;
        }

        .login-container img {
            width: 150px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px 35px 10px 10px;
            border: none;
            border-radius: 5px;
            outline: none;
        }

        .form-group .icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #333;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background: #e6c465; /* warna emas */
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #d4b24d;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <img src="{{ asset('images/rby-logo.png') }}" alt="RBY Logo"> <!-- Ganti dengan path logo -->
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
                <span class="icon">👤</span>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
                <span class="icon">🔒</span>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>
    </div>

</body>
</html>
