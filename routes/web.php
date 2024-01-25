<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fe\HomeController;
use App\Http\Controllers\be\AdminController;
use App\Http\Controllers\fe\RentalController;
use App\Http\Controllers\be\CategoryController;
use App\Http\Controllers\be\ProductController;
use App\Http\Controllers\be\ParentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Website:
Route::get('/', [HomeController::class, 'home'])->name('fe.home');
Route::get('/about-us', [HomeController::class, 'aboutus'])->name('fe.aboutus');
Route::get('/contact-us', [HomeController::class, 'contactus'])->name('fe.contactus');
Route::match(['get', 'post'], '/rental', [RentalController::class, 'rental'])->name('fe.rental');
Route::match(['get', 'post'], '/payment', [RentalController::class, 'payment'])->name('fe.payment');
// route category
Route::get("/category/{key}.html", [HomeController::class, 'category'])->name("fe.category");
// route detail
Route::get("/product/{name}/{key}.html", [HomeController::class, 'detail'])->name("fe.detail");



//System: 
Route::prefix('system')->group(function () {
   Route::get('/', [AdminController::class, 'index'])->name('be.main');
   // Category
   // page category
   Route::get("/category", [CategoryController::class, 'index'])->name("be.category");
   // route trang add category chạy 2 phương thức get post cùng lúc bằng match
   Route::match(['get', 'post'], 'category/add.html', [CategoryController::class, 'add'])->name('be.categoryadd');
   // route trang Update category chạy 2 phương thức get post cùng lúc bằng match
   Route::match(['get', 'post'], 'category/edit/{key}.html', [CategoryController::class, 'edit'])->name('be.categoryedit');
   // delete route
   Route::get("/category/del/{key}.html", [CategoryController::class, 'del'])->name("be.categorydel");

   //Product
   // Route Products
   Route::get("/product", [ProductController::class, "index"])->name("be.product");
   // route add product
   Route::match(['get', 'post'], 'product/add.html', [ProductController::class, 'add'])->name('be.productadd');
   // route edit product
   Route::match(['get', 'post'], 'product/edit/{key}.html', [ProductController::class, 'edit'])->name('be.productedit');
   // route delete product
   Route::get("/product/del/{key}.html", [ProductController::class, 'del'])->name("be.productdel");
});
