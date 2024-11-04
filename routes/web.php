<?php

use App\Http\Controllers\PomodoroController;

Route::get('/pomodoro', [PomodoroController::class, 'index']);
Route::post('/pomodoro', [PomodoroController::class, 'store']);
Route::resource('pomodoro', PomodoroController::class);