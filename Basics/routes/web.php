<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Basics Query Practice
use App\Http\Controllers\PracticeQueries\BasicsController;

Route::get('basics/query/01', [BasicsController::class, 'query_01']);
Route::get('basics/query/02', [BasicsController::class, 'query_02']);
Route::get('basics/query/03', [BasicsController::class, 'query_03']);
Route::get('basics/query/04', [BasicsController::class, 'query_04']);