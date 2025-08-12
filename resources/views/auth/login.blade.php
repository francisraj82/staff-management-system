<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Francis Raj's Staff Management</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0056b3;
            --secondary-color: #6c757d;
            --accent-color: #ff6b00;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            margin: 20px;
        }
        
        .login-left {
            background: linear-gradient(135deg, #0056b3 0%, #003366 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        
        .login-right {
            padding: 60px 40px;
        }
        
        .login-logo {
            font-size: 4rem;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .login-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .login-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            text-align: left;
        }
        
        .feature-list li {
            padding: 8px 0;
            opacity: 0.9;
        }
        
        .feature-list i {
            color: var(--accent-color);
            margin-right: 10px;
            width: 20px;
        }
        
        .form-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .form-subtitle {
            color: var(--secondary-color);
            margin-bottom: 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 15px;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.15);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, #003366 100%);
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.4);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }
        
        .demo-credentials {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            text-align: center;
            border-left: 4px solid var(--accent-color);
        }
        
        .demo-credentials h6 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        .demo-credentials p {
            margin: 5px 0;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
            
            .login-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="row g-0">
            <div class="col-lg-6 login-left">
                <div class="login-logo">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <h2 class="login-title">Staff Management System</h2>
                <p class="login-subtitle">Professional workforce management solution</p>
                
                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill"></i> Employee Database Management</li>
                    <li><i class="bi bi-check-circle-fill"></i> Professional Interface</li>                    
                </ul>
                
                <div class="mt-4">
                    <small class="opacity-75">
                        <i class="bi bi-code-slash me-1"></i> 
                        Developed by Francis Raj S R
                    </small>
                </div>
            </div>

            <div class="col-lg-6 login-right">
                <h3 class="form-title">Welcome Back!</h3>
                <p class="form-subtitle">Please sign in to your account</p>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" placeholder="name@example.com" 
                               value="{{ old('email') }}"  autocomplete="off" required>
                        <label for="email"><i class="bi bi-envelope me-2"></i>Email Address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Password"  autocomplete="off" required>
                        <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                    </button>
                </form>                

                <div class="demo-credentials">
                    <h6><i class="bi bi-info-circle me-2"></i>Demo Login Credentials</h6>
                    <p><strong>Email:</strong> admin@francisraj.com</p>
                    <p><strong>Password:</strong> password123</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>