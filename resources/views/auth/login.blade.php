<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Focus To Do</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .main-container {
      width: 100%;
      max-width: 1000px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 40px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .header-section {
      text-align: center;
      padding: 40px 20px;
    }

    .brand-logo {
      font-size: 2rem;
      font-weight: bold;
    }

    .tagline {
      font-size: 1.5rem;
      margin: 20px 0;
    }

    .content-section {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .login-container {
      width: 100%;
      max-width: 400px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 12px;
      padding: 30px 40px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    label {
      font-weight: 600;
      margin-bottom: 6px;
      display: block;
      color: #374151;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 14px 18px;
      font-size: 1rem;
      border: 2px solid rgba(107, 114, 128, 0.2);
      border-radius: 12px;
      margin-bottom: 15px;
      background: rgba(255, 255, 255, 0.8);
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      outline: none;
      border-color: #667eea;
      background: rgba(255, 255, 255, 0.95);
    }

    button {
      width: 100%;
      padding: 16px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border: none;
      color: white;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 35px -10px rgba(102, 126, 234, 0.6);
    }

    .google-login {
      display: block;
      text-align: center;
      background: #4285F4;
      color: white;
      padding: 10px;
      margin-top: 15px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
    }

    .google-login:hover {
      background: #357ae8;
    }

    .signup-link {
      text-align: center;
      font-size: 0.9rem;
      margin-top: 10px;
    }

    .signup-link a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }

    .footer-info {
      text-align: center;
      font-size: 0.75rem;
      color: #6b7280;
      margin-top: 12px;
    }

    /* KHUSUS UNTUK HP (max 600px) */
    @media (max-width: 600px) {
      .main-container {
        padding: 20px 15px;
        border-radius: 16px;
      }

      .login-container {
        padding: 20px;
        border-radius: 10px;
      }

      .brand-logo {
        font-size: 1.4rem;
      }

      .tagline {
        font-size: 1.1rem;
      }

      h2 {
        font-size: 1.1rem;
        margin-bottom: 20px;
      }

      input[type="email"],
      input[type="password"] {
        padding: 10px 14px;
        font-size: 0.9rem;
      }

      button,
      .google-login {
        font-size: 0.95rem;
        padding: 12px;
      }

      .signup-link,
      .footer-info {
        font-size: 0.8rem;
      }
    }
  </style>
</head>
<body>

  <div class="main-container">
    <div class="header-section">
      <div class="brand-logo">Focus To Do</div>
      <h2 class="tagline">Stay Focused, Get Things Done</h2>
      <p style="font-size: 0.9rem;">Transform your productivity with our intuitive to-do list app.</p>
    </div>

    <div class="content-section">
      <div class="login-container">
        <h2>Login</h2>

        @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required autofocus value="{{ old('email') }}">

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>

          <button type="submit">Login</button>
        </form>

        <a href="{{ route('google.login') }}" class="google-login">🔐 Login dengan Google</a>

        <div class="footer-info">© 2025 Focus To Do</div>
      </div>

      <div class="signup-link">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
      </div>
    </div>
  </div>

</body>
</html>
