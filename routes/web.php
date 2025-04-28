<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BidanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RiwayatBidanController;
use App\Http\Controllers\InboxController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
// Rute untuk bidan
Route::middleware(['auth', 'role:bidan'])->group(function () {
    Route::get('/bidan/dashboard', [DashboardController::class, 'bidan'])->name('bidan.dashboard');

    Route::get('/bidan/antrean', [BidanController::class, 'antreanBidan'])->name('bidan.antrean');

    Route::get('/bidan/periksa/{id}', [BidanController::class, 'periksa'])->name('bidan.periksa');

    // Route::get('/bidan/periksa/{id}', [BidanController::class, 'periksa'])->name('bidan.periksa');
    // Route::post('/bidan/periksa/{id}', [BidanController::class, 'mulaiPeriksa'])->name('bidan.mulaiPeriksa');


    Route::post('/bidan/periksa/anc/{id}', [BidanController::class, 'simpanAnc'])->name('bidan.periksa.anc.simpan');

    Route::get('/bidan/obat/{id}', [BidanController::class, 'formObat'])->name('bidan.obat.form');
    Route::post('/bidan/obat/{id}', [BidanController::class, 'simpanObat'])->name('bidan.obat.simpan');

    // Riwayat Pemeriksaan
    Route::get('/bidan/riwayat/kebidanan', [RiwayatBidanController::class, 'kebidanan'])->name('bidan.riwayat.kebidanan');
    Route::get('/bidan/riwayat/bayi', [RiwayatBidanController::class, 'bayi'])->name('bidan.riwayat.bayi');
    Route::get('/bidan/riwayat/umum', [RiwayatBidanController::class, 'umum'])->name('bidan.riwayat.umum');
    Route::get('/bidan/riwayat/semua', [RiwayatBidanController::class, 'semua'])->name('bidan.riwayat.semua');

    Route::get('/bidan/riwayat/detail/{service}', [RiwayatBidanController::class, 'detail'])->name('bidan.riwayat.detail');

    Route::get('/bidan/riwayat/cetak/{service}', [RiwayatBidanController::class, 'cetak'])->name('bidan.riwayat.cetak');

});
// Rute untuk asisten
Route::middleware(['auth', 'role:asisten'])->group(function () {
    Route::get('/asisten/dashboard', [DashboardController::class, 'asisten'])->name('asisten.dashboard');

    Route::post('/asisten/patient/{id}/register-service', [PatientController::class, 'registerService'])->name('asisten.patient.register-service');
    Route::get('/asisten/kunjungan-hari-ini', [PatientController::class, 'kunjunganHariIni'])->name('asisten.kunjungan');

    Route::get('/asisten/inbox', [InboxController::class, 'index'])->name('asisten.inbox');

    Route::get('/asisten/resep/anc/{id}', [InboxController::class, 'lihatResepANC'])->name('asisten.resep.anc');

    Route::post('/asisten/inbox/selesai/{id}', [InboxController::class, 'selesaikanKunjungan'])->name('asisten.selesai.kunjungan');

    // Rute lengkap CRUD Pasien
    Route::get('/asisten/patients', [PatientController::class, 'index'])->name('asisten.patients.index');
    Route::get('/asisten/patients/create', [PatientController::class, 'create'])->name('asisten.patients.create');
    Route::post('/asisten/patients', [PatientController::class, 'store'])->name('asisten.patients.store');
    Route::get('/asisten/patients/{patient}/edit', [PatientController::class, 'edit'])->name('asisten.patients.edit');
    Route::put('/asisten/patients/{patient}', [PatientController::class, 'update'])->name('asisten.patients.update');
    Route::delete('/asisten/patients/{patient}', [PatientController::class, 'destroy'])->name('asisten.patients.destroy');

    Route::post('/asisten/kunjungan/register-service', [PatientController::class, 'registerService'])->name('asisten.register.service');

    // Riwayat Pemeriksaan
    Route::get('/asisten/riwayat/kebidanan', [RiwayatController::class, 'kebidanan'])->name('asisten.riwayat.kebidanan');
    Route::get('/asisten/riwayat/bayi', [RiwayatController::class, 'bayi'])->name('asisten.riwayat.bayi');
    Route::get('/asisten/riwayat/umum', [RiwayatController::class, 'umum'])->name('asisten.riwayat.umum');
    Route::get('/asisten/riwayat/semua', [RiwayatController::class, 'semua'])->name('asisten.riwayat.semua');

    Route::get('/asisten/riwayat/detail/{service}', [RiwayatController::class, 'detail'])->name('asisten.riwayat.detail');

    Route::get('/asisten/riwayat/cetak/{service}', [RiwayatController::class, 'cetak'])->name('asisten.riwayat.cetak');

});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');