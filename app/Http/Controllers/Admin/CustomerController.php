<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Mechanic;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('backend.admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('backend.admin.customers.create');
    }

    public function store(CustomerRequest $request)
    {
        Customer::create($request->validated());
        return redirect()->route('admin.customers.index')
            ->with('status', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        $customer->load([
            'rentals.vehicle',
            'payments' => fn($q) => $q->latest(),
        ]);

        $stats = [
            'rentals_count' => $customer->rentals()->count(),
            'total_spent'   => $customer->payments()->sum('amount'),
            'active_rentals'=> $customer->rentals()->where('status','approved')->count(),
        ];

        return view('backend.admin.customers.show', compact('customer','stats'));
    }

    public function edit(Customer $customer)
    {
        // load rentals + their vehicles for the table on the page
        $customer->load(['rentals.vehicle']);

        // vehicles for the “Add Rental” dropdown
        $vehicles = Vehicle::orderBy('plate_number')
            ->get(['id','plate_number','make','model']);

        return view('backend.admin.customers.edit', compact('customer','vehicles'));
    }


    public function update(CustomerRequest $request, Customer $customer)
    {
        $data = $request->validate([
            'name'    => ['required','string','max:255'],
            'email'   => ['required','email','max:255'],
            'phone'   => ['nullable','string','max:100'],
            'address' => ['nullable','string','max:500'],
        ]);

        $customer->update($data);

        return back()->with('status','Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        // optional: check relations before delete
        $customer->delete();
        return redirect()->route('admin.customers.index')
            ->with('status', 'Customer deleted.');
    }
}
