<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\WorkAndPayContractController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\MechanicController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\DB;
use App\Models\{Driver,Expense,Customer,Payment,Rental,Vehicle,Maintenance,WorkAndPayContract};

/*
|--------------------------------------------------------------------------
| Admin (Backend) Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/rentals',        [AdminRentalController::class, 'index'])->name('rentals.index');
    Route::get('/rentals/{rental}/edit', [AdminRentalController::class, 'edit'])->name('rentals.edit');
    Route::patch('/rentals/{rental}',    [AdminRentalController::class, 'update'])->name('rentals.update');
    Route::delete('/rentals/{rental}',   [AdminRentalController::class, 'destroy'])->name('rentals.destroy');
    // Admin: Vehicle list
    Route::get('/vehicles', function () {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('backend.vehicles.index', compact('vehicles'));
    })->name('vehicles.index');

    Route::get('/mechanics', [\App\Http\Controllers\Admin\MechanicController::class, 'index'])
        ->name('mechanics.index');
    Route::get('/mechanics/{mechanic}', [\App\Http\Controllers\Admin\MechanicController::class, 'show'])
        ->name('mechanics.show');




    // Admin: Rental list
//    Route::get('/rentals', function () {
//        $rentals = Rental::with(['customer','vehicle'])->latest()->paginate(10);
//        return view('backend.rentals.index', compact('rentals'));
//    })->name('rentals.index');
//
//    Route::patch('/rentals/{rental}', [RentalController::class, 'update'])
//        ->name('admin.rentals.update');
//
//    Route::delete('/rentals/{rental}', [RentalController::class, 'destroy'])
//        ->name('admin.rentals.destroy');


    Route::resource('maintenance', MaintenanceController::class)
        ->only(['index','create','store','edit','update','destroy','show'])
        ->names('maintenance');



    Route::resource('drivers', DriverController::class)->names('drivers');
    Route::resource('customers', CustomerController::class);

    Route::post('/customers/{customer}/rentals', [AdminRentalController::class, 'store'])
        ->name('customers.rentals.store');

    Route::delete('/customers/{customer}/rentals/{rental}',
        [AdminRentalController::class, 'destroyForCustomer']
    )->name('customers.rentals.destroy');

    Route::resource('maintenance', \App\Http\Controllers\Admin\MaintenanceController::class)->only(['index','show','create','store','edit','update','destroy']);

    Route::resource('expenses', ExpenseController::class)
        ->only(['index','create','store','edit','update','destroy','show'])
        ->names('expenses');

//    Route::resource('payments', PaymentController::class)
//        ->only(['index','create','store'])
//        ->names('payments'); // admin.payments.index, admin.payments.create, admin.payments.store
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');


    Route::resource('contracts', WorkAndPayContractController::class)->only([
        'index','show','create','store','edit','update','destroy'
    ])->names('contracts');


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
//    Route::get('settings/company', [Admin\SettingController::class, 'company'])->name('settings.company');
//    Route::post('settings/company', [Admin\SettingController::class, 'saveCompany'])->name('settings.company.save');

});


Route::prefix('driver')->name('driver.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DriversController::class, 'index'])->name('dashboard');
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
//    Route::get('/', [PublicVehicleController::class, 'index'])->name('index');
//    Route::get('/{vehicle}', [PublicVehicleController::class, 'show'])->name('show');
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
