<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemutakhiranController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\PendataanExportController;
use App\Http\Controllers\PemutakhiranExportController;

Route::get('/', function () {
    return redirect('/dashboard');
});

/// Export Pendataan
Route::get('/pendataan/export', [PendataanExportController::class, 'exportCsv'])->name('pendataan.export');

// Export Pemutakhiran
Route::get('/pemutakhiran/export', [PemutakhiranExportController::class, 'exportCsv'])->name('pemutakhiran.export');

// Routes untuk CRUD Pemutakhiran
Route::resource('pemutakhiran', PemutakhiranController::class);

// Routes untuk CRUD Pendataan
Route::resource('pendataan', PendataanController::class);

// Route untuk dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route untuk rekap pemutakhiran
Route::get('/rekap-pemutakhiran', [PemutakhiranController::class, 'rekap'])->name('pemutakhiran.rekap');
