<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Income & Expense Manager</title>
    
    
    @vite(['resources/css/auth-styles.css'])
    
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>


<div class="page-selector">
    <a href="{{ route('login') }}" class="nav-btn" id="login-btn">Login</a>
    <a href="{{ route('register') }}" class="nav-btn" id="register-btn">Register</a>
    <a href="{{ route('password.request') }}" class="nav-btn active" id="forgot-btn">Forgot Password</a>
</div>

<!--MY FORGOT PASSWORD PAGE -->
<div id="forgot-page" class="auth-container active">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo-container">
                    <i class="fas fa-wallet logo-icon"></i>
                    <h1 class="app-title">ExpenseManager</h1>
                </div>
                <h2 class="auth-title">Forgot Password?</h2>
                <p class="auth-subtitle">No problem. Just let us know your email address and we will email you a password reset link.</p>
            </div>

            
            @if (session('status'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="auth-form" id="forgotForm">
                @csrf

                <div class="form-group">
                    <label for="forgot-email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="forgot-email" name="email" placeholder="Enter your email address" required autofocus value="{{ old('email') }}">
                    </div>
                    @error('email') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div> 
                    @enderror
                </div>

                <button type="submit" class="auth-btn primary">
                    <i class="fas fa-paper-plane"></i>
                    Email Password Reset Link
                </button>

                <div class="auth-footer">
                    <p>Remember your password? <a href="{{ route('login') }}">Back to Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>