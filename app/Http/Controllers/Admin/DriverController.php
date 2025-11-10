<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('vehicle')->latest()->paginate(10);
        return view('backend.admin.drivers.index', compact('drivers'));
    }

    public function create()  { return view('backend.admin.drivers.create'); }
    public function store()   { return back()->with('status','Driver created (stub)'); }
    public function show(Driver $driver) { return view('backend.admin.drivers.show', compact('driver')); }
    public function edit(Driver $driver) { return view('backend.admin.drivers.edit', compact('driver')); }
    public function update(Driver $driver) { return back()->with('status','Driver updated (stub)'); }
    public function destroy(Driver $driver) { return back()->with('status','Driver deleted (stub)'); }
}
