<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
Route::middleware(['guestOrVerified'])->group(function (){
    Route::get('/', [ProductController::class,'index'])->name('home');
    Route::get('/product/{product:slug}',[ProductController::class,'show'])->name('product.view');


    Route::prefix('/cart')->name('cart.')->group(function (){
        Route::get('/',[\App\Http\Controllers\CartController::class,'index'])->name('index');
        Route::post('/add/{product:slug}',[\App\Http\Controllers\CartController::class,'add'])->name('add');
        Route::post('/remove/{product:slug}',[\App\Http\Controllers\CartController::class,'remove'])->name('remove');
        Route::post('/update-quantity/{product:slug}',[\App\Http\Controllers\CartController::class,'updateQuantity'])->name('updateQuantity');
    });
});

Route::middleware(['auth','verified'])->group(function (){
   Route::get('/profile',[\App\Http\Controllers\ProfileController::class,'index'])->name('profile');
   Route::post('/profile',[\App\Http\Controllers\ProfileController::class,'store'])->name('profile.update');
   Route::post('/profile/password-update',[\App\Http\Controllers\ProfileController::class,'passwordUpdate'])->name('profile_password.update');



   Route::post('/checkout',[\App\Http\Controllers\CheckoutController::class,'checkout'])->name('cart.checkout');
   Route::post('/checkout/{order}',[\App\Http\Controllers\CheckoutController::class,'checkoutOrder'])->name('cart.checkoutWithSession');
   Route::get('/checkout/success',[\App\Http\Controllers\CheckoutController::class,'success'])->name('checkout.success');
   Route::get('/checkout/failure',[\App\Http\Controllers\CheckoutController::class,'failure'])->name('checkout.failure');



   Route::get('/order',[\App\Http\Controllers\OrderController::class,'index'])->name('order.index');
   Route::get('/orders/view/{order}',[\App\Http\Controllers\OrderController::class,'view'])->name('order.view');
});


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
