@extends('layout.app')
@section('main')
    <div class="container">
        <h2>Edit Category</h2>

        <form action="{{ url('categories/updating/'.$category->id) }}" method="POST">
            @csrf
            @method('put')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
            </div>

            <div class="mb-3">
                <label>Type</label>
                <select name="type" class="form-control" required>
                    <option {{ $category->type ? 'selected':'' }} value="{{ $category->type }}">{{ $category->type }}</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>

            <button type="submit" class="btn btn-secondary">Update</button>
        </form>
    </div>
@endsection
