<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // If you want to centralize the allowed roles:
    private const ROLES = ['admin','driver','customer','mechanic'];

    public function index()
    {
        $role   = request('role'); // ?role=admin|driver|customer|mechanic
        $query  = User::query();

        if ($role && in_array($role, self::ROLES, true)) {
            $query->where('role', $role);
        }

        $users  = $query->latest()->paginate(12)->withQueryString();

        // quick chips/counts for the header
        $counts = [
            'all'      => User::count(),
            'admin'    => User::where('role','admin')->count(),
            'driver'   => User::where('role','driver')->count(),
            'customer' => User::where('role','customer')->count(),
            'mechanic' => User::where('role','mechanic')->count(),
        ];

        return view('backend.admin.users.index', compact('users','role','counts'));
    }
}
