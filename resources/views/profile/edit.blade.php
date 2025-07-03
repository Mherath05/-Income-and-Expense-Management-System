@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<h1>Edit Profile</h1>

<div style="max-width: 600px; margin: 0 auto;">
    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        
        <!-- Profile Avatar -->
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 24px; margin: 0 auto 15px;">
                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
            </div>
            <h2 style="margin: 0; color: #333;">Edit Your Profile</h2>
        </div>

        <!-- Edit Form -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', Auth::user()->name) }}" 
                       required>
                @error('name')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', Auth::user()->email) }}" 
                       required>
                @error('email')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                <button type="submit" class="btn" style="margin-right: 10px; background-color: #28a745; color: white; padding: 10px 20px;">
                    Update Profile
                </button>
                <a href="{{ route('profile') }}" class="btn" style="background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection