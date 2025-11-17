<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Vehicle;
use App\Models\Maintenance;

class ReportController extends Controller
{
    public function index()
    {
        /*
         * 1) REVENUE SUMMARY
         * payment_type = 'rental'  => customer rental income
         * payment_type = 'contract'=> driver Work & Pay / sales-style income
         */

        // Rental income (customers)
        $rentalRevenue = Payment::where('payment_type', 'rental')
            ->sum('amount');

// Work & Pay contract income (driver paying against a contract)
        $workAndPayRevenue = Payment::where('payment_type', 'contract')
            ->whereNotNull('work_and_pay_contract_id')
            ->sum('amount');

// Sales-style driver income (no contract, explicit 'sales' type)
        $salesRevenue = Payment::where('payment_type', 'sales')
            ->sum('amount');

// Total income
        $totalRevenue = $rentalRevenue + $workAndPayRevenue + $salesRevenue;


// Total income
        $totalRevenue = $rentalRevenue + $workAndPayRevenue + $salesRevenue;


        /*
         * 2) FLEET SUMMARY
         */
        $fleet = [];
        $fleet['total'] = Vehicle::count();

        $statusCounts = Vehicle::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $fleet['available']   = $statusCounts['available']   ?? 0;
        $fleet['rented']      = $statusCounts['rented']      ?? 0;
        $fleet['maintenance'] = $statusCounts['maintenance'] ?? 0;
        $fleet['sales']       = $statusCounts['sales']       ?? 0;
        $fleet['contract']    = $statusCounts['contract']    ?? 0;

        /*
         * 3) MAINTENANCE SUMMARY
         */
        $maintenanceCount = Maintenance::count();
        // Adjust "cost" to your actual column if different
        $maintenanceTotalCost = Maintenance::sum('cost');

        $topMaintenanceVehicle = Maintenance::selectRaw('vehicle_id, COUNT(*) as total')
            ->groupBy('vehicle_id')
            ->orderByDesc('total')
            ->with('vehicle')
            ->first();

        /*
         * 4) RECENT PAYMENTS (last 10)
         */
        $recentPayments = Payment::with(['driver', 'vehicle', 'rental.customer'])
            ->latest()
            ->limit(10)
            ->get();

        return view('backend.admin.reports.index', compact(
            'rentalRevenue',
            'workAndPayRevenue',
            'salesRevenue',
            'totalRevenue',
            'fleet',
            'maintenanceCount',
            'maintenanceTotalCost',
            'topMaintenanceVehicle',
            'recentPayments'
        ));

    }
}
