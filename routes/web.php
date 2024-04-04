<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PdfController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/admin', [AdminController::class,'admin'])->name('admin');
// admin

Route::get('/addcategory', [CategoryController::class,'addcategory'])->name('addcategory');
Route::get('/categories', [CategoryController::class,'categories'])->name('categories');
Route::post('/savecategory', [CategoryController::class,'savecategory'])->name('savecategory');
Route::get('/edit_category/{id}', [CategoryController::class,'edit_category'])->name('edit_category'); 
Route::post('/updatecategory', [CategoryController::class,'updatecategory'])->name('updatecategory');
Route::get('/deletecategory/{id}', [CategoryController::class,'deletecategory'])->name('deletecategory');


// sliders
Route::get('/addslider', [SliderController::class,'addslider'])->name('addslider');
Route::get('/sliders', [SliderController::class,'sliders'])->name('sliders');
Route::post('/saveslider', [SliderController::class,'saveslider'])->name('saveslider');
Route::get('/editslider/{id}', [SliderController::class,'editslider'])->name('editslider'); 
Route::post('/updateslider', [SliderController::class,'updateslider'])->name('updateslider');
Route::get('/deleteslider/{id}', [SliderController::class,'deleteslider'])->name('deleteslider');
Route::get('/activateslider/{id}', [SliderController::class,'activateslider'])->name('activateslider'); 
Route::get('/unactivateslider/{id}', [SliderController::class,'unactivateslider'])->name('unactivateslider'); 





//product
Route::get('/addproduct', [ProductController::class,'addproduct'])->name('addproduct');
Route::get('/products', [ProductController::class,'products'])->name('products');
Route::post('/saveproduct', [ProductController::class,'saveproduct'])->name('saveproduct');
Route::get('/editproduct/{id}', [ProductController::class,'editproduct'])->name('editproduct'); 
Route::post('/updateproduct', [ProductController::class,'updateproduct'])->name('updateproduct');
Route::get('/deleteproduct/{id}', [ProductController::class,'deleteproduct'])->name('deleteproduct');
Route::get('/activateproduct/{id}', [ProductController::class,'activateproduct'])->name('activateproduct'); 
Route::get('/unactivateproduct/{id}', [ProductController::class,'unactivateproduct'])->name('unactivateproduct'); 
Route::get('/view_product_by_category/{category_name}', [ProductController::class,'view_product_by_category'])->name('view_product_by_category ');


//oders
Route::get('/orders', [ClientController::class,'orders'])->name('orders');
Route::post('/postcheckout', [ClientController::class,'postcheckout'])->name('postcheckout');
Route::get('/payment-success', [ClientController::class,'payment_success']);

Route::get('/view_pdforder/{id}', [PdfController::class,'view_pdf']);

// client
Route::get('/', [ClientController::class,'home'])->name('home');
Route::get('/shop', [ClientController::class,'shop'])->name('shop');
Route::get('/addtocart/{id}', [ClientController::class,'addtocart'])->name('addtocart');
Route::post('/update_qty/{id}', [ClientController::class,'update_qty'])->name('update_qty');
Route::get('/remove_from_cart/{id}', [ClientController::class,'remove_from_cart'])->name('remove_from_cart');
Route::get('/cart', [ClientController::class,'cart'])->name('cart');
Route::get('/checkout', [ClientController::class,'checkout'])->name('checkout');
Route::get('/login', [ClientController::class,'login'])->name('login');
Route::get('/signup', [ClientController::class,'signup'])->name('signup');
Route::post('/create_account', [ClientController::class,'create_account'])->name('create_account');
Route::post('/access_account', [ClientController::class,'access_account'])->name('access_account');
Route::get('/logout', [ClientController::class,'logout'])->name('logout');
/*
Route::get('/dashboard', function () { 
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php'; */
