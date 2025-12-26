<?php

use Illuminate\Support\Facades\Route;

// 🔹 Import semua Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SabrangController;
use App\Http\Controllers\JebrangController;
use App\Http\Controllers\DabrangController;
use App\Http\Controllers\BaramController;
use App\Http\Controllers\BarakController;
use App\Http\Controllers\LapomController;
use App\Http\Controllers\LapokController;
use App\Http\Controllers\PodController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔸 Halaman Awal
Route::get('/', function () {
    return view('welcome');
});


// ====================================================================
// 🔹 AUTHENTICATION & PASSWORD
// ====================================================================

// Register & Login
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

// Forgot Password
Route::get('/reset-password', [ForgotPassController::class, 'showResetForm'])->name('password.request');
Route::post('/reset-password', [ForgotPassController::class, 'reset'])->name('password.reset');


// ====================================================================
// 🔹 ROUTE YANG BUTUH LOGIN (AUTH MIDDLEWARE)
// ====================================================================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Import Excel
    Route::get('/import-excel', [ExcelImportController::class, 'showImportForm'])->name('import.excel.form');
    Route::post('/import-excel', [ExcelImportController::class, 'import'])->name('import.excel');


    // ====================================================================
    // 🔹 MASTER DATA
    // ====================================================================

    // Employee
    Route::controller(EmployeeController::class)->prefix('employees')->group(function () {
        Route::get('', 'index')->name('employees');
        Route::get('create', 'create')->name('employees.create');
        Route::post('store', 'store')->name('employees.store');
        Route::get('show/{id}', 'show')->name('employees.show');
        Route::get('edit/{id}', 'edit')->name('employees.edit');
        Route::put('edit/{id}', 'update')->name('employees.update');
        Route::delete('delete/{id}', 'destroy')->name('employees.destroy');
    });

    // Supplier
    Route::controller(SupplierController::class)->prefix('suppliers')->group(function () {
        Route::get('', 'index')->name('suppliers');
        Route::get('create', 'create')->name('suppliers.create');
        Route::post('store', 'store')->name('suppliers.store');
        Route::get('show/{id}', 'show')->name('suppliers.show');
        Route::get('edit/{id}', 'edit')->name('suppliers.edit');
        Route::put('edit/{id}', 'update')->name('suppliers.update');
        Route::delete('delete/{id}', 'destroy')->name('suppliers.destroy');
    });

    // Satuan Barang (Sabrang)
    Route::controller(SabrangController::class)->prefix('sabrangs')->group(function () {
        Route::get('', 'index')->name('sabrangs');
        Route::get('create', 'create')->name('sabrangs.create');
        Route::post('store', 'store')->name('sabrangs.store');
        Route::get('show/{id}', 'show')->name('sabrangs.show');
        Route::get('edit/{id}', 'edit')->name('sabrangs.edit');
        Route::put('edit/{id}', 'update')->name('sabrangs.update');
        Route::delete('delete/{id}', 'destroy')->name('sabrangs.destroy');
    });

    // Jenis Barang (Jebrang)
    Route::controller(JebrangController::class)->prefix('jebrangs')->group(function () {
        Route::get('', 'index')->name('jebrangs');
        Route::get('create', 'create')->name('jebrangs.create');
        Route::post('store', 'store')->name('jebrangs.store');
        Route::get('show/{id}', 'show')->name('jebrangs.show');
        Route::get('edit/{id}', 'edit')->name('jebrangs.edit');
        Route::put('edit/{id}', 'update')->name('jebrangs.update');
        Route::delete('delete/{id}', 'destroy')->name('jebrangs.destroy');
    });

    // Data Barang (Dabrang)
    Route::controller(DabrangController::class)->prefix('dabrangs')->group(function () {
        Route::get('', 'index')->name('dabrangs');
        Route::get('create', 'create')->name('dabrangs.create');
        Route::post('store', 'store')->name('dabrangs.store');
        Route::get('show/{kode_barang}', 'show')->name('dabrangs.show');
        Route::get('edit/{id}', 'edit')->name('dabrangs.edit');
        Route::put('edit/{id}', 'update')->name('dabrangs.update');
        Route::delete('delete/{id}', 'destroy')->name('dabrangs.destroy');
    });


    // ====================================================================
    // 🔹 TRANSAKSI
    // ====================================================================

    // Barang Masuk (Baram)
    Route::controller(BaramController::class)->prefix('barams')->group(function () {
        Route::get('', 'index')->name('barams');
        Route::get('create', 'create')->name('barams.create');
        Route::post('store', 'store')->name('barams.store');
        Route::get('show/{id}', 'show')->name('barams.show');
        Route::get('edit/{id}', 'edit')->name('barams.edit');
        Route::put('edit/{id}', 'update')->name('barams.update');
        Route::delete('delete/{id}', 'destroy')->name('barams.destroy');
    });

    // Barang Keluar (Barak)
    Route::controller(BarakController::class)->prefix('baraks')->group(function () {
        Route::get('', 'index')->name('baraks');
        Route::get('create', 'create')->name('baraks.create');
        Route::post('store', 'store')->name('baraks.store');
        Route::get('show/{id}', 'show')->name('baraks.show');
        Route::get('edit/{id}', 'edit')->name('baraks.edit');
        Route::put('edit/{id}', 'update')->name('baraks.update');
        Route::delete('delete/{id}', 'destroy')->name('baraks.destroy');
    });

    // 🔹 POD (Planned Operational Daily) → CRUD

