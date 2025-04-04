<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $transactions = Transaction::where('user_id', Auth::id())->with('category')->latest()->paginate(10);
        // Category-wise expense breakdown
        $expenseByCategory = Transaction::select(
            DB::raw('SUM(amount) as total'),
            DB::raw('categories.name as category')
        )
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->where('transactions.type', 'expense')
            ->groupBy('categories.name')
            ->get();

        return view('transactions.index', compact('transactions', 'expenseByCategory'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('transactions.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date'
        ]);
        //var_dump($request);

        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect()->route('transactions')->with('success', 'Transaction added successfully!');
    }
}
