<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\DB;
use App\Models\{User,Vehicle,Customer, Rental,Maintenance};

/*
|--------------------------------------------------------------------------
| Admin (Backend) Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Admin: Vehicle list
    Route::get('/vehicles', function () {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('backend.vehicles.index', compact('vehicles'));
    })->name('vehicles.index');

    // Admin: Rental list
    Route::get('/rentals', function () {
        $rentals = Rental::with(['customer','vehicle'])->latest()->paginate(10);
        return view('backend.rentals.index', compact('rentals'));
    })->name('rentals.index');
});

/*
|--------------------------------------------------------------------------
| Frontend (Public) Routes
|--------------------------------------------------------------------------
*/
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'submitContact')->name('contact.submit');
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
});

// Public vehicles (for visitors)
Route::prefix('vehicles')->name('vehicles.public.')->group(function () {
    Route::get('/', [PublicVehicleController::class, 'index'])->name('index');
    Route::get('/{vehicle}', [PublicVehicleController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Diagnostic / Developer Routes
|--------------------------------------------------------------------------
*/
Route::get('/db-health', function () {
    return [
        'database'  => DB::getDatabaseName(),
        'connected' => DB::select('select 1 as ok')[0]->ok === 1,
        'users_row' => DB::table('users')->select('id')->limit(1)->get(),
    ];
});

Route::get('/diag', function () {
    return [
        'db' => 'ok',
        'counts' => [
            'users'       => User::count(),
            'vehicles'    => Vehicle::count(),
            'customers'   => Customer::count(),
            'rentals'     => Rental::count(),
            'maintenance' => Maintenance::count(), // singular table, model points to it
        ],
        'sample_rental' => Rental::with(['customer:id,name,email','vehicle:id,plate_number,make,model'])
            ->latest()->first(),
    ];
});
