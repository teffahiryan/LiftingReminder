<?php

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

// **** SESSION ****

Route::resource('session', \App\Http\Controllers\SessionController::class)->middleware('auth');

// Route::prefix('/session')->name('session.')->controller(SessionController::class)->group(function (){
    
//     Route::get('/', 'index')->name('index');
//     Route::get('/{session}/show', 'show')->name('show');

//     Route::get('/new', 'create')->name('create');
//     Route::post('/new', 'store');

//     Route::get('/{session}/edit', 'edit')->name('edit');
//     Route::post('/{session}/update', 'update');

//     Route::post('/{session}/delete', 'destroy')->name('delete');

// });

// **** AUTH ****

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
