<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [\App\Http\Controllers\LandingPageController::class, 'index'])->name('landing-page');
