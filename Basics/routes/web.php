<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Basics Query Practice
use App\Http\Controllers\PracticeQueries\BasicsController;

// JOINS
Route::get('basics/joins/01', [BasicsController::class, 'joins_01']);
Route::get('basics/joins/02', [BasicsController::class, 'joins_02']);
Route::get('basics/joins/03', [BasicsController::class, 'joins_03']);
Route::get('basics/joins/04', [BasicsController::class, 'joins_04']);