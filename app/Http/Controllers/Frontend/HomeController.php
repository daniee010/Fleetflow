<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.welcome');
    }
     public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function login()
    {
        return view('frontend.login');
    }
    public function register()
    {
        return view('frontend.register');
    }
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // You can later send mail or store the message
        return back()->with('success', 'Thank you for contacting FleetFlow. We’ll get back to you soon!');
    }

}
