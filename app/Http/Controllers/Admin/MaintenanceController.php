<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('vehicle')->latest()->paginate(10);
        return view('backend.admin.maintenance.index', compact('maintenances'));
    }

    public function create()  { return view('backend.admin.maintenance.create'); }
    public function store()   { return back()->with('status','Maintenance created (stub)'); }
    public function show(Maintenance $maintenance) { return view('backend.admin.maintenance.show', compact('maintenance')); }
    public function edit(Maintenance $maintenance) { return view('backend.admin.maintenance.edit', compact('maintenance')); }
    public function update(Maintenance $maintenance) { return back()->with('status','Maintenance updated (stub)'); }
    public function destroy(Maintenance $maintenance) { return back()->with('status','Maintenance deleted (stub)'); }
}
