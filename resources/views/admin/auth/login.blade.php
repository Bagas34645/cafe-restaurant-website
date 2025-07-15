<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - Cafe Restaurant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      padding: 2.5rem;
      max-width: 400px;
      width: 100%;
      margin: 20px;
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-header i {
      font-size: 3rem;
      color: #667eea;
      margin-bottom: 1rem;
    }

    .login-header h2 {
      color: #333;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .login-header p {
      color: #666;
      font-size: 0.9rem;
    }

    .form-floating>label {
      color: #666;
    }

    .form-control {
      border: 2px solid #e9ecef;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-login {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .alert {
      border-radius: 10px;
      border: none;
    }

    .back-to-home {
      text-align: center;
      margin-top: 1.5rem;
    }

    .back-to-home a {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .back-to-home a:hover {
      color: #764ba2;
    }

    .form-check-input:checked {
      background-color: #667eea;
      border-color: #667eea;
    }

    .form-check-input:focus {
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-header">
      <i class="fas fa-user-shield"></i>
      <h2>Admin Login</h2>
      <p>Masuk ke panel admin cafe restaurant</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle me-2"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fas fa-exclamation-triangle me-2"></i>
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
      @csrf

      <div class="form-floating mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror"
          id="email" name="email" placeholder="name@example.com"
          value="{{ old('email') }}" required autofocus>
        <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
        @error('email')
        <div class="invalid-feedback">
          <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror"
          id="password" name="password" placeholder="Password" required>
        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
        @error('password')
        <div class="invalid-feedback">
          <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">
          Ingat saya
        </label>
      </div>

      <button type="submit" class="btn btn-primary btn-login w-100">
        <i class="fas fa-sign-in-alt me-2"></i>Login
      </button>
    </form>

    <div class="back-to-home">
      <a href="{{ route('home') }}">
        <i class="fas fa-arrow-left me-1"></i>
        Kembali ke Beranda
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>