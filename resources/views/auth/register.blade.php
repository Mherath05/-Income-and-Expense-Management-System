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
    <a href="{{ route('login') }}" class="nav-btn" id="login-btn">Login</a>
    <a href="{{ route('register') }}" class="nav-btn active" id="register-btn">Register</a>
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

<script>

document.addEventListener('DOMContentLoaded', function() {

    function checkPasswordStrength(password) {
        let strength = 0;
        let feedback = '';
        
       
        if (password.length >= 8) strength += 25;
        
        
        if (/[a-z]/.test(password)) strength += 25;
        
        
        if (/[A-Z]/.test(password)) strength += 25;
        
        
        if (/[\d\W]/.test(password)) strength += 25;
        
        
        if (strength <= 25) {
            feedback = 'Weak';
            return { strength, feedback, color: '#ff4757' };
        } else if (strength <= 50) {
            feedback = 'Fair';
            return { strength, feedback, color: '#ffa502' };
        } else if (strength <= 75) {
            feedback = 'Good';
            return { strength, feedback, color: '#3742fa' };
        } else {
            feedback = 'Strong';
            return { strength, feedback, color: '#2ed573' };
        }
    }

    
    const passwordInput = document.getElementById('register-password');
    const strengthBar = document.querySelector('.strength-fill');
    const strengthText = document.querySelector('.strength-text');
    
    if (passwordInput && strengthBar && strengthText) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            if (password.length === 0) {
                strengthBar.style.width = '0%';
                strengthBar.style.backgroundColor = '#ff4757';
                strengthText.textContent = 'Password strength';
                return;
            }
            
            const result = checkPasswordStrength(password);
            strengthBar.style.width = result.strength + '%';
            strengthBar.style.backgroundColor = result.color;
            strengthText.textContent = result.feedback;
        });
    }
});
</script>
    
<div id="register-page" class="auth-container active">

        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="logo-container">
                        <i class="fas fa-wallet logo-icon"></i>
                        <h1 class="app-title">ExpenseManager</h1>
                    </div>
                    <h2 class="auth-title">Create Account</h2>
                    <p class="auth-subtitle">Start managing your finances today</p>
                </div>

                <form class="auth-form" id="registerForm" method="POST" action="{{ route('register') }}">
    @csrf

                    <div class="form-group">
                        <label for="register-name">Full Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="register-name" name="name" placeholder="Enter your full name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="register-email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="register-password" name="password" placeholder="Create a password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('register-password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-fill"></div>
                            </div>
                            <span class="strength-text">Password strength</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-confirm-password">Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="register-confirm-password" name="password_confirmation" placeholder="Confirm your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('register-confirm-password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" name="terms" required>
                            <span class="checkmark"></span>
                            I agree to the <a href="#" class="terms-link">Terms & Conditions</a>
                        </label>
                    </div>

                    <button type="submit" class="auth-btn primary">
                        <i class="fas fa-user-plus"></i>
                        Create Account
                    </button>

                    <div class="auth-footer">
                        <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>