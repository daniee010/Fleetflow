<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Rental;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'vehicles'     => Vehicle::count(),
            'customers'    => Customer::count(),
            'activeRentals'=> Rental::where('status','approved')->count(),
            'maintenance'  => Maintenance::count(),
            'revenue'      => Rental::sum('total_cost'),
        ];

        // Fetch latest rentals
        $recentRentals = Rental::with(['customer:id,name','vehicle:id,plate_number,make,model'])
            ->latest()
            ->take(10)
            ->get();

        return view('backend.admin.dashboard', compact('stats', 'recentRentals'));
    }
}
