<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Expense;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('vehicle')->latest()->paginate(10);
        return view('backend.admin.maintenance.index', compact('maintenances'));
    }

    public function create()
    {
        $vehicles = Vehicle::orderBy('plate_number')->get(['id','plate_number','make','model']);
        $types = Maintenance::SERVICE_TYPES; // ✅ define & pass this
        return view('backend.admin.maintenance.create', compact('vehicles', 'types'));
    }

    public function store(Request $request)
    {
        $types = Maintenance::SERVICE_TYPES;

        $data = $request->validate([
            'vehicle_id'   => ['required', 'exists:vehicles,id'],
            'service_date' => ['required', 'date'],
            'service_type' => ['required', Rule::in($types)], // ✅ validation
            'cost'         => ['required', 'numeric', 'min:0'],
            'notes'        => ['nullable', 'string', 'max:1000'],
        ]);

        $m = Maintenance::create($data);

        Expense::updateOrCreate(
            ['maintenance_id' => $m->id],
            [
                'expense_date' => $m->service_date,
                'category'     => 'maintenance',
                'amount'       => $m->cost,
                'vehicle_id'   => $m->vehicle_id,
                'description'  => "Maintenance: {$m->service_type}",
                'notes'        => "Auto from maintenance #{$m->id} ({$m->service_type})",
            ]
        );

        return redirect()->route('admin.maintenance.index')->with('status', 'Maintenance + Expense created.');
    }

    public function edit(Maintenance $maintenance)
    {
        $vehicles = Vehicle::orderBy('plate_number')->get(['id','plate_number','make','model']);
        $types = Maintenance::SERVICE_TYPES; // ✅ define & pass this too
        return view('backend.admin.maintenance.edit', compact('maintenance', 'vehicles', 'types'));
    }

    public function show(Maintenance $maintenance)
    {
        // Eager load anything you need, e.g. vehicle, mechanic
        $maintenance->load(['vehicle', 'mechanic']);

        return view('backend.admin.maintenance.show', compact('maintenance'));
    }


    public function update(Request $request, Maintenance $maintenance)
    {
        $types = Maintenance::SERVICE_TYPES;

        $data = $request->validate([
            'vehicle_id'   => ['required', 'exists:vehicles,id'],
            'service_date' => ['required', 'date'],
            'service_type' => ['required', Rule::in($types)],
            'cost'         => ['required', 'numeric', 'min:0'],
            'notes'        => ['nullable', 'string', 'max:1000'],
        ]);

        $maintenance->update($data);

        Expense::updateOrCreate(
            ['maintenance_id' => $maintenance->id],
            [
                'expense_date' => $maintenance->service_date,
                'category'     => 'maintenance',
                'amount'       => $maintenance->cost,
                'vehicle_id'   => $maintenance->vehicle_id,
                'description'  => "Maintenance: {$maintenance->service_type}",
                'notes'        => "Auto from maintenance #{$maintenance->id} ({$maintenance->service_type})",
            ]
        );

        return back()->with('status', 'Maintenance + Expense updated.');
    }



    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('admin.maintenance.index')->with('status', 'Maintenance (and linked expense) deleted.');
    }
}
