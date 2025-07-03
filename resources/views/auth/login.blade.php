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
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
  background-size: 400% 400%;
  animation: gradientShift 20s ease infinite;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  position: relative;
  overflow-x: hidden;
}

/* Floating particles background effect */
body::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: 
    radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
    radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
  animation: float 15s ease-in-out infinite;
  pointer-events: none;
}

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  25% { background-position: 100% 50%; }
  50% { background-position: 100% 100%; }
  75% { background-position: 0% 100%; }
  100% { background-position: 0% 50%; }
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  33% { transform: translateY(-20px) rotate(1deg); }
  66% { transform: translateY(-10px) rotate(-1deg); }
}

.main-container {
  width: 100%;
  max-width: 1200px;
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(25px);
  border-radius: 30px;
  padding: 60px;
  box-shadow: 
    0 35px 70px -15px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.3);
  border: 1px solid rgba(255, 255, 255, 0.2);
  position: relative;
  animation: containerGlow 8s ease-in-out infinite alternate;
}

@keyframes containerGlow {
  0% { box-shadow: 0 35px 70px -15px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2); }
  100% { box-shadow: 0 35px 70px -15px rgba(102, 126, 234, 0.4), 0 0 30px rgba(102, 126, 234, 0.3); }
}

.header-section {
  text-align: center;
  padding: 50px 20px 60px;
  position: relative;
}

.brand-logo {
  font-size: 3.5rem;
  font-weight: 800;
  background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 20px;
  text-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
  animation: logoFloat 6s ease-in-out infinite;
}

@keyframes logoFloat {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

.tagline {
  font-size: 1.8rem;
  margin: 25px 0;
  color: rgba(255, 255, 255, 0.95);
  font-weight: 600;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  animation: fadeInUp 1s ease-out 0.3s both;
}

.header-section p {
  font-size: 1.1rem !important;
  color: rgba(255, 255, 255, 0.8) !important;
  font-weight: 400;
  text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
  animation: fadeInUp 1s ease-out 0.6s both;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.content-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  animation: fadeInUp 1s ease-out 0.9s both;
}

.login-container {
  width: 100%;
  max-width: 450px;
  background: rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  padding: 45px 50px;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(255, 255, 255, 0.3),
    inset 0 1px 0 rgba(255, 255, 255, 0.4);
  border: 1px solid rgba(255, 255, 255, 0.3);
  position: relative;
  transition: all 0.4s ease;
}

.login-container:hover {
  transform: translateY(-5px);
  box-shadow: 
    0 30px 60px rgba(0, 0, 0, 0.2),
    0 0 0 1px rgba(255, 255, 255, 0.4),
    inset 0 1px 0 rgba(255, 255, 255, 0.5);
}

.login-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
  border-radius: 24px;
  pointer-events: none;
}

h2 {
  text-align: center;
  margin-bottom: 35px;
  color: rgba(255, 255, 255, 0.95);
  font-size: 1.8rem;
  font-weight: 700;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  position: relative;
}

.error {
  background: rgba(239, 68, 68, 0.9);
  color: white;
  padding: 12px 16px;
  border-radius: 12px;
  margin-bottom: 20px;
  text-align: center;
  font-weight: 500;
  box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
  animation: errorShake 0.5s ease-in-out;
}

@keyframes errorShake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-5px); }
  75% { transform: translateX(5px); }
}

label {
  font-weight: 600;
  margin-bottom: 8px;
  display: block;
  color: rgba(255, 255, 255, 0.9);
  font-size: 0.95rem;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 16px 20px;
  font-size: 1rem;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 16px;
  margin-bottom: 20px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  color: rgba(255, 255, 255, 0.95);
  transition: all 0.3s ease;
  box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1);
}

input[type="email"]::placeholder,
input[type="password"]::placeholder {
  color: rgba(255, 255, 255, 0.6);
}

