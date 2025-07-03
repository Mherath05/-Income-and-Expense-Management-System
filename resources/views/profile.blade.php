@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="margin-bottom: 2rem; color: #333;">My Profile</h1>

    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold;">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h2 style="margin: 0; color: #333;">{{ Auth::user()->name }}</h2>
                <p style="margin: 0.5rem 0 0 0; color: #666;">{{ Auth::user()->email }}</p>
                <p style="margin: 0.5rem 0 0 0; color: #999; font-size: 0.9rem;">
                    Member since {{ Auth::user()->created_at->format('M Y') }}
                </p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1.5rem;">
            <div style="text-align: center; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 1.5rem; font-weight: bold; color: #28a745;">{{ $stats['totalTransactions'] ?? 0 }}</div>
                <div style="color: #666; font-size: 0.9rem;">Total Transactions</div>
            </div>
            <div style="text-align: center; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 1.5rem; font-weight: bold; color: #17a2b8;">{{ $stats['totalCategories'] ?? 0 }}</div>
                <div style="color: #666; font-size: 0.9rem;">Categories Created</div>
            </div>
            <div style="text-align: center; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 1.5rem; font-weight: bold; color: #6f42c1;">{{ $stats['daysSinceJoined'] ?? 0 }}</div>
                <div style="color: #666; font-size: 0.9rem;">Days Active</div>
            </div>
        </div>
    </div>

    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h3 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #eee; padding-bottom: 0.5rem;">Edit Profile</h3>
        
        <form method="POST" action="{{ route('profile.update') }}" style="max-width: 500px;">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" style="font-weight: 600; color: #333;">Full Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', Auth::user()->name) }}" 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;"
                       required>
                @error('name')
                    <span style="color: #dc3545; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" style="font-weight: 600; color: #333;">Email Address</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', Auth::user()->email) }}" 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;"
                       required>
                @error('email')
                    <span style="color: #dc3545; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button type="submit" 
                        style="background: #007bff; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; transition: background 0.3s ease;"
                        onmouseover="this.style.background='#0056b3'" 
                        onmouseout="this.style.background='#007bff'">
                    <i class="fas fa-save" style="margin-right: 0.5rem;"></i>
                    Update Profile
                </button>
                <a href="{{ route('dashboard') }}" 
                   style="background: #6c757d; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-size: 1rem; text-decoration: none; transition: background 0.3s ease;"
                   onmouseover="this.style.background='#5a6268'" 
                   onmouseout="this.style.background='#6c757d'">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #eee; padding-bottom: 0.5rem;">Account Actions</h3>
        
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('transactions.index') }}" 
               style="background: #17a2b8; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; transition: background 0.3s ease;"
               onmouseover="this.style.background='#138496'" 
               onmouseout="this.style.background='#17a2b8'">
                <i class="fas fa-list" style="margin-right: 0.5rem;"></i>
                View All Transactions
            </a>
            
            <a href="{{ route('categories.index') }}" 
               style="background: #6610f2; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; transition: background 0.3s ease;"
               onmouseover="this.style.background='#5a0fc8'" 
               onmouseout="this.style.background='#6610f2'">
                <i class="fas fa-tags" style="margin-right: 0.5rem;"></i>
                Manage Categories
            </a>
            
            <a href="{{ route('dashboard') }}" 
               style="background: #fd7e14; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; transition: background 0.3s ease;"
               onmouseover="this.style.background='#e8681a'" 
               onmouseout="this.style.background='#fd7e14'">
                <i class="fas fa-chart-line" style="margin-right: 0.5rem;"></i>
                View Dashboard
            </a>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.form-group input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    
    div[style*="max-width: 800px"] {
        max-width: 100% !important;
    }
    
    div[style*="display: grid"] {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="display: flex"] {
        flex-direction: column !important;
        gap: 0.5rem !important;
    }
}
</style>
@endsection