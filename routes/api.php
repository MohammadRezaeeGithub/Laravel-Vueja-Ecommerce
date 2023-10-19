<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum','admin'])->group(function(){
    Route::get('/user',[\App\Http\Controllers\Api\AuthController::class,'getUser']);
    Route::post('/logout',[\App\Http\Controllers\Api\AuthController::class,'logout']);



    Route::Resource('/product',\App\Http\Controllers\Api\ProductController::class);
    Route::Resource('/users',\App\Http\Controllers\Api\UserController::class);
    Route::Resource('/customers',\App\Http\Controllers\Api\CustomerController::class);
    Route::get('/order',[\App\Http\Controllers\Api\OrderController::class,'index']);
    Route::get('/order/{order}',[\App\Http\Controllers\Api\OrderController::class,'view']);

    //Dashboard Routes
    Route::get('/dashboard/customers-count',[\App\Http\Controllers\Api\DashboardController::class,'activeContomers']);
    Route::get('/dashboard/products-count',[\App\Http\Controllers\Api\DashboardController::class,'activeProducts']);
    Route::get('/dashboard/orders-count',[\App\Http\Controllers\Api\DashboardController::class,'paidOrders']);
    Route::get('/dashboard/income-amount',[\App\Http\Controllers\Api\DashboardController::class,'totalIncone']);
    Route::get('/dashboard/orders-by-country',[\App\Http\Controllers\Api\DashboardController::class,'orderByCounry']);
    Route::get('/dashboard/latest-customers',[\App\Http\Controllers\Api\DashboardController::class,'latestCustomers']);
    Route::get('/dashboard/latest-orders',[\App\Http\Controllers\Api\DashboardController::class,'latestOrders']);

});

Route::post('/login',[\App\Http\Controllers\Api\AuthController::class,'login']);
