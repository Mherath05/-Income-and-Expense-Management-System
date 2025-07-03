@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-success">Add New Category</a>
</div>

@if($categories->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Transactions Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <span style="color: {{ $category->type == 'income' ? 'green' : 'red' }}">
                        {{ ucfirst($category->type) }}
                    </span>
                </td>
                <td>{{ $category->description ?? '-' }}</td>
                <td>{{ $category->transactions_count ?? $category->transactions()->count() }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-edit">Edit</a>

                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this category?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No categories found. <a href="{{ route('categories.create') }}">Create your first category</a></p>
@endif
@endsection