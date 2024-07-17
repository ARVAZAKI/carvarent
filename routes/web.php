<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DriverController;
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

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/dashboard', [AdminController::class, "dashboard"])->name('admin.dashboard');
    Route::get('/drivers', [AdminController::class, "driver"])->name('admin.driver');
    Route::get('/add-driver', [DriverController::class, "add"])->name('admin.add.driver');
    Route::post('/add-driver', [DriverController::class, "store"])->name('admin.store.driver');
    Route::get('/delete-driver/{id}', [DriverController::class, "delete"])->name('admin.delete.driver');
    Route::get('/bookings', [AdminController::class, "booking"])->name('admin.booking');
    Route::get('/vehicles', [AdminController::class, "vehicle"])->name('admin.vehicle');
});

