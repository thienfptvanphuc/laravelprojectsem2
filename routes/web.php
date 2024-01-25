<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fe\HomeController;
use App\Http\Controllers\be\AdminController;
use App\Http\Controllers\fe\RentalController;
use App\Http\Controllers\be\RentalManagement;

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
Route::get('/', [HomeController::class,'home'])->name('fe.home');
Route::get('/about-us', [HomeController::class,'aboutus'])->name('fe.aboutus');
Route::get('/contact-us', [HomeController::class,'contactus'])->name('fe.contactus');
Route::match(['get','post'],'/rental', [RentalController::class,'rental'])->name('fe.rental');
Route::match(['get','post'],'/payment', [RentalController::class,'payment'])->name('fe.payment');
Route::match(['get','post'],'/list', [RentalController::class,'list'])->name('fe.list');
Route::match(['get','post'],'/detail/{key}', [RentalController::class,'cardetail'])->name('fe.cardetail');

//System: 
Route::prefix('system')->group(function() {
   Route::get('/',[AdminController::class,'index'])->name('be.main');
   //Rental 
   Route::get('/rental',[RentalManagement::class,'index'])->name('be.rental');
   Route::match(['get','post'],'/rental/detail/id={id}',[RentalManagement::class,'detail'])->name('be.rental-detail');
   Route::match(['get','post'],'/rental/add-new',[RentalManagement::class,'addnew'])->name('be.rental-add');
   Route::get('/product/del/{key}',[RentalManagement::class,'del'])->name('be.rental-del');

});