input[type="email"]:focus,
input[type="password"]:focus {
  outline: none;
  border-color: rgba(255, 255, 255, 0.6);
  background: rgba(255, 255, 255, 0.3);
  box-shadow: 
    inset 0 2px 8px rgba(0, 0, 0, 0.1),
    0 0 0 4px rgba(102, 126, 234, 0.2),
    0 0 20px rgba(102, 126, 234, 0.3);
  transform: translateY(-2px);
}

button {
  width: 100%;
  padding: 18px;
  background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
  background-size: 200% 200%;
  border: none;
  color: white;
  font-size: 1.1rem;
  font-weight: 700;
  border-radius: 16px;
  cursor: pointer;
  transition: all 0.4s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
  box-shadow: 
    0 10px 25px rgba(102, 126, 234, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.2);
  position: relative;
  overflow: hidden;
}

button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

button:hover {
  transform: translateY(-3px);
  box-shadow: 
    0 15px 35px rgba(102, 126, 234, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.3);
  background-position: 100% 0;
  animation: buttonPulse 2s infinite;
}

button:hover::before {
  left: 100%;
}

button:active {
  transform: translateY(-1px);
}

@keyframes buttonPulse {
  0%, 100% { box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5); }
  50% { box-shadow: 0 15px 35px rgba(102, 126, 234, 0.7); }
}

.google-login {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  background: rgba(255, 255, 255, 0.95);
  color: #333;
  padding: 16px;
  margin-top: 20px;
  border-radius: 16px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 
    0 8px 20px rgba(0, 0, 0, 0.1),
    0 0 0 1px rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.4);
}

.google-login:hover {
  background: rgba(255, 255, 255, 1);
  transform: translateY(-2px);
  box-shadow: 
    0 12px 30px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(255, 255, 255, 0.5);
  color: #1a1a1a;
}

.signup-link {
  text-align: center;
  font-size: 1rem;
  margin-top: 25px;
  color: rgba(255, 255, 255, 0.8);
  animation: fadeInUp 1s ease-out 1.2s both;
}

.signup-link a {
  color: rgba(255, 255, 255, 0.95);
  text-decoration: none;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.signup-link a:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  border-color: rgba(255, 255, 255, 0.4);
}

.footer-info {
  text-align: center;
  font-size: 0.85rem;
  color: rgba(255, 255, 255, 0.6);
  margin-top: 20px;
  font-weight: 500;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
  .main-container {
    padding: 30px 20px;
    border-radius: 20px;
    margin: 10px;
  }

  .header-section {
    padding: 30px 15px 40px;
  }

  .brand-logo {
    font-size: 2.5rem;
  }

  .tagline {
    font-size: 1.4rem;
  }

  .header-section p {
    font-size: 1rem !important;
  }

  .login-container {
    padding: 30px 25px;
    border-radius: 20px;
    max-width: 400px;
  }

  h2 {
    font-size: 1.5rem;
    margin-bottom: 25px;
  }

  input[type="email"],
  input[type="password"] {
    padding: 14px 16px;
    font-size: 0.95rem;
    border-radius: 12px;
  }

  button,
  .google-login {
    font-size: 1rem;
    padding: 14px;
    border-radius: 12px;
  }

  .signup-link {
    font-size: 0.9rem;
  }
}

@media (max-width: 480px) {
  body {
    padding: 10px;
  }

  .main-container {
    padding: 20px 15px;
    border-radius: 16px;
  }

  .header-section {
    padding: 20px 10px 30px;
  }

  .brand-logo {
    font-size: 2rem;
  }

  .tagline {
    font-size: 1.2rem;
    margin: 15px 0;
  }

  .login-container {
    padding: 25px 20px;
    border-radius: 16px;
  }

  h2 {
    font-size: 1.3rem;
  }

  input[type="email"],
  input[type="password"] {
    padding: 12px 14px;
    font-size: 0.9rem;
    margin-bottom: 15px;
  }

  button {
    padding: 12px;
    font-size: 0.9rem;
  }

  .google-login {
    padding: 12px;
    font-size: 0.9rem;
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
