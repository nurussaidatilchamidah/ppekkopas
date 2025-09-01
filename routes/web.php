<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemutakhiranController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\PendataanExportController;
use App\Http\Controllers\PemutakhiranExportController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TabulasiController;

Route::get('/', function () {
    return redirect('/dashboard');
});

/// Export Pendataan
Route::get('/pendataan/export', [PendataanExportController::class, 'exportCsv'])->name('pendataan.export');

// Export Pemutakhiran
Route::get('/pemutakhiran/export', [PemutakhiranExportController::class, 'exportCsv'])->name('pemutakhiran.export');

// Routes untuk CRUD Pemutakhiran
Route::resource('pemutakhiran', PemutakhiranController::class);

// Route untuk Tabulasi
Route::get('/pendataan/tabulasi', [TabulasiController::class, 'tabulasi'])->name('pendataan.tabulasi');

// Routes untuk CRUD Pendataan
Route::resource('pendataan', PendataanController::class);

// Route untuk dashboard
Route::get('/dashboard', [LandingPageController::class, 'index'])->name('dashboard');

// Route untuk rekap pemutakhiran
Route::get('/rekap-pemutakhiran', [PemutakhiranController::class, 'rekap'])->name('pemutakhiran.rekap');

