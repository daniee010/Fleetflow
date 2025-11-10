<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()->paginate(10);
        return view('backend.admin.expenses.index', compact('expenses'));
    }

    public function create()  { return view('backend.admin.expenses.create'); }
    public function store()   { return back()->with('status','Expense created (stub)'); }
    public function edit(Expense $expense) { return view('backend.admin.expenses.edit', compact('expense')); }
    public function update(Expense $expense) { return back()->with('status','Expense updated (stub)'); }
    public function destroy(Expense $expense) { return back()->with('status','Expense deleted (stub)'); }
}
