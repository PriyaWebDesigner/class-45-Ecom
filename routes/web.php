<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index']);
Route::get('/contact', [FrontendController::class, 'contact']);