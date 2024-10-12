<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StatgeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('components.sidebar');
});
Route::resource('/statge', StatgeController::class);
Route::get('/grades/get', [GradeController::class, 'getGrades'])->name('grades.get');
Route::resource('/grades', GradeController::class);
Route::get('/classrooms/filter', [ClassroomController::class, 'filterclasses'])->name('classrooms.filter');
Route::resource('/classrooms', ClassroomController::class);



// change lang of website
Route::get('/lang', function (Request $request) {
    setcookie('lang', $request->lang, time() + 3600, "/");   
    return back();
})->name('lang');




