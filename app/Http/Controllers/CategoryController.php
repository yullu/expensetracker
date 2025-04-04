<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $categories = Category::where('user_id', Auth::id())->get();
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
        return view('categories.index', compact('categories', 'expenseByCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = auth()->id();
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

        return view('categories.create', compact('expenseByCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()->route('categories')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $userId = auth()->id();
        $category = Category::findorfail($id);

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

        return view('categories.edit', compact('category', 'expenseByCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);

        //var_dump($request);

        $category = Category::find($id);
        $category->user_id = Auth::id();
        $category->name = $request->name;
        $category->type = $request->type;
        $category->update();

        return redirect()->route('categories')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully.');
    }
}
