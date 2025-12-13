<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/widget', [WidgetController::class, 'index']);