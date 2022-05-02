<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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



Route::get('/admin', [AdminController::class, 'product'])
    ->name('admin.product');

Route::get('/admin/productDetails{id}', [AdminController::class, 'productDetails']) 
    ->name('admin.productDetails');

Route::put('/admin/product/updateProduct{id}', [AdminController::class, 'updateProduct'])
    ->name('admin.updateProduct');

Route::delete('/admin/product/deleteReview{idReview}{idProduct}', [AdminController::class, 'deleteReview'])
    ->name('admin.deleteReview');

Route::post('/admin/product/addProduct', [AdminController::class, 'addProduct'])
    ->name('admin.addProduct');

Route::delete('/admin/product/deleteProduct{id}', [AdminController::class, 'deleteProduct'])
    ->name('admin.deleteProduct');

Route::get('/admin/order', [AdminController::class, 'order'])
    ->name('admin.order');

Route::get('/', [UserController::class, 'index'])
    ->name('user.index');

Route::get('/user/show{id}', [UserController::class, 'show'])
    ->name('user.show');

Route::post('/user/index/addCart{id}', [UserController::class, 'addCartIndex'])
    ->name('user.index.addCart');

Route::post('/user/show/addCart{id}', [UserController::class, 'addCartShow'])
    ->name('user.show.addCart');

Route::get('/user/viewCart', [UserController::class, 'viewCart'])
    ->name('user.viewCart');

Route::post('/user/increaseQuantity{id}', [UserController::class, 'increaseQuantity'])
    ->name('user.increaseQuantity');

Route::post('/user/decreaseQuantity{id}', [UserController::class, 'decreaseQuantity'])
    ->name('user.decreaseQuantity');

Route::delete('/user/removeFromCart{id}', [UserController::class, 'removeFromCart'])
    ->name('user.removeFromCart');
    
Route::get('/user/searchForProducts', [UserController::class, 'searchForProducts'])
    ->name('user.searchForProducts');

Route::get('/user/checkout', [UserController::class, 'checkOut'])
    ->name('user.checkout');

Route::post('/user/checkout/placeOrder', [UserController::class, 'placeOrder'])
    ->name('user.placeOrder');

Route::get('/user/contact', [UserController::class, 'contact'])
    ->name('user.contact');

Route::post('/user/show/review{id}', [ReviewController::class, 'storeReview'])
    ->name('user.review');