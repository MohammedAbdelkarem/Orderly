<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//admin with middleware
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        // Route::post('/login', 'login');
    });
});
//admin without middleware
Route::prefix('admin')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login')->name('admin.login');
    });
    Route::prefix('order')->controller(OrderController::class)->group(function () {
        Route::post('/reject/{orderId}', 'rejectOrder');
        Route::post('/changeStatus', 'changeOrderStatus');
    });
});
//user with middleware
Route::middleware(['auth:customer'])->prefix('customer')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('customer.logout');
        Route::post('/changePassword', 'changePassword');
        Route::post('/updateProfile', 'updateProfile');
        Route::get('/getMyProfile', 'getMyProfile')->name('customer.profile');
    });
    Route::prefix('order')->controller(OrderController::class)->group(function () {
        Route::post('/add', 'addProductToOrder');
        Route::post('/delete', 'deleteProductFromOrder');
        Route::get('/get', 'getCustomerOrders')->name('customer.orders');
        Route::get('/details/{orderId}', 'getCustomerOrderDetails')->name('customer.orders.details');
        Route::post('/cancel/{orderId}', 'cancelOrder');
        Route::post('/submit/{orderId}', 'submitOrder');
    });
});
//user without middleware
Route::prefix('customer')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login')->name('customer.login');
        Route::post('/sendCode', 'sendCode');
        Route::post('/checkCode', 'checkCode');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/search', 'search')->name('customer.search');
    });
    Route::prefix('store')->controller(StoreController::class)->group(function () {
        Route::get('/all', 'getAll')->name('store.all');
        Route::get('/home', 'getHome')->name('store.home');
        Route::get('/details/{id}', 'details')->name('store.details');
    });
    Route::prefix('product')->controller(ProductController::class)->group(function () {
        Route::get('/all/viewed', 'getMostViewed')->name('product.viewed');
        Route::get('/all/preferred', 'getMostPreferred')->name('product.preferred');
        Route::get('/all/selled', 'getBestSeller')->name('product.selled');
        Route::get('/home', 'getHome')->name('product.home');
        Route::get('/details/{id}', 'details')->name('product.details');
        Route::post('/fav/add/{id}', 'addToFav');
        Route::post('/fav/delete/{id}', 'deleteFromFav');
        Route::get('/fav/get', 'getFav')->name('products.fav');
    });
});