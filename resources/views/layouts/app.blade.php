<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Income & Expense Manager')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .stats { display: flex; gap: 20px; margin-bottom: 2rem; flex-wrap: wrap; }
        .stat-card { flex: 1; min-width: 200px; padding: 20px; border: 2px solid #ddd; text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .table th, .table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .table th { background: #f4f4f4; }
        .btn {  padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border: none; cursor: pointer; }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545;}
        .btn-danger:hover { background: #c82333; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ddd; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .pagination { display: flex; gap: 5px; justify-content: center; margin: 20px 0; }
        .pagination a, .pagination span { padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; }
        .pagination .current { background: #007bff; color: white; }

        body { 
        font-family: Arial, sans-serif; 
        line-height: 1.6; 
        background: #f8f9fa;
        min-height: 100vh;
        transition: background 0.3s ease;
    }

    .header { 
        background: rgba(255, 255, 255, 0.1); 
        backdrop-filter: blur(15px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding: 1rem; 
        margin-bottom: 2rem; 
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .nav { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
    }
    

    .nav-brand .brand-link {
        text-decoration: none;
        color: white;
    }


    
    .logo-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .brand-text {
        font-weight: bold;
        font-size: 1.2rem;
        color: black;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

       body.dark-mode .brand-text{
        color: #ddd;
       }
    
    .nav-links {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .nav-link { 
        text-decoration: none; 
        color: black; 
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

     body.dark-mode .nav-link{
        color: #ddd;
       }
    
    .nav-link:hover { 
        background-color: rgba(255, 255, 255, 0.3);
        text-decoration: none;
    }

    .profile-dropdown {
        position: relative;
    }
    
    .profile-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }
    
    .profile-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .profile-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        border: 2px solid rgba(0, 0, 0, 0.3);
    }

      body.dark-mode .profile-avatar{
        color: #ddd;
       }
    
    .profile-name {
        color: black;
        font-weight: 500;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    body.dark-mode .profile-name{
        color: #ddd;
       }
    
    .dropdown-arrow {
        transition: transform 0.3s ease;
    }
    
    .profile-dropdown.active .dropdown-arrow {
        transform: rotate(180deg);
    }
    
    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        min-width: 180px;
        display: none;
        z-index: 1001;
    }
    
    .dropdown-menu.show {
        display: block;
        animation: dropdownFadeIn 0.3s ease;
    }
    
    @keyframes dropdownFadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s ease;
    }
    
    .dropdown-item:hover {
        background-color: rgba(102, 126, 234, 0.2);
        text-decoration: none;
    }
    
    .dropdown-divider {
        height: 1px;
        background: rgba(0, 0, 0, 0.1);
        margin: 4px 0;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

.stat-card.income {
    background-color: #d4edda; 
    border-color: #28a745;
}

.stat-card.expense {
    background-color: #f8d7da;
    border-color: #dc3545;
}

.stat-card.balance {
    background-color: #d1ecf1; 
    border-color: #17a2b8;
}

.stat-card:nth-child(1) {
    background-color: #d4edda;
    border-color: #28a745;
}

.stat-card:nth-child(2) {
    background-color: #f8d7da;
    border-color: #dc3545;
}

.stat-card:nth-child(3) {
    background-color: #d1ecf1;
    border-color: #17a2b8;
}

.btn-view-all {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    display: inline-block;
    border: none;
    border-radius: 4px;
}

.btn-view-all:hover {
    background-color: #0815C5;
}

.btn {
    padding: 8px 16px;
    text-align: center;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s ease;
}

.btn-edit {
    background-color: #007bff;
    color: white;
    padding: 9px 25px; 
    font-size: 13px;  
}


.btn-edit:hover {
    background-color: #0056b3;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

 form .form-group {
        display: flex;
        flex-direction: column;
    }

    form label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #333;
        width: 100%;
    }

    form input[type="text"],
    form input[type="date"],
    form select {
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
        width: 100%;
        box-sizing: border-box;
    }

    form input[type="text"]:focus,
    form input[type="date"]:focus,
    form select:focus {
        border-color: #66afe9;
        outline: none;
        box-shadow: 0 0 5px rgba(102,175,233,.6);
    }

    @media (max-width: 768px) {
        .nav {
            flex-direction: column;
            gap: 15px;
        }
        
        .nav-links {
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        
        .brand-text {
            font-size: 1rem;
        }
        
        .profile-name {
            display: none;
        }
    }

    .btn-transaction {
    background-color: #28a745; 
    color: white;
}
.btn-transaction:hover {
    background-color: #218838;
}

.btn-category {
    background-color: #17a2b8;
    color: white;
}
.btn-category:hover {
    background-color: #138496;
}

.footer-nav-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    max-width: 100%;
    margin: 0 auto;
    padding: 0 10px;
}

.footer-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: #6c757d;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
    min-width: 60px;
    position: relative;
}

.footer-nav-item:hover {
    color: #007bff;
    background-color: #f8f9fa;
    text-decoration: none;
}

.footer-nav-item.active {
    color: #007bff;
    background-color: #e3f2fd;
}

.footer-nav-item.active::after {
    content: '';
    position: absolute;
    top: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 4px;
    background: #007bff;
    border-radius: 50%;
}

 .footer-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: white;
        z-index: 1000;
        border-top: 1px solid #ccc;
    }

.footer-nav-add {
    background: #007bff;
    color: white;
    border-radius: 50%;
    width: 56px;
    height: 56px;
    margin: -10px 0;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.footer-nav-add:hover {
    background: #0056b3;
    color: white;
    transform: scale(1.1);
}

.footer-nav-add .footer-nav-icon {
    width: 28px;
    height: 28px;
}

.footer-nav-add .footer-nav-text {
    font-size: 10px;
    margin-top: 2px;
}

.footer-nav-icon {
    width: 24px;
    height: 24px;
    margin-bottom: 4px;
}

.footer-nav-text {
    font-size: 12px;
    font-weight: 500;
    text-align: center;
}

body {
    padding-bottom: 80px;
}

@media (max-width: 480px) {
    .footer-nav-text {
        font-size: 10px;
    }
    
    .footer-nav-icon {
        width: 20px;
        height: 20px;
        margin-bottom: 2px;
    }
    
    .footer-nav-item {
        padding: 6px 8px;
        min-width: 50px;
    }
    
    .footer-nav-add {
        width: 48px;
        height: 48px;
    }
    
    .footer-nav-add .footer-nav-icon {
        width: 24px;
        height: 24px;
    }
}

@media (max-height: 500px) and (orientation: landscape) {
    .footer-navbar {
        display: none;
    }
    
    body {
        padding-bottom: 0;
    }
}


.dark-mode-toggle {
    background: none;
    border: none;
    color: black;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
}


.dark-mode-toggle:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.dark-mode-toggle svg {
    width: 20px;
    height: 20px;
}

body.dark-mode {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    color: #e0e0e0;
}

/* body.dark-mode .header {
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
} */

body.dark-mode .container {
    background: rgba(30, 30, 30, 0.8);
    color: #e0e0e0;
}

body.dark-mode .table th {
    background: #444;
    color: #e0e0e0;
}

body.dark-mode .table th, 
body.dark-mode .table td {
    border-bottom: 1px solid #555;
    color: #e0e0e0;
}

body.dark-mode .form-group input,
body.dark-mode .form-group select,
body.dark-mode .form-group textarea {
    background: #333;
    border-color: #555;
    color: #e0e0e0;
}

body.dark-mode .form-group label {
    color: #e0e0e0;
}

body.dark-mode .dropdown-menu {
    background: rgba(30, 30, 30, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

body.dark-mode .dropdown-item {
    color: #e0e0e0;
}

body.dark-mode .dropdown-item:hover {
    background-color: rgba(102, 126, 234, 0.3);
}

body.dark-mode .footer-navbar {
    background-color: #1a1a1a;
    border-top: 1px solid #333;
}

body.dark-mode .footer-nav-item {
    color: #888;
}

body.dark-mode .footer-nav-item:hover {
    color: #007bff;
    background-color: #2a2a2a;
}

body.dark-mode .footer-nav-item.active {
    color: #007bff;
    background-color: #2a2a2a;
}

body.dark-mode .alert-success {
    background-color: #1e3a1e;
    color: #4caf50;
    border-color: #2e5a2e;
}

body.dark-mode .alert-danger {
    background-color: #3a1e1e;
    color: #f44336;
    border-color: #5a2e2e;
}

body.dark-mode .stat-card {
    background-color: #333;
    border-color: #555;
    color: #e0e0e0;
}

body.dark-mode .stat-card:nth-child(1) {
    background-color: #1e3a1e;
    border-color: #28a745;
}

body.dark-mode .stat-card:nth-child(2) {
    background-color: #3a1e1e;
    border-color: #dc3545;
}

body.dark-mode .stat-card:nth-child(3) {
    background-color: #1e2a3a;
    border-color: #17a2b8;
}

    </style>
</head>
<body>
    <div class="header">
    <nav class="nav">
        <div class="nav-brand">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <div class="logo-container">
                    <img src="{{ asset('gfdg.png') }}" alt="Logo" width="32" height="32">
                    <span class="brand-text">Income & Expense Manager</span>
                </div>
            </a>
        </div>
        <div class="nav-links">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('categories.index') }}" class="nav-link">Categories</a>
                <a href="{{ route('transactions.index') }}" class="nav-link">Transactions</a>
                
                <button class="dark-mode-toggle" onclick="toggleDarkMode()" title="Toggle Dark Mode">
                    <svg id="sun-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
                    </svg>
                    <svg id="moon-icon" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                        <path d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                    </svg>
                </button>
                
<div class="profile-dropdown">
    <button class="profile-btn" onclick="toggleDropdown()">
        <div class="profile-avatar">
            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
        </div>
        <span class="profile-name">{{ Auth::user()->name ?? 'User' }}</span>
        <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
            <path d="M6 8L2 4h8L6 8z"/>
        </svg>
    </button>
    <div class="dropdown-menu" id="profileDropdown">
        <a href="{{ route('profile') }}" class="dropdown-item">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            </svg>
            My Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
            Logout
        </a>
    </div>
</div>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            @endauth
        </div>
    </nav>
</div>


    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('profileDropdown');
        const profileDropdown = document.querySelector('.profile-dropdown');
        
        dropdown.classList.toggle('show');
        profileDropdown.classList.toggle('active');
    }
    
    document.addEventListener('click', function(event) {
        const profileDropdown = document.querySelector('.profile-dropdown');
        const dropdown = document.getElementById('profileDropdown');
        
        if (!profileDropdown.contains(event.target)) {
            dropdown.classList.remove('show');
            profileDropdown.classList.remove('active');
        }
    });

    function toggleDarkMode() {
        const body = document.body;
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');
        
        body.classList.toggle('dark-mode');
        
        if (body.classList.contains('dark-mode')) {
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'block';
            localStorage.setItem('darkMode', 'enabled');
        } else {
            sunIcon.style.display = 'block';
            moonIcon.style.display = 'none';
            localStorage.setItem('darkMode', 'disabled');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const darkMode = localStorage.getItem('darkMode');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');
        
        if (darkMode === 'enabled') {
            document.body.classList.add('dark-mode');
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'block';
        } else {
            sunIcon.style.display = 'block';
            moonIcon.style.display = 'none';
        }
    });
</script>
<div>

<footer class="footer-navbar fixed bottom-0 left-0 w-full bg-white border-t border-gray-300 z-50">
    <div class="footer-nav-container flex justify-around items-center py-2">
        @auth
            <a href="{{ route('dashboard') }}" class="footer-nav-item flex flex-col items-center {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-600' }}">
                <svg class="footer-nav-icon w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                </svg>
                <span class="footer-nav-text text-sm">Dashboard</span>
            </a>

            <a href="{{ route('transactions.index') }}" class="footer-nav-item flex flex-col items-center {{ request()->routeIs('transactions.*') ? 'text-blue-600' : 'text-gray-600' }}">
                <svg class="footer-nav-icon w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
                <span class="footer-nav-text text-sm">Transactions</span>
            </a>

            <a href="{{ route('transactions.create') }}" class="footer-nav-item flex flex-col items-center text-blue-600">
                <svg class="footer-nav-icon w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                </svg>
                <span class="footer-nav-text text-sm">Add</span>
            </a>

            <a href="{{ route('categories.index') }}" class="footer-nav-item flex flex-col items-center {{ request()->routeIs('categories.*') ? 'text-blue-600' : 'text-gray-600' }}">
                <svg class="footer-nav-icon w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                <span class="footer-nav-text text-sm">Categories</span>
            </a>

            <a href="{{ route('profile') }}" class="footer-nav-item flex flex-col items-center {{ request()->routeIs('profile') ? 'text-blue-600' : 'text-gray-600' }}">
                <svg class="footer-nav-icon w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <span class="footer-nav-text text-sm">Profile</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="footer-nav-item flex flex-col items-center text-gray-600">
                <svg class="footer-nav-icon w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11 7L9.6 8.4l2.6 2.6H2v2h10.2l-2.6 2.6L11 17l5-5-5-5zm9 12h-8v2h8c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-8v2h8v14z"/>
                </svg>
                <span class="footer-nav-text text-sm">Login</span>
            </a>

            <a href="{{ route('register') }}" class="footer-nav-item flex flex-col items-center text-gray-600">
                <svg class="footer-nav-icon w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V8c0-.55-.45-1-1-1s-1 .45-1 1v2H2c-.55 0-1 .45-1 1s.45 1 1 1h2v2c0 .55.45 1 1 1s1-.45 1-1v-2h2c.55 0 1-.45 1-1s-.45-1-1-1H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <span class="footer-nav-text text-sm">Register</span>
            </a>
        @endauth
    </div>
</footer>


</div>
</body>
</html>