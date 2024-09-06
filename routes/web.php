<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


//Frontend
Route::get('/', [FrontendController::class, 'index']);
Route::get('/product/details', [FrontendController::class, 'productDetails']);
Route::get('/view-cart', [FrontendController::class,'viewCart']);
Route::get('/checkout', [FrontendController::class,'checkout']);
Route::get('/shop', [FrontendController::class,'shop']);
Route::get('/return/process', [FrontendController::class,'returnProcess']);
Route::get('/privacy/policy', [FrontendController::class,'privacyPolicy']);
Route::get('/category', [FrontendController::class,'category']);
Route::get('/sub/category', [FrontendController::class,'subCategory']);
Route::get('/view/all', [FrontendController::class,'viewAll']);
Route::get('/view/all', [FrontendController::class,'viewAll']);
Route::get('/thank/you', [FrontendController::class,'thankYou']);

Auth::routes();

//Admin Login Url
Route::get('/admin/login', [AuthController::class, 'adminLogin'])->name('adminLogin');

//Admin Pannel
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');

//Product Routes
Route::get('/admin/create-product', [ProductController::class, 'create'])->name('product.create');
