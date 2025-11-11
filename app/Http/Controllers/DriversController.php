<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function index()
    {
        // Example static data (later we can fetch from DB)
        $trips = [
            ['date' => '2025-11-08', 'destination' => 'Downtown Toronto', 'distance' => '45 km', 'status' => 'Completed'],
            ['date' => '2025-11-09', 'destination' => 'Airport', 'distance' => '22 km', 'status' => 'Pending'],
        ];

        $breakdowns = [
            ['date' => '2025-11-02', 'issue' => 'Flat tire', 'status' => 'Resolved'],
            ['date' => '2025-11-05', 'issue' => 'Battery issue', 'status' => 'In progress'],
        ];

        $installments = [
            ['month' => 'October', 'amount' => 500, 'status' => 'Paid'],
            ['month' => 'November', 'amount' => 500, 'status' => 'Pending'],
        ];

        $performance = [
            'rating' => 4.5,
            'completed_trips' => 120,
            'on_time_rate' => '95%',
        ];

        return view('backend.driver.dashboard', compact('trips', 'breakdowns', 'installments', 'performance'));
    }
}
