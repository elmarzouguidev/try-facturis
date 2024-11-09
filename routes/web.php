<?php

use App\Http\Controllers\Facturis\Try\TryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [TryController::class, 'index'])->name('try.get');
Route::post('/', [TryController::class, 'store'])->name('try.post');