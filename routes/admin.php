<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Distribute_Specilties;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OnlineClassController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SpecialtyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('/teachers', TeacherController::class);
Route::get('/students/move',[StudentController::class, 'showMove'])->name('students.move');
Route::post('/students/move', [StudentController::class, 'move'])->name('students.move');
Route::get('/students/selection/delete', [StudentController::class, 'delete_selection'])->name('students.Selection.delete');
Route::get('/students/graduates', [StudentController::class, 'graduate_students'])->name('students.graduates');
Route::get('/students/graduates/show', [StudentController::class, 'show_graduates'])->name('students.graduates.show');
Route::post('/students/{id}/restore', [StudentController::class, 'restore_student'])->name('students.restore');
Route::resource('/students', StudentController::class);

Route::post('/fees/delelte_selection', [FeeController::class, 'delelte_selection'])->name('fees.delelte.selection');
Route::resource('/fees', FeeController::class);

Route::post('/invoices/delelte_selection', [InvoiceController::class, 'delelte_selection'])->name('invoices.delelte.selection');
Route::resource('/invoices', InvoiceController::class);

Route::delete('/specialties/delete_selection', [SpecialtyController::class, 'delete_selection'])->name('specialties.delete.selection');
Route::resource('/specialties', SpecialtyController::class);

Route::resource('/distribute/specialties', Distribute_Specilties::class)->names('distribute.specialties');

Route::resource('/onlineClass', OnlineClassController::class);

// change lang of website
Route::get('/lang', function (Request $request) {
    setcookie('lang', $request->lang, time() + 3600, "/");   
    return back();
})->name('lang');




