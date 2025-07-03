@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Transactions</h1>
    <a href="{{ route('transactions.create') }}" class="btn btn-success">Add New Transaction</a>
</div>

<form method="GET" style="background: #f9f9f9; padding: 20px; margin-bottom: 20px;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
        <div class="form-group">
            <label for="search">Search</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search title or description">
        </div>
        
        <div class="form-group">
            <label for="type">Type</label>
            <select id="type" name="type">
                <option value="">All Types</option>
                <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Income</option>
                <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Expense</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }} ({{ ucfirst($category->type) }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="date_from">From Date</label>
            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}">
        </div>
        
        <div class="form-group">
            <label for="date_to">To Date</label>
            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}">
        </div>
    </div>
    
 <div style="margin-top: 15px;">
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Clear</a>
</div>

</form>

@if($transactions->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Category</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->date->format('M d, Y') }}</td>
                <td>{{ $transaction->title }}</td>
                <td>{{ $transaction->category->name }}</td>
                <td>
                    <span style="color: {{ $transaction->type == 'income' ? 'green' : 'red' }}">
                        {{ ucfirst($transaction->type) }}
                    </span>
                </td>
                <td>${{ number_format($transaction->amount, 2) }}</td>
                <td>
                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this transaction?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transactions->withQueryString()->links() }}
@else
    <p>No transactions found. <a href="{{ route('transactions.create') }}">Create your first transaction</a></p>
@endif
@endsection