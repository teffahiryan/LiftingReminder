<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware('auth')->group(function () { 

    // **** USER ****
 
    Route::get('/tableau-de-bord', [MainController::class, 'dashboard'])->name('dashboard');
    Route::post('/tableau-de-bord', [MainController::class, 'store']);

    Route::get('/communaute', [MainController::class, 'shared'])->name('shared');
    Route::get('/{exercise}/exercice-communaute', [MainController::class, 'showShared'])->name('shared.show');

    Route::name('user.')->group(function () { 

        // **** USER SESSION ****

        Route::controller(\App\Http\Controllers\SessionController::class)->group(function () {
            Route::resource('session', \App\Http\Controllers\SessionController::class)->except(['index', 'create', 'edit']);
            // ADDITIONALS
            Route::post('{session}/editExercises', 'updateExercise')->name('session.updateExercise');
            Route::post('{session}/{exercise}/editRSW', 'updateRSW')->name('session.updateRSW');
        });

        // **** USER EXERCISE ****

        Route::controller(\App\Http\Controllers\ExerciseController::class)->group(function () {
            Route::resource('exercise', \App\Http\Controllers\ExerciseController::class)->except(['index', 'create', 'edit']);
            // ADDITIONALS
            Route::get('{exercise}/copy', 'exercise.shared')->name('exercise.copy');
        });

    });

});

// **** ADMIN SESSION/EXERCISE/TIPS ****

Route::name('admin.')->middleware('admin')->group(function (){ 
    Route::get('admin', [AdminController::class, 'index'])->name('index');
    Route::resource('admin/session', \App\Http\Controllers\Admin\SessionController::class);
    Route::resource('admin/exercise', \App\Http\Controllers\Admin\ExerciseController::class);
    Route::resource('admin/tip', \App\Http\Controllers\Admin\TipController::class);
});


// **** AUTH ****

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
