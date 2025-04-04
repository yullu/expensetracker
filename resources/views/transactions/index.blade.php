@extends('layout.app')
@section('main')
    <div class="container">
        <h2>All Transactions</h2>

       @include('_message')

        <a href="{{ url('transactions/create') }}" class="btn btn-primary mb-3">Add New</a>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Type</th>
                <th>Amount (KES)</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $trx)
                <tr>
                    <td>{{ $trx->date }}</td>
                    <td>{{ $trx->category->name }}</td>
                    <td>{{ ucfirst($trx->type) }}</td>
                    <td>{{ number_format($trx->amount, 2) }}</td>
                    <td>{{ $trx->description ?? '-' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $transactions->links() }}
    </div>
@endsection
