<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReplayController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::prefix('/admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'product'])
    ->name('product');

    Route::get('/productDetails{id}', [AdminController::class, 'productDetails']) 
    ->name('productDetails');
    
    Route::put('/product/updateProduct{id}', [AdminController::class, 'updateProduct'])
    ->name('updateProduct');

    Route::delete('/product/deleteReview{idReview}/{idProduct}', [AdminController::class, 'deleteReview'])
    ->name('deleteReview');

    Route::post('/product/addProduct', [AdminController::class, 'addProduct'])
    ->name('addProduct');

    Route::put('/product/changeProductImage{id}/{path}', [AdminController::class, 'changeImage'])->name('changeImage');

    Route::delete('/product/deleteProduct{id}', [AdminController::class, 'deleteProduct'])
    ->name('deleteProduct');

    Route::get('/order', [AdminController::class, 'order'])
    ->name('order');

    Route::delete('/deleteReplay{idReplay}/{idProduct}', [AdminController::class, 'deleteReplayReview'])
    ->name('deleteReplay');

    Route::post('/confirmOrder{idOrder}', [AdminController::class, 'confirmOrder'])
    ->name('confirmOrder');

    Route::post('/replayReview{idReview}/{idProduct}', [AdminController::class, 'replayToReview'])
    ->name('replayToReview');
});

Route::get('/', [UserController::class, 'index'])
    ->name('user.index');

Route::prefix('/user')->name('user.')->group(function () {

    Route::get('/show{id}', [UserController::class, 'show'])
        ->name('show');

    Route::post('/index/addCart{id}', [UserController::class, 'addCartIndex'])
        ->name('index.addCart');

    Route::post('/show/addCart{id}', [UserController::class, 'addCartShow'])
        ->name('show.addCart');

    Route::get('/viewCart', [UserController::class, 'viewCart'])
        ->name('viewCart');

    Route::post('/increaseQuantity/{id}', [UserController::class, 'increaseQuantity'])
        ->name('increaseQuantity');

    Route::post('/decreaseQuantity/{id}', [UserController::class, 'decreaseQuantity'])
        ->name('decreaseQuantity');

    Route::delete('/removeFromCart{id}', [UserController::class, 'removeFromCart'])
        ->name('removeFromCart');
        
    Route::get('/searchForProducts', [UserController::class, 'searchForProducts'])
        ->name('searchForProducts');

    Route::get('/checkout', [UserController::class, 'checkOut'])
        ->name('checkout');

    Route::post('/checkout/placeOrder', [UserController::class, 'placeOrder'])
        ->name('placeOrder');

    Route::get('/contact', [UserController::class, 'contact'])
        ->name('contact');

    Route::post('/show/review{id}', [ReviewController::class, 'storeReview'])
        ->name('review');

    Route::delete('/removeReview{idReview}/{idProduct}', [ReviewController::class, 'deleteParentReview'])
        ->name('removeReview');

    Route::delete('/replayDelete{idReplay}/{productId}', [ReplayController::class, 'deleteReplay'])
        ->name('deleteReplay');
        
    Route::post('/reviewReplay{reviewId}/{productId}', [ReplayController::class, 'storeReplay'])
        ->name('reviewReplay');
        
    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile');

    Route::get('/history', [UserController::class, 'history'])
        ->name('history');

    Route::put('/updateProfile', [UserController::class, 'updateProfile'])
        ->name('updateProfile');

});