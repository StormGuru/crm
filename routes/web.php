<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\Admin\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/widget', [WidgetController::class, 'index']);


Route::middleware(['auth', 'role:admin|manager'])->group(function () {
    Route::get('/admin/tickets', [TicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{ticket}', [TicketController::class, 'show'])->name('admin.tickets.show');
    Route::patch('/admin/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('admin.tickets.updateStatus');
});