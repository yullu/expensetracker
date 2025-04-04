@extends('layout.app')
@section('main')
    <div class="container">
        <h2>Add New Transaction</h2>

        <form action="{{ route('transactions') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Type</label>
                <select name="type" class="form-control" >
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control" >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Amount</label>
                <input type="number" step="0.01" name="amount" class="form-control" >
                @error('amount')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" >
                @error('date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Description (Optional)</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Transaction</button>
        </form>

    </div>
@endsection

