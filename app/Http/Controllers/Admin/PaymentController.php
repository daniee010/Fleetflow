<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Driver;
use App\Models\Vehicle;


class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // Load everything we might need on the listing:
        // - driver           (for contract / sales payments)
        // - vehicle          (for both rentals and contracts)
        // - rental.customer  (for customer rental payments)
        // - workAndPayContract (for Work & Pay / driver contracts)
        $payments = Payment::with([
            'driver',
            'vehicle',
            'rental.customer',
            'workAndPayContract',   // make sure Payment model has this relation
        ])
            ->latest()
            ->paginate(10);

        return view('backend.admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        // Load full context for detail page
        $payment->load([
            'driver',
            'vehicle',
            'rental.customer',
            'workAndPayContract',
        ]);

        return view('backend.admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        // Load same context for edit form if needed
        $payment->load([
            'driver',
            'vehicle',
            'rental.customer',
            'workAndPayContract',
        ]);

        return view('backend.admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'amount'        => ['required', 'numeric', 'min:0.01'],
            'payment_date'  => ['required', 'date'],
            'payment_type'  => ['required', 'in:rental,contract,sales'],
            'notes'         => ['nullable', 'string'],
        ]);

        $payment->update($data);

        return redirect()
            ->route('admin.payments.show', $payment)
            ->with('status', 'Payment updated successfully.');
    }


    public function createSalesForDriver(Driver $driver)
    {
        // Vehicles attached to this driver (or all vehicles if you prefer)
        $vehicles = Vehicle::orderBy('plate_number')->get();

        return view('backend.admin.payments.sales.create', compact('driver', 'vehicles'));
    }

    public function storeSalesForDriver(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'amount'       => ['required', 'numeric', 'min:0.01'],
            'payment_date' => ['nullable', 'date'],
            'vehicle_id'   => ['nullable', 'exists:vehicles,id'],
            'notes'        => ['nullable', 'string'],
        ]);

        $paymentDate = $data['payment_date'] ?? now()->toDateString();

        Payment::create([
            'driver_id'                => $driver->id,
            'vehicle_id'               => $data['vehicle_id'] ?? null,
            'rental_id'                => null,
            'work_and_pay_contract_id' => null,
            'amount'                   => $data['amount'],
            'payment_date'             => $paymentDate,
            'payment_type'             => 'sales',
            'notes'                    => $data['notes'] ?? null,
        ]);

        return redirect()
            ->route('admin.drivers.show', $driver)
            ->with('status', 'Sales payment recorded for driver.');
    }


}
