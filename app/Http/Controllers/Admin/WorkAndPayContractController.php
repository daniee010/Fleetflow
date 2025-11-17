<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkAndPayContract;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Payment;
use Illuminate\Http\Request;

class WorkAndPayContractController extends Controller
{
    public function index()
    {
        $contracts = WorkAndPayContract::with(['driver','vehicle'])
            ->latest()
            ->paginate(10);

        return view('backend.admin.contracts.index', compact('contracts'));
    }

    public function create()
    {
        $drivers = Driver::with('vehicle')
            ->orderBy('name')
            ->get();

        $vehicles = Vehicle::orderBy('plate_number')->get();

        return view('backend.admin.contracts.create', compact('drivers', 'vehicles'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'driver_id'    => ['required', 'exists:drivers,id'],
            'vehicle_id'   => ['required', 'exists:vehicles,id'],
            'total_amount' => ['required', 'numeric', 'min:0.01'],
            'start_date'   => ['required', 'date'],
            'end_date'     => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'       => ['required', 'in:active,completed,terminated'],
        ]);

        $data['amount_paid'] = 0; // new contracts start unpaid

        $contract = WorkAndPayContract::create($data);

        // Optional: if driver was sales_only, move them into work_and_pay
        $driver = $contract->driver;
        if ($driver && $driver->scheme_type === 'sales_only') {
            $driver->scheme_type = 'work_and_pay';
            $driver->save();
        }

        return redirect()
            ->route('admin.contracts.show', $contract)
            ->with('status', 'Work & Pay contract created.');
    }

    public function show(WorkAndPayContract $contract)
    {
        $contract->load(['driver', 'vehicle', 'payments' => function ($q) {
            $q->latest();
        }]);

        return view('backend.admin.contracts.show', compact('contract'));
    }
    public function edit(WorkAndPayContract $contract)
    {
        return view('backend.admin.contracts.edit', compact('contract'));
    }

    public function update(WorkAndPayContract $contract)
    {
        return back()->with('status', 'Contract updated (stub)');
    }

    public function destroy(WorkAndPayContract $contract)
    {
        return back()->with('status', 'Contract deleted (stub)');
    }

    /**
     * Show form to record a Work & Pay payment for this contracts.
     */
    public function paymentsCreate(WorkAndPayContract $contract)
    {
        return view('backend.admin.contracts.payments.create', compact('contract'));
    }

    /**
     * Store the payment and update contracts->amount_paid.
     */
    public function paymentsStore(Request $request, WorkAndPayContract $contract)
    {
        $data = $request->validate([
            'amount'       => ['required', 'numeric', 'min:0.01'],
            'payment_date' => ['nullable', 'date'],
            'notes'        => ['nullable', 'string'],
        ]);

        $amount      = $data['amount'];
        $paymentDate = $data['payment_date'] ?? now();

        // Create payment tied to driver, vehicle & contracts
        Payment::create([
            'driver_id'                => $contract->driver_id,
            'vehicle_id'               => $contract->vehicle_id,
            'work_and_pay_contract_id' => $contract->id,
            'rental_id'                => null, // not a customer rental
            'amount'                   => $amount,
            'payment_date'             => $paymentDate,
            'payment_type'             => 'contract',
            'notes'                    => $data['notes'] ?? null,
        ]);

        // Update amount_paid on the contracts
        $contract->increment('amount_paid', $amount);

        return redirect()
            ->route('admin.contracts.show', $contract)
            ->with('status', 'Work & Pay payment recorded.');
    }
}
