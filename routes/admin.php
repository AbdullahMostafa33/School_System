<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\StageController;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/test', function () {
   
});
Route::resource('/stage', StageController::class);
Route::get('/grades/get', [GradeController::class, 'getGrades'])->name('grades.get');
Route::resource('/grades', GradeController::class);
Route::get('/classrooms/filter', [ClassroomController::class, 'filterclasses'])->name('classrooms.filter');
Route::get('/classrooms/get', [ClassroomController::class, 'getClassrooms'])->name('classrooms.get');
Route::resource('/classrooms', ClassroomController::class);
Route::post('/parents/validate-step', [ParentsController::class, 'validateStep'])->name('parents.validate_step');
Route::resource('/parents', ParentsController::class);





// change lang of website
Route::get('/lang', function (Request $request) {
    setcookie('lang', $request->lang, time() + 3600, "/");   
    return back();
})->name('lang');




