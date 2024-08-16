<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index']);
Route::get('/product/details', [FrontendController::class, 'productDetails']);
Route::get('/view-cart', [FrontendController::class,'viewCart']);
Route::get('/checkout', [FrontendController::class,'checkout']);
Route::get('/shop', [FrontendController::class,'shop']);
Route::get('/return/process', [FrontendController::class,'returnProcess']);
Route::get('/privacy/policy', [FrontendController::class,'privacyPolicy']);
Route::get('/category', [FrontendController::class,'category']);