Route::controller(PodController::class)->prefix('pods')->group(function () {
    Route::get('', 'index')->name('pods');                // daftar POD
    Route::get('create', 'create')->name('pods.create');  // form tambah POD
    Route::post('store', 'store')->name('pods.store');    // simpan POD baru
    Route::get('show/{id}', 'show')->name('pods.show');   // detail POD
    Route::get('edit/{id}', 'edit')->name('pods.edit');   // form edit POD
    Route::put('edit/{id}', 'update')->name('pods.update'); // update POD
    Route::delete('delete/{id}', 'destroy')->name('pods.destroy'); // hapus POD

     Route::get('export/pdf', 'exportPdf')->name('pods.export.pdf');
    Route::get('export/excel', 'exportExcel')->name('pods.export.excel');
});

    // ====================================================================
    // 🔹 LAPORAN
    // ====================================================================

    // Laporan Barang Masuk & Keluar
    Route::get('/laporan/masuk', [LaporanController::class, 'barangMasuk'])->name('laporan.masuk');
    Route::get('/laporan/keluar', [LaporanController::class, 'barangKeluar'])->name('laporan.keluar');

    // Export Laporan (Excel & PDF)
    Route::get('/laporan/barang-masuk/excel', [LaporanController::class, 'exportBarangMasukExcel'])->name('laporan.excel_masuk');
    Route::get('/laporan/barang-masuk/pdf', [LaporanController::class, 'exportBarangMasukPDF'])->name('laporan.pdf_masuk');
    Route::get('/laporan/barang-keluar/excel', [LaporanController::class, 'exportBarangKeluarExcel'])->name('laporan.excel_keluar');
    Route::get('/laporan/barang-keluar/pdf', [LaporanController::class, 'exportBarangKeluarPDF'])->name('laporan.pdf_keluar');

    // Laporan Masuk (Lapom)
    Route::controller(LapomController::class)->prefix('lapoms')->group(function () {
        Route::get('', 'index')->name('lapoms');
        Route::get('create', 'create')->name('lapoms.create');
        Route::post('store', 'store')->name('lapoms.store');
        Route::get('show/{id}', 'show')->name('lapoms.show');
        Route::get('edit/{id}', 'edit')->name('lapoms.edit');
        Route::put('edit/{id}', 'update')->name('lapoms.update');
        Route::delete('delete/{id}', 'destroy')->name('lapoms.destroy');
    });

    // Laporan Keluar (Lapok)
    Route::controller(LapokController::class)->prefix('lapoks')->group(function () {
        Route::get('', 'index')->name('lapoks');
        Route::get('create', 'create')->name('lapoks.create');
        Route::post('store', 'store')->name('lapoks.store');
        Route::get('show/{id}', 'show')->name('lapoks.show');
        Route::get('edit/{id}', 'edit')->name('lapoks.edit');
        Route::put('edit/{id}', 'update')->name('lapoks.update');
        Route::delete('delete/{id}', 'destroy')->name('lapoks.destroy');
    });


    // ====================================================================
    // 🔹 PROFIL USER
    // ====================================================================

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');
});