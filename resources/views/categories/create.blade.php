@extends('layout.app')
@section('main')
    <div class="container">
        <h2>{{ isset($category) ? 'Edit' : 'Add' }} Category</h2>

        <form action="{{route('categories') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Type</label>
                <select name="type" class="form-control" required>
                    <option value="income">-- Select --</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection


