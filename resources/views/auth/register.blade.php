<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register - Focus To Do</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
      min-height: 100vh;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background: #ffffff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
      font-size: 1.5rem;
      font-weight: bold;
      color: #667eea;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .logo-icon {
      width: 30px;
      height: 30px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
    }

    .nav-buttons {
      display: flex;
      gap: 1rem;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
      font-size: 0.9rem;
      text-decoration: none;
    }

    .btn-outline {
      background: transparent;
      color: #667eea;
      border: 2px solid #667eea;
    }

    .btn-outline:hover {
      background: #667eea;
      color: white;
    }

    .btn-primary {
      background: #4CAF50;
      color: white;
    }

    .btn-primary:hover {
      background: #45a049;
    }

    .register-container {
      max-width: 400px;
      margin: 80px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #444;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 14px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background: #f9f9f9;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #4CAF50;
      border: none;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background: #45a049;
    }

    .error {
      color: red;
      margin-bottom: 10px;
      font-size: 14px;
      text-align: center;
    }

    .footer {
      margin-top: 15px;
      text-align: center;
      font-size: 13px;
      color: #999;
    }

    /* RESPONSIF KHUSUS UNTUK HP */
    @media (max-width: 600px) {
      .header {
        flex-direction: column;
        padding: 15px 20px;
        text-align: center;
      }

      .logo {
        margin-bottom: 10px;
        font-size: 1.2rem;
      }

      .logo-icon {
        width: 26px;
        height: 26px;
        font-size: 0.9rem;
      }

      .nav-buttons {
        flex-direction: column;
        gap: 0.5rem;
        width: 100%;
      }

      .btn {
        width: 100%;
        font-size: 0.85rem;
        padding: 10px;
      }

      .register-container {
        margin: 40px 15px;
        padding: 20px;
        border-radius: 10px;
      }

      h2 {
        font-size: 1.3rem;
        margin-bottom: 20px;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"] {
        padding: 8px 10px;
        font-size: 0.9rem;
      }

      button {
        padding: 10px;
        font-size: 0.95rem;
      }

      .footer {
        font-size: 12px;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
<div class="header">
  <div class="logo">
    <div class="logo-icon">F</div>
    Focus To Do
  </div>
  <div class="nav-buttons">
    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
    <a href="#" class="btn btn-primary">Sign Up</a>
  </div>
</div>

<!-- Register Form -->
<div class="register-container">
  <h2>Register</h2>

  @if ($errors->any())
    <div class="error">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">Nama Lengkap:</label>
    <input type="text" id="name" name="name" required value="{{ old('name') }}">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required value="{{ old('email') }}">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="password_confirmation">Konfirmasi Password:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>

    <button type="submit">Daftar</button>
  </form>

  <div class="footer">
    Sudah punya akun? <a href="{{ route('login') }}">Login</a><br>
    © 2025 Focus To Do
  </div>
</div>

</body>
</html>
