<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {



    // profile urls
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // profile urls ends


    // ai dashboard and generation urls
    Route::get('/dashboard', [AIController::class, 'index'])->name('dashboard');
   
    // ai dashboard and generation urls end here
   
    Route::post('/generate-response', [AIController::class, 'generateResponse'])
    ->name('generate.response')
    ->middleware('throttle:5,1');
    // response can only be generated 5 times in a minute using 5,1 throttle






});

require __DIR__ . '/auth.php';
