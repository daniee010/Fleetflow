<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('vehicle')
            ->latest('expense_date')
            ->paginate(10);

        $totals = [
            'count'  => Expense::count(),
            'amount' => Expense::sum('amount'),
        ];

        return view('backend.admin.expenses.index', compact('expenses','totals'));
    }

    public function create()
    {
        $vehicles = Vehicle::orderBy('plate_number')->get(['id','plate_number','make','model']);
        return view('backend.admin.expenses.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'expense_date' => ['required','date'],
            'category'     => ['required','in:fuel,maintenance,insurance,tax,toll,parking,salary,other'],
            'amount'       => ['required','numeric','min:0'],
            'vehicle_id'   => ['nullable','exists:vehicles,id'],
            'notes'        => ['nullable','string','max:1000'],
        ]);

        Expense::create($data);

        return redirect()->route('admin.expenses.index')->with('status','Expense added.');
    }

    public function edit(Expense $expense)
    {
        $vehicles = Vehicle::orderBy('plate_number')->get(['id','plate_number','make','model']);
        return view('backend.admin.expenses.edit', compact('expense','vehicles'));
    }

    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'expense_date' => ['required','date'],
            'category'     => ['required','in:fuel,maintenance,insurance,tax,toll,parking,salary,other'],
            'amount'       => ['required','numeric','min:0'],
            'vehicle_id'   => ['nullable','exists:vehicles,id'],
            'notes'        => ['nullable','string','max:1000'],
        ]);

        $expense->update($data);

        return redirect()->route('admin.expenses.index')->with('status','Expense updated.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return back()->with('status','Expense deleted.');
    }

    public function show(Expense $expense)
    {
        $expense->load('vehicle');
        return view('backend.admin.expenses.show', compact('expense'));
    }
}
