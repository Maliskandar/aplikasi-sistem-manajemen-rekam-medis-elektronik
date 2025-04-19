<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KucingController;
use App\Http\Controllers\KucingAdminController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TrackingController;

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
    return view('welcome');
});

// AUTHENTICATION ROUTE
// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
// Rute untuk customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// Route untuk Admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('kandang', [KandangController::class, 'index'])->name('admin.kandang.index');
    Route::get('kandang/create', [KandangController::class, 'create'])->name('admin.kandang.create');
    Route::post('kandang', [KandangController::class, 'store'])->name('admin.kandang.store');
    Route::get('kandang/{id}/edit', [KandangController::class, 'edit'])->name('admin.kandang.edit');
    Route::put('kandang/{id}', [KandangController::class, 'update'])->name('admin.kandang.update');
    Route::delete('kandang/{id}', [KandangController::class, 'destroy'])->name('admin.kandang.destroy');

    Route::get('reservasi', [ReservasiController::class, 'indexAdmin'])->name('admin.reservasi.index');

    Route::get('tracking', [TrackingController::class, 'index'])->name('admin.tracking.index');
    Route::get('tracking/create', [TrackingController::class, 'create'])->name('admin.tracking.create');
    Route::post('tracking', [TrackingController::class, 'store'])->name('admin.tracking.store');
    Route::get('tracking/{id}/edit', [TrackingController::class, 'edit'])->name('admin.tracking.edit');
    Route::put('tracking/{id}', [TrackingController::class, 'update'])->name('admin.tracking.update');
    Route::delete('tracking/{id}', [TrackingController::class, 'destroy'])->name('admin.tracking.destroy');

    // Customer Routes
    Route::get('customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');
    Route::post('customers', [CustomerController::class, 'store'])->name('admin.customers.store');
    Route::get('customers/{id_customer}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('customers/{id_customer}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('customers/{id_customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    // Kucing Routes
    Route::get('kucings', [KucingAdminController::class, 'index'])->name('admin.kucings.index');
    Route::get('kucings/create', [KucingAdminController::class, 'create'])->name('admin.kucings.create');
    Route::post('kucings', [KucingAdminController::class, 'store'])->name('admin.kucings.store');
    Route::get('kucings/{id_kucing}/edit', [KucingAdminController::class, 'edit'])->name('admin.kucings.edit');
    Route::put('kucings/{id_kucing}', [KucingAdminController::class, 'update'])->name('admin.kucings.update');
    Route::delete('kucings/{id_kucing}', [KucingAdminController::class, 'destroy'])->name('admin.kucings.destroy');
});


// Route untuk Customer
Route::prefix('customer')->middleware('auth', 'role:customer')->group(function () {
    Route::get('kucing', [KucingController::class, 'index'])->name('customer.kucing.index');
    Route::get('kucing/create', [KucingController::class, 'create'])->name('customer.kucing.create');
    Route::post('kucing', [KucingController::class, 'store'])->name('customer.kucing.store');
    Route::get('kucing/{id}/edit', [KucingController::class, 'edit'])->name('customer.kucing.edit');
    Route::put('kucing/{id}', [KucingController::class, 'update'])->name('customer.kucing.update');
    Route::delete('kucing/{id}', [KucingController::class, 'destroy'])->name('customer.kucing.destroy');

    Route::get('reservasi', [ReservasiController::class, 'index'])->name('customer.reservasi.index');
    Route::get('reservasi/create', [ReservasiController::class, 'create'])->name('customer.reservasi.create');
    Route::post('reservasi', [ReservasiController::class, 'store'])->name('customer.reservasi.store');
    Route::get('reservasi/{id}/edit', [ReservasiController::class, 'edit'])->name('customer.reservasi.edit');
    Route::put('reservasi/{id}', [ReservasiController::class, 'update'])->name('customer.reservasi.update');
    Route::delete('reservasi/{id}', [ReservasiController::class, 'destroy'])->name('customer.reservasi.destroy');

    Route::get('reservasi/bayar/{id}', [ReservasiController::class, 'bayarForm'])->name('customer.reservasi.bayar');
    Route::post('reservasi/bayar/{id}', [ReservasiController::class, 'prosesBayar'])->name('customer.reservasi.prosesBayar');
    Route::get('customer/reservasi/bayar', [ReservasiController::class, 'bayarForm'])->name('customer.reservasi.bayar');

    Route::get('tracking', [TrackingController::class, 'showCustomerTracking'])->name('customer.tracking.index');

});