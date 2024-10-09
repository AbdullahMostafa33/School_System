<?php

use App\Http\Controllers\ProfileController;
use App\Models\Statge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () 
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



use Illuminate\Support\Facades\App;

// Route::get('/', function () {
//     // dd(app()->getLocale());
//     return view('dashboard');
// });


// Route::get('/greeting/{locale}', function (string $locale) {
//     if (! in_array($locale, ['en', 'ar'])) {
//         abort(400);
//     }

//     App::setLocale($locale);

//     $statges = Statge::all();
//     return view('admin.statge', compact('statges'));

// });

