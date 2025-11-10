<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('backend.admin.customers.index', compact('customers'));
    }

    public function create()  { return view('backend.admin.customers.create'); }
    public function store()   { return back()->with('status','Customer created (stub)'); }
    public function show(Customer $customer) { return view('backend.admin.customers.show', compact('customer')); }
    public function edit(Customer $customer) { return view('backend.admin.customers.edit', compact('customer')); }
    public function update(Customer $customer) { return back()->with('status','Customer updated (stub)'); }
    public function destroy(Customer $customer) { return back()->with('status','Customer deleted (stub)'); }
}
