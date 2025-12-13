<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\Admin\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/widget', [WidgetController::class, 'index']);
Route::get('/admin/tickets', [TicketController::class, 'index'])
     ->name('admin.tickets.index');;
Route::get('/admin/tickets/{ticket}', [TicketController::class, 'show'])
    ->name('admin.tickets.show');
Route::patch('/admin/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
    ->name('admin.tickets.updateStatus');