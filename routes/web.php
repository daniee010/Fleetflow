<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\WorkAndPayContractController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\MechanicController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Driver,
    Expense,
    Customer,
    Payment,
    Rental,
    Vehicle,
    Maintenance,
    WorkAndPayContract,
    User
};



Route::get('/', [HomeController::class, 'index'])->name('home');




Route::get('/dashboard', function () {
    // you can add role logic here later if needed
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Rentals
        Route::get('/rentals', [AdminRentalController::class, 'index'])->name('rentals.index');
        Route::get('/rentals/{rental}/edit', [AdminRentalController::class, 'edit'])->name('rentals.edit');
        Route::patch('/rentals/{rental}', [AdminRentalController::class, 'update'])->name('rentals.update');
        Route::delete('/rentals/{rental}', [AdminRentalController::class, 'destroy'])->name('rentals.destroy');
        Route::get('/rentals/create', [AdminRentalController::class, 'create'])->name('rentals.create');
        Route::post('/rentals', [AdminRentalController::class, 'storeFromAdmin'])->name('rentals.store');

        // Vehicles
        Route::resource('vehicles', VehicleController::class)->names('vehicles');

        // Mechanics
        Route::get('/mechanics', [MechanicController::class, 'index'])->name('mechanics.index');
        Route::get('/mechanics/{mechanic}', [MechanicController::class, 'show'])->name('mechanics.show');

        // Maintenance
        Route::resource('maintenance', MaintenanceController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'])
            ->names('maintenance');

        // Drivers & Customers
        Route::resource('drivers', DriverController::class)->names('drivers');
        Route::resource('customers', CustomerController::class);

        Route::post('/customers/{customer}/rentals', [AdminRentalController::class, 'store'])
            ->name('customers.rentals.store');
        Route::delete('/customers/{customer}/rentals/{rental}', [AdminRentalController::class, 'destroyForCustomer'])
            ->name('customers.rentals.destroy');

        // Expenses
        Route::resource('expenses', ExpenseController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'])
            ->names('expenses');

        // Payments
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
        Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
        Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');

        // Sales payments for drivers
        Route::get('/drivers/{driver}/sales-payments/create', [PaymentController::class, 'createSalesForDriver'])
            ->name('drivers.sales-payments.create');
        Route::post('/drivers/{driver}/sales-payments', [PaymentController::class, 'storeSalesForDriver'])
            ->name('drivers.sales-payments.store');

        // Work & Pay contracts
        Route::resource('contracts', WorkAndPayContractController::class)
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy'])
            ->names('contracts');

        Route::get('contracts/{contract}/payments/create', [WorkAndPayContractController::class, 'paymentsCreate'])
            ->name('contracts.payments.create');
        Route::post('contracts/{contract}/payments', [WorkAndPayContractController::class, 'paymentsStore'])
            ->name('contracts.payments.store');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });


Route::prefix('driver')->name('driver.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DriversController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');
});


Route::controller(HomeController::class)->group(function () {
    // '/' is already defined above as HomeController@index
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'submitContact')->name('contact.submit');


});


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
            'maintenance' => Maintenance::count(),
        ],
        'sample_rental' => Rental::with([
            'customer:id,name,email',
            'vehicle:id,plate_number,make,model',
        ])->latest()->first(),
    ];
});


require __DIR__.'/auth.php';
