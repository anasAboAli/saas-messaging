<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/send', [MessageController::class, 'send']);
});

