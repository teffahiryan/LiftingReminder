<?php

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

// **** USER ****

Route::get('/tableau-de-bord', [MainController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/tableau-de-bord', [MainController::class, 'store'])->middleware('auth');

// **** USER SESSION ****

Route::middleware('auth')->controller(\App\Http\Controllers\SessionController::class)->name('user.session.')->group(function () {
    Route::get('/{session}/seance', 'show')->name('show');
    Route::post('/create/seance', 'store')->name('store');
    Route::post('{session}/edit', 'update')->name('update');
    Route::post('{session}/editExercises', 'updateExercise')->name('updateExercise');
    Route::post('{session}/{exercise}/editRSW', 'updateRSW')->name('updateRSW');
});

// **** USER EXERCISE ****

Route::middleware('auth')->controller(\App\Http\Controllers\ExerciseController::class)->name('user.exercise.')->group(function () {
    Route::get('/{exercise}/exercice', 'show')->name('show');
    Route::post('/create/exercice', 'store')->name('store');
    Route::post('{exercise}/edit', 'update')->name('update');
});

// **** ADMIN SESSION/EXERCISE ****

Route::resource('session', \App\Http\Controllers\Admin\SessionController::class)->middleware('auth');
Route::resource('exercise', \App\Http\Controllers\Admin\ExerciseController::class)->middleware('auth');

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
