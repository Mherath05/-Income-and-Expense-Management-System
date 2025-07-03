{{-- resources/views/profile/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<h1>Profile</h1>

<div style="background: white; padding: 2rem; border-radius: 8px;">
    <h3>User Information</h3>
    
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Member Since:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
    
    <hr style="margin: 2rem 0;">
    
    <h3>Account Statistics</h3>
    
    @php
        $userTransactions = $user->transactions;
        $totalTransactions = $userTransactions->count();
        $totalIncome = $userTransactions->where('type', 'income')->sum('amount');
        $totalExpense = $userTransactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
    @endphp
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
        <div style="background: #f8f9fa; padding: 1rem; border-radius: 4px;">
            <h4>Total Transactions</h4>
            <p style="font-size: 1.5rem; margin: 0;">{{ $totalTransactions }}</p>
        </div>
        
        <div style="background: #d4edda; padding: 1rem; border-radius: 4px;">
            <h4>Total Income</h4>
            <p style="font-size: 1.5rem; margin: 0; color: green;">₹{{ number_format($totalIncome, 2) }}</p>
        </div>
        
        <div style="background: #f8d7da; padding: 1rem; border-radius: 4px;">
            <h4>Total Expense</h4>
            <p style="font-size: 1.5rem; margin: 0; color: red;">₹{{ number_format($totalExpense, 2) }}</p>
        </div>
        
        <div style="background: #d1ecf1; padding: 1rem; border-radius: 4px;">
            <h4>Current Balance</h4>
            <p style="font-size: 1.5rem; margin: 0; color: blue;">₹{{ number_format($balance, 2) }}</p>
        </div>
    </div>
</div>
@endsection