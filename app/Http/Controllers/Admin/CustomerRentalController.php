<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Rental;
use Illuminate\Http\Request;

class CustomerRentalController extends Controller
{
    public function store(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'vehicle_id' => ['required','exists:vehicles,id'],
            'start_date' => ['required','date'],
            'end_date'   => ['required','date','after_or_equal:start_date'],
            'total_cost' => ['required','numeric','min:0'],
            'status'     => ['required','in:pending,approved,completed,cancelled'],
        ]);

        $data['customer_id'] = $customer->id;

        Rental::create($data);

        return back()->with('status','Rental created for customer.');
    }
}
