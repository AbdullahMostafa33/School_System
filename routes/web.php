<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () 
{
    return view('dashboard');
})->middleware(['auth:admin,teacher,web', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test/guard', function () {
    if(Auth::guard('teacher')->check()){
        return 'iam teacher : '.Auth::guard('teacher')->user()->name;
    }
    elseif(Auth::guard('admin')->check()){  
        return 'iam admin : '.Auth::guard('admin')->user()->name;
    }
    elseif(Auth::check()){  return 'iam user : '.Auth::user()->name;}
    else return 'not auth';
});


require __DIR__.'/auth.php';

require __DIR__ . '/multi_auth.php';


