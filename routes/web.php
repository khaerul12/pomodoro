<?php

use App\Http\Controllers\PomodoroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PomodoroController::class, 'index']);
Route::post('/', [PomodoroController::class, 'store']);
Route::resource('pomodoro', PomodoroController::class);