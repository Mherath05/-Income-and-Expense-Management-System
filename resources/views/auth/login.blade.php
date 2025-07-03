<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Income & Expense Manager</title>
    
    
    @vite(['resources/css/auth-styles.css'])
    
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    

    <div class="page-selector">
    <a href="{{ route('login') }}" class="nav-btn active" id="login-btn">Login</a>
    <a href="{{ route('register') }}" class="nav-btn" id="register-btn">Register</a>
    <!-- <a href="{{ route('password.reset', ['token' => 'demo']) }}" class="nav-btn" id="reset-btn">Reset Password</a> -->
</div>

<script>

function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = passwordInput.parentElement.querySelector('.password-toggle i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>

   
    <div id="login-page" class="auth-container active">
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="logo-container">
                        <i class="fas fa-wallet logo-icon"></i>
                        <h1 class="app-title">ExpenseManager</h1>
                    </div>
                    <h2 class="auth-title">Welcome Back</h2>
                    <p class="auth-subtitle">Sign in to manage your finances</p>
                </div>

@if(session('status'))
    <div class="alert success-message">
        <i class="fas fa-check-circle"></i> {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert error-message">
        <i class="fas fa-exclamation-circle"></i>
        {{ $errors->first('email') }}
    </div>
@endif


                <form class="auth-form" id="loginForm" method="POST" action="{{ route('login') }}">
    @csrf

                    <div class="form-group">
                        <label for="login-email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="login-email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('login-password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="auth-btn primary">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>

                    <div class="auth-footer">
                        <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>


    