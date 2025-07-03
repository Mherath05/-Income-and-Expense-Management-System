@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<h1>Add New Category</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="name">Category Name *</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="type">Type *</label>
        <select id="type" name="type" required>
            <option value="">Select Type</option>
            <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
            <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
        </select>
        @error('type')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>
        @error('description')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-success">Create Category</button>
        <a href="{{ route('categories.index') }}" class="btn">Cancel</a>
    </div>
</form>
@endsection