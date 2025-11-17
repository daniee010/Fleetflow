<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $query = Driver::with(['vehicle', 'user', 'latestPayment'])
            ->withCount('trips')   // gives $d->trips_count
            ->latest();

        // Optional filter by scheme_type: ?scheme=sales_only / work_and_pay / mixed
        if ($request->filled('scheme')) {
            $scheme = $request->get('scheme');

            if (in_array($scheme, ['sales_only', 'work_and_pay', 'mixed'])) {
                $query->where('scheme_type', $scheme);
            }
        }

        $drivers = $query->paginate(10)->withQueryString();

        return view('backend.admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('backend.admin.drivers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'nullable|email|max:255',
            'phone'           => 'nullable|string|max:50',
            'license_number'  => 'nullable|string|max:100',
            'license_expiry'  => 'nullable|date',
            'address'         => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:100',
            'country'         => 'nullable|string|max:100',
            'status'          => 'required|in:active,inactive,suspended,pending',
            'scheme_type'     => 'required|in:sales_only,work_and_pay,mixed',
        ]);

        // Create driver
        $driver = Driver::create($data);

        return redirect()
            ->route('admin.drivers.index')
            ->with('status', 'Driver created successfully.');
    }


    public function show(Driver $driver)
    {
        $driver->load([
            'user',
            'vehicle',
            'payments' => function ($q) {
                $q->latest()->take(10);
            },
            'trips' => function ($q) {
                $q->latest()->take(10);
            },
            'workAndPayContracts' => function ($q) {
                $q->latest();
            },
            'salesPayments' => function ($q) {
                $q->latest()->limit(5);
            },
            'activeWorkAndPayContract',
        ]);

        return view('backend.admin.drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('backend.admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'phone'          => ['nullable', 'string', 'max:50'],
            'license_number' => ['nullable', 'string', 'max:100'],
            'license_expiry' => ['nullable', 'date'],
            'address'        => ['nullable', 'string', 'max:255'],
            'city'           => ['nullable', 'string', 'max:100'],
            'country'        => ['nullable', 'string', 'max:100'],
            'status'         => ['required', 'in:active,inactive,suspended,pending'],
            'scheme_type'    => ['required', 'in:sales_only,work_and_pay,mixed'],
        ]);

        $driver->update($data);

        return redirect()
            ->route('admin.drivers.index')
            ->with('status', 'Driver updated successfully.');
    }


    public function destroy(Driver $driver)
    {
        return back()->with('status', 'Driver deleted (stub)');
    }
}
