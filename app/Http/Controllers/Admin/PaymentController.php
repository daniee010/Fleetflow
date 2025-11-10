<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        // eager-load driver to avoid N+1
        $payments = Payment::with('driver')->latest()->paginate(10);

        // simple sanity check so you never see a blank page
        if (view()->exists('backend.admin.payments.index')) {
            return view('backend.admin.payments.index', compact('payments'));
        }

        return response('View [backend.admin.payments.index] not found.', 500);
    }

    public function show(Payment $payment)
    {
        $payment->load('driver');
        return view('backend.admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $payment->load('driver');
        return view('backend.admin.payments.edit', compact('payment'));
    }
}
