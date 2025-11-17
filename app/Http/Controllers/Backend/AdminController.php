<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Vehicle;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'vehicles'      => Vehicle::count(),
            'customers'     => Customer::count(),
            'maintenance'   => Maintenance::count(),
            'activeRentals' => Rental::where('status', 'active')->count(),
            'revenue'       => Payment::sum('amount'),

            // Driver scheme stats
            'sales_only'    => Driver::where('scheme_type', 'sales_only')->count(),
            'work_and_pay'  => Driver::where('scheme_type', 'work_and_pay')->count(),
            'mixed'         => Driver::where('scheme_type', 'mixed')->count(),
        ];

        $recentRentals = Rental::with(['customer', 'vehicle'])
            ->latest()
            ->take(5)
            ->get();

        return view('backend.admin.dashboard', [
            'stats' => $stats,
            'recentRentals' => $recentRentals
        ]);
    }
}
