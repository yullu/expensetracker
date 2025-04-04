@extends('layout.app')
@section('main')
    <div class="container">
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Welcome to Expense Tracker</h2>
                    <p>
                        The Expense Tracker is a simple and efficient web application designed to help individuals and businesses monitor and manage their finances. Built with Laravel and Blade templates, it allows users to log daily expenses, categorize transactions, and generate insightful reports to better understand their spending habits.
                        With features like monthly summaries, category-wise breakdowns, and real-time data visualization using Chart.js, users can take control of their budgets and make smarter financial decisions. The system is user-friendly, responsive, and perfect for personal finance management or small business use.
                    </p>

                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Login</h2>
                    @include('_message')
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
