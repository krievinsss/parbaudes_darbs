<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile (Breeze default)
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Customers CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource('customers', CustomerController::class)->except(['show']);


    /*
    |--------------------------------------------------------------------------
    | Orders CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource('orders', OrderController::class)->except(['show']);

});

require __DIR__.'/auth.php';