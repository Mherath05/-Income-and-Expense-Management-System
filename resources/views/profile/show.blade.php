@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="margin-bottom: 2rem; color: #333;">Profile Settings</h1>

    <!-- Profile Information Card -->
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #f0f0f0; padding-bottom: 0.5rem;">
            Profile Information
        </h2>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div style="color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div style="color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-success">Update Profile</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="margin-left: 10px;">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Password Update Card -->
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #f0f0f0; padding-bottom: 0.5rem;">
            Change Password
        </h2>

        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" required>
                @error('current_password')
                    <div style="color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div style="color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-danger">Update Password</button>
            </div>
        </form>
    </div>

    <!-- Account Information Card -->
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #f0f0f0; padding-bottom: 0.5rem;">
            Account Information
        </h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
            <div>
                <strong style="color: #666;">Member Since:</strong>
                <p style="margin: 0.5rem 0; color: #333;">{{ $user->created_at->format('F j, Y') }}</p>
            </div>
            <div>
                <strong style="color: #666;">Last Updated:</strong>
                <p style="margin: 0.5rem 0; color: #333;">{{ $user->updated_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
        </div>
    </div>
</div>

<style>
/* Additional styles for the profile page */
.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="password"] {
    padding: 12px;
    font-size: 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    transition: border-color 0.3s ease;
}

.form-group input[type="text"]:focus,
.form-group input[type="email"]:focus,
.form-group input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.btn {
    padding: 12px 24px;
    font-size: 1rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .container {
        margin: 0 10px;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
}
</style>
@endsection