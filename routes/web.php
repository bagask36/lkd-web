<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KalibrasiController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\InstalasiController;
use App\Http\Controllers\LaporanKalibrasiController;
use App\Http\Controllers\LaporanMaintenanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes
    Route::get('/kalibrasi/export', [KalibrasiController::class, 'export'])->name('kalibrasi.export');
    Route::resource('kalibrasi', KalibrasiController::class);
    Route::resource('maintenance', MaintenanceController::class);
    Route::resource('instalasi', InstalasiController::class);
    
    // Rute khusus untuk halaman "Cari Laporan"
    // Ini akan menampilkan view tanpa data, hanya form pencarian
    Route::get('/laporan/cari', [LaporanKalibrasiController::class, 'searchOnly'])->name('laporan.search_only');
    
    Route::get('/laporan/download/{laporan}', [LaporanKalibrasiController::class, 'download'])->name('laporan.download');
    // Rute untuk menampilkan hasil pencarian
    // Ini akan mengambil data dan menampilkannya di halaman khusus pencarian
    Route::get('/laporan/hasil-cari', [LaporanKalibrasiController::class, 'searchResults'])->name('laporan.search_results');
    
    // Rute untuk manajemen laporan (tambah, edit, hapus, dan tampilkan semua)
    Route::resource('laporan', LaporanKalibrasiController::class)->except(['index']);
    Route::get('/laporan', [LaporanKalibrasiController::class, 'index'])->name('laporan.index');
    
    Route::resource('laporan-maintenance', LaporanMaintenanceController::class);
});

require __DIR__.'/auth.php';
