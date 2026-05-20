<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ValidationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    | Hanya admin yang boleh mengakses:
    | /events
    | /events/create
    | /events/{id}/edit
    | tambah, edit, hapus event
    */
    Route::middleware('admin')->group(function () {
        Route::resource('events', EventController::class);
    });


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    | User biasa hanya boleh melihat daftar event versi user,
    | pesan tiket, dan melihat tiket miliknya sendiri.
    */
    Route::get('/daftar-event', [TicketController::class, 'events'])->name('user.events');

    Route::get('/pesan-tiket/{event}', [TicketController::class, 'create']);
    Route::post('/pesan-tiket/{event}', [TicketController::class, 'store']);

    Route::get('/tiket-saya', [TicketController::class, 'myTickets']);


    /*
    |--------------------------------------------------------------------------
    | PETUGAS
    |--------------------------------------------------------------------------
    | Petugas hanya untuk validasi tiket.
    */
    Route::middleware('petugas')->group(function () {
        Route::get('/validasi-tiket', [ValidationController::class, 'index']);
        Route::post('/validasi-tiket', [ValidationController::class, 'check']);

        Route::get('/scan-tiket', [ValidationController::class, 'scan'])->name('tickets.scan');
        Route::post('/scan-tiket', [ValidationController::class, 'scanCheck'])->name('tickets.scan.check');
    });


    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';