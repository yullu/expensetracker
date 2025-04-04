@extends('layout.app')
@section('main')
    <div class="container">
        <h2>My Categories</h2>
        <a href="{{ url('categories/create') }}" class="btn btn-primary mb-3">Add Category</a>
        @include('_message')
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $cat)
                <tr>
                    <td>{{ $cat->name }}</td>
                    <td>{{ ucfirst($cat->type) }}</td>
                    <td>
                        <a href="{{ url('categories/edit', $cat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ url('categories/destroy', $cat->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">No categories yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
