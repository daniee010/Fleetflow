<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkAndPayContract;

class WorkAndPayContractController extends Controller
{
    public function index()
    {
        $contracts = \App\Models\WorkAndPayContract::with(['driver','vehicle'])
            ->latest()->paginate(10);

        return view('backend.contracts.index', compact('contracts'));
    }

    public function create()  { return view('backend.admin.contracts.create'); }
    public function store()   { return back()->with('status','Contract created (stub)'); }
    public function show(WorkAndPayContract $contract) { return view('backend.admin.contracts.show', compact('contract')); }
    public function edit(WorkAndPayContract $contract) { return view('backend.admin.contracts.edit', compact('contract')); }
    public function update(WorkAndPayContract $contract) { return back()->with('status','Contract updated (stub)'); }
    public function destroy(WorkAndPayContract $contract) { return back()->with('status','Contract deleted (stub)'); }
}
