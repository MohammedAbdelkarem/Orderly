<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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
});
//user with middleware
Route::middleware(['auth:customer'])->prefix('customer')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('customer.logout');
        Route::post('/changePassword', 'changePassword');
        Route::post('/updateProfile', 'updateProfile');
        Route::get('/getMyProfile', 'getMyProfile')->name('customer.profile');
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
});

