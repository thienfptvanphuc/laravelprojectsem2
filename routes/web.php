<?php

use Illuminate\Support\Facades\Route;
// Route FE
use App\Http\Controllers\fe\RentalController;
use App\Http\Controllers\fe\CarRatingController;
use App\Http\Controllers\fe\CarAccountController;

// Route BE
use App\Http\Controllers\fe\HomeController;
use App\Http\Controllers\be\AdminController;
use App\Http\Controllers\be\CategoryController;
use App\Http\Controllers\be\ProductController;
use App\Http\Controllers\be\ParentController;
use App\Http\Controllers\be\AccountController;
use App\Http\Controllers\be\BeCarRatingController;
use App\Http\Controllers\be\RentalManagement;
use App\Http\Middleware\PhanQuyen;


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
Route::post('/product/{id}/rate', [CarRatingController::class, 'rate'])->name('fe.rate');
Route::middleware('auth')->get('/rate/{car}/form', [CarRatingController::class, 'showRatingForm'])->name('showRatingForm');


Route::match(['get', 'post'], '/', [HomeController::class, 'home'])->name('fe.home');
Route::get('/about-us', [HomeController::class, 'aboutus'])->name('fe.aboutus');
Route::get('/contact-us', [HomeController::class, 'contactus'])->name('fe.contactus');

// route category
Route::get("/category/{key}", [HomeController::class, 'category'])->name("fe.category");
// route detail
Route::match(['get', 'post'],"/product/{name}/{key}", [HomeController::class, 'detail'])->name("fe.detail");

// ROUTE FOR USER
//Register
Route::match(['get', 'post'], '/register', [CarAccountController::class, 'register'])->name('fe.register');
// Route login
Route::match(['get', 'post'], '/login', [CarAccountController::class, 'login'])->name('fe.login');
// logout
Route::get("/logout.html", [CarAccountController::class, 'logout'])->name('fe.logout');


// Route Rental
// Search
Route::match(['get', 'post'],'/search/{pk?}/{rt?}/{ct?}', [RentalController::class, 'search'])->name('fe.search');
Route::match(['get','post'],'/rental', [RentalController::class,'rental'])->name('fe.rental');
Route::match(['get','post'],'/payment', [RentalController::class,'payment'])->name('fe.payment');
//Thong bao
Route::get('/noti', [RentalController::class,'noti'])->name('fe.noti');
Route::get('/profile-user', [HomeController::class,'profile_user'])->name('fe.profile_user');



//SYSTEM: 
Route::middleware(PhanQuyen::class)->prefix('system')->group(function () {
   //Admin
   Route::get('/', [AdminController::class, 'index'])->name('be.main');
   Route::match(['get', 'post'], '/admin/profile', [AdminController::class, 'profile'])->name('be.admin.profile');
   //Account
   // page account
   Route::get("/account", [AccountController::class, 'index'])->name("be.account");
   // route trang add category chạy 2 phương thức get post cùng lúc bằng match
   Route::match(['get', 'post'], 'account/add.html', [AccountController::class, 'add'])->name('be.accountadd');
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

   //Download QR_Code
   Route::get("/download/qrcode/{filename}", [ProductController::class, 'downloadQRCode'])->name("download.qrcode");
   

   //Rating
   Route::get("/rating", [BeCarRatingController::class, "rating"])->name("be.rating");

   //Rental & Bills
   Route::get('/rental',[RentalManagement::class,'index'])->name('be.rental');
   Route::match(['get','post'],'/rental/detail/id={id}',[RentalManagement::class,'detail'])->name('be.rental-detail');
   Route::match(['get','post'],'/rental/add-new',[RentalManagement::class,'addnew'])->name('be.rental-add');
   Route::get('/rental/del/{key}',[RentalManagement::class,'del'])->name('be.rental-del');


});
