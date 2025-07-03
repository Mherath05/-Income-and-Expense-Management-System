<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Income & Expense Manager</title>
    
   
    @vite(['resources/css/auth-styles.css'])
    
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>


<div class="page-selector">
    <a href="{{ route('login') }}" class="nav-btn" id="login-btn">Login</a>
    <a href="{{ route('register') }}" class="nav-btn" id="register-btn">Register</a>
    <a href="{{ route('password.reset', ['token' => 'demo']) }}" class="nav-btn" id="reset-btn">Reset Password</a>
</div>


<div id="reset-page" class="auth-container active">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo-container">
                    <i class="fas fa-wallet logo-icon"></i>
                    <h1 class="app-title">ExpenseManager</h1>
                </div>
                <h2 class="auth-title">Reset Password</h2>
                <p class="auth-subtitle">Set a new password for your account</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="auth-form" id="resetForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token ?? '' }}">

                <div class="form-group">
                    <label for="reset-email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="reset-email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
                    </div>
                    @error('email') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div> 
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reset-password">New Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="reset-password" name="password" placeholder="Enter new password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('reset-password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div> 
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reset-confirm-password">Confirm New Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="reset-confirm-password" name="password_confirmation" placeholder="Confirm new password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('reset-confirm-password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="auth-btn primary">
                    <i class="fas fa-rotate-right"></i>
                    Reset Password
                </button>

                <div class="auth-footer">
                    <p>Remember your password? <a href="{{ route('login') }}">Back to Login</a></p>
                </div>
            </form>
        </div>
    </div>
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

</body>
</html>