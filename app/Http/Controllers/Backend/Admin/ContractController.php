<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkAndPayContract;

class ContractController extends Controller
{
    //
    public function index()
    {
        $contracts = WorkAndPayContract::with(['driver', 'vehicle'])
            ->latest()
            ->paginate(10);

        return view('backend.admin.contracts.index', compact('contracts'));
    }
}
