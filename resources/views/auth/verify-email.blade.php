<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Income & Expense Manager</title>
    
  
    @vite(['resources/css/auth-styles.css'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>


<div class="page-selector">
    <a href="{{ route('login') }}" class="nav-btn" id="login-btn">Login</a>
    <a href="{{ route('register') }}" class="nav-btn" id="register-btn">Register</a>
    <a href="#" class="nav-btn active" id="verify-btn">Verify Email</a>
</div>


<div id="verify-page" class="auth-container active">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo-container">
                    <i class="fas fa-wallet logo-icon"></i>
                    <h1 class="app-title">ExpenseManager</h1>
                </div>
                <div class="verification-icon">
                    <i class="fas fa-envelope-circle-check"></i>
                </div>
                <h2 class="auth-title">Verify Your Email</h2>
                <p class="auth-subtitle">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
            </div>

         
            @if (session('status') == 'verification-link-sent')
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif

            <div class="verification-actions">
                
                <form method="POST" action="{{ route('verification.send') }}" class="auth-form">
                    @csrf
                    <button type="submit" class="auth-btn primary">
                        <i class="fas fa-paper-plane"></i>
                        Resend Verification Email
                    </button>
                </form>

                <div class="divider">
                    <span>or</span>
                </div>

                
                <form method="POST" action="{{ route('logout') }}" class="auth-form">
                    @csrf
                    <button type="submit" class="auth-btn secondary">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </button>
                </form>
            </div>

            <div class="auth-footer">
                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <p>If you didn't receive the email, please check your spam folder or click "Resend Verification Email" above.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>