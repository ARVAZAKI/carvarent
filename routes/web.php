<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/add', function () {
    return view('admin.add-driver');
});

// AUTH 
Route::get('/login', [LoginController::class, "login"])->name('login');
Route::post('/login', [LoginController::class, "loginAuth"])->name('authenticate');
Route::get('/logout', [LoginController::class, "logout"])->name('logout');

Route::prefix('admin')->middleware(['auth','only-admin'])->group(function(){
    Route::get('/dashboard', [AdminController::class, "dashboard"])->name('admin.dashboard');
    Route::get('/tes', [AdminController::class, "chart"])->name('admin.chart');

    Route::get('/drivers', [AdminController::class, "driver"])->name('admin.driver');
    Route::get('/add-driver', [DriverController::class, "add"])->name('admin.add.driver');
    Route::post('/add-driver', [DriverController::class, "store"])->name('admin.store.driver');
    Route::get('/delete-driver/{id}', [DriverController::class, "delete"])->name('admin.delete.driver');


    Route::get('/vehicles', [AdminController::class, "vehicle"])->name('admin.vehicle');
    Route::get('/add-vehicle', [VehicleController::class, "add"])->name('admin.add.vehicle');
    Route::post('/add-vehicle', [VehicleController::class, "store"])->name('admin.store.vehicle');
    Route::get('/delete-vehicle/{id}', [VehicleController::class, "delete"])->name('admin.delete.vehicle');
    Route::get('/search-vehicle', [AdminController::class, "searchVehicle"])->name('admin.search.vehicle');


    Route::get('/bookings', [AdminController::class, "booking"])->name('admin.booking');
    Route::get('/detail-booking/{id}', [BookingController::class, "showdetail"])->name('admin.detail.booking');
    Route::get('/add-booking', [BookingController::class, "add"])->name('admin.add.booking');
    Route::post('/add-booking', [BookingController::class, "store"])->name('admin.store.booking');
    Route::get('/cancel-booking/{id}', [BookingController::class, "cancel"])->name('admin.cancel.booking');

    Route::get('/return-booking/{id}', [AdminController::class, "returnBooking"])->name('admin.return.booking');
    Route::post('/return-booking/{id}', [BookingController::class, "returnBooking"])->name('admin.return.booking.post');

    Route::get('/export-excel', [BookingController::class, "export_excel"])->name('export-excel');
});

Route::prefix('approver')->middleware(['auth','only-approver'])->group(function(){
    Route::get('/dashboard', [ApproverController::class, "dashboard"])->name('approver.dashboard');
    Route::get('/detail-booking/{id}', [BookingController::class, "detail"])->name('approver.detail.booking');
    Route::post('/acc-booking/{id}', [BookingController::class, "acc"])->name('approver.acc.booking');
    Route::post('/reject-booking/{id}', [BookingController::class, "reject"])->name('approver.reject.booking');
});

