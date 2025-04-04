@extends('layout.app')
@section('main')
    <div class="container">
        <h3>Dashboard</h3>
        <hr>
        <p>Welcome back {{ auth()->user()->name }}, <small>This is your dashboard. It gives you overview of everything. </small></p>

        <div class="row text-white">
            <div class="col-md-4 mb-3">
                <div class="card bg-success">
                    <div class="card-body">
                        <h5>Total Income</h5>
                        <h4>KES {{ number_format($totalIncome, 2) }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-danger">
                    <div class="card-body">
                        <h5>Total Expense</h5>
                        <h4>KES {{ number_format($totalExpense, 2) }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h5>Balance</h5>
                        <h4>KES {{ number_format($balance, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="row">
            <div class="col-md-6">
                <h4>Category-wise Expenses</h4>
                <div style="width: 100%; max-width: 600px; height: 350px;">
                    <canvas id="expenseChart"></canvas>
                </div>
            </div>

        </div>
    </div>
@endsection

