<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


//Frontend
Route::get('/', [FrontendController::class, 'index']);
Route::get('/product/details/{slug}', [FrontendController::class, 'productDetails']);
Route::get('/view-cart', [FrontendController::class,'viewCart']);
Route::get('/checkout', [FrontendController::class,'checkout']);
Route::get('/shop', [FrontendController::class,'shop']);
Route::get('/return/process', [FrontendController::class,'returnProcess']);
Route::get('/privacy/policy', [FrontendController::class,'privacyPolicy']);
Route::get('/sub/category', [FrontendController::class,'subCategory']);
Route::get('/view/all', [FrontendController::class,'viewAll']);
Route::get('/view/all', [FrontendController::class,'viewAll']);
Route::get('/thank/you', [FrontendController::class,'thankYou']);
Route::get('/add-to-cart/{id}', [FrontendController::class,'addToCart']);
Route::get('/add-to-cart/delete/{id}', [FrontendController::class,'addToCartDelete']);
Route::post('/add-to-cart/details/{id}', [FrontendController::class,'addToCartDetails']);
Route::post('/confirm-order', [FrontendController::class,'confirmOrder']);

//Category Products...
Route::get('/category-products/{slug}/{id}', [FrontendController::class,'categoryProducts']);
Route::get('/subcategory-products/{slug}/{id}', [FrontendController::class,'subCategoryProducts']);

Auth::routes();

//Admin Login Url
Route::get('/admin/login', [AuthController::class, 'adminLogin'])->name('adminLogin');

//Admin Pannel
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');

//Product Routes
Route::get('/admin/create-product', [ProductController::class, 'create'])->name('product.create');
Route::post('/admin/store-product', [ProductController::class, 'store'])->name('product.store');
Route::get('/admin/show-product', [ProductController::class, 'show'])->name('product.show');
Route::get('/admin/delete-product/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/admin/update-product/{id}', [ProductController::class, 'update'])->name('product.update');

//Category Routes
Route::get('/admin/create-category', [CategoryController::class, 'create'])->name('category.create');
Route::post('/admin/store-category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/show-category', [CategoryController::class, 'show'])->name('category.show');
Route::get('/admin/delete-category/{id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::get('/admin/edit-category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/admin/update-category/{id}', [CategoryController::class, 'update'])->name('category.update');

//Sub Category Routes
Route::get('/admin/create-subcategory',[SubCategoryController::class,'create'])->name('subcategory.create');
Route::post('/admin/store-subcategory', [SubCategoryController::class, 'store'])->name('subcategory.store');
Route::get('/admin/show-subcategory',[SubCategoryController::class, 'show'])->name('subcategory.show');
Route::get('/admin/delete-subcategory/{id}',[SubCategoryController::class, 'delete'])->name('subcategory.delete');
Route::get('/admin/edit-subcategory/{id}',[SubCategoryController::class, 'edit'])->name('subcategory.edit');
Route::post('/admin/update-subcategory/{id}',[SubCategoryController::class, 'update'])->name('subcategory.update');