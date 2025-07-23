<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemutakhiranController;
use App\Http\Controllers\PendataanController;

Route::get('/', function () {
    return redirect('/dashboard');
});

// Routes untuk CRUD Pemutakhiran
Route::resource('pemutakhiran', PemutakhiranController::class);

// Routes untuk CRUD Pendataan
Route::resource('pendataan', PendataanController::class);

// Route untuk dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



