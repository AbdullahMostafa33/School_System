<?php

use App\Http\Controllers\Auth_teacher\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;


// teacher auth
Route::middleware('guest:teacher')->prefix('teacher')->name('teacher.')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
});
// Route::get('teacher/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->name('teacher.logout');

