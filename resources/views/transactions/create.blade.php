@extends('layouts.app')

@section('title', 'Add Transaction')

@section('content')
<h1>Add New Transaction</h1>

<form action="{{ route('transactions.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        @error('title')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="amount">Amount *</label>
        <input type="number" id="amount" name="amount" step="0.01" min="0.01" value="{{ old('amount') }}" required>
        @error('amount')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="type">Type *</label>
        <select id="type" name="type" required onchange="filterCategories()">
            <option value="">Select Type</option>
            <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
            <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
        </select>
        @error('type')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="category_id">Category *</label>
        <select id="category_id" name="category_id" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                        data-type="{{ $category->type }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="date">Date *</label>
        <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
        @error('date')
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
        <button type="submit" class="btn btn-success">Create Transaction</button>
        <a href="{{ route('transactions.index') }}" class="btn">Cancel</a>
    </div>
</form>

<script>
function filterCategories() {
    const typeSelect = document.getElementById('type');
    const categorySelect = document.getElementById('category_id');
    const selectedType = typeSelect.value;
    
    for (let option of categorySelect.options) {
        if (option.value === '') {
            option.style.display = 'block';
            continue;
        }
        
        const optionType = option.getAttribute('data-type');
        if (selectedType === '' || optionType === selectedType) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    }
    

    const currentOption = categorySelect.options[categorySelect.selectedIndex];
    if (currentOption && currentOption.getAttribute('data-type') !== selectedType && selectedType !== '') {
        categorySelect.value = '';
    }
}


document.addEventListener('DOMContentLoaded', function() {
    filterCategories();
});
</script>
@endsection