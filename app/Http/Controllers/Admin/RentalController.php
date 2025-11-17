<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RentalController extends Controller
{

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $vehicles  = Vehicle::orderBy('plate_number')->get();

        return view('backend.admin.rentals.create', compact('customers', 'vehicles'));
    }

    public function index() {
        $rentals = Rental::with(['customer','vehicle'])->latest()->paginate(15);
        return view('backend.admin.rentals.index', compact('rentals'));
    }

    public function edit(Rental $rental) {
        return view('backend.admin.rentals.edit', compact('rental'));
    }

    public function update(Request $request, Rental $rental) {
        $data = $request->validate([
            'start_date' => ['required','date'],
            'end_date'   => ['required','date','after_or_equal:start_date'],
            'status'     => ['required','in:pending,approved,completed,cancelled'],
            'total_cost' => ['required','numeric','min:0'],
        ]);

        $rental->update($data);

        return back()->with('status','Rental updated');
    }

    public function store(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'vehicle_id' => ['required','exists:vehicles,id'],
            'start_date' => ['required','date'],
            'end_date'   => ['required','date','after_or_equal:start_date'],
            'status'     => ['required','in:pending,approved,completed,cancelled'],
            'total_cost' => ['required','numeric','min:0'],
        ]);

        $data['customer_id'] = $customer->id;

        Rental::create($data);

        return back()->with('status', 'Rental added.');
    }

    public function storeFromAdmin(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'vehicle_id'  => ['required', 'exists:vehicles,id'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['required', 'date', 'after_or_equal:start_date'],
            'status'      => ['required', 'in:pending,approved,completed,cancelled'],
            'total_cost'  => ['required', 'numeric', 'min:0'],
        ]);

        Rental::create($data);

        return redirect()
            ->route('admin.rentals.index')
            ->with('status', 'Rental created successfully.');
    }

    public function destroyForCustomer(Customer $customer, Rental $rental)
    {
        abort_unless($rental->customer_id === $customer->id, 403);
        $rental->delete();

        return back()->with('status','Rental removed');
    }
}
