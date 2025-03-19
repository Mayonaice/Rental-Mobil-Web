<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\MasterPaymentController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/w', function () {
    return view('welkom');
});

Route::get('/dashboard', function () {
    return view('dashboard')->name('dashboard');
});

Route::get('/tes', function () {
    return view('admin.show-payment');
});
Route::get('/tes2', function () {
    return view('tes2');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/homeAdmin', function () {
        return view('homeAdmin');
    });
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('masterPayment', MasterPaymentController::class);
    Route::get('/showpayment', [AdminController::class, 'payShowAdmin'])->name('showpayment.index');
    Route::put('/showpayment/confirm/{payment?}', [AdminController::class, 'confirmPay'])->name('showpayment.confirm');
    Route::get('/showconfirmreturn', [AdminController::class, 'showConfirmReturn'])->name('confirmReturn.index');
    Route::put('/showonfirmreturn/confirm/{return?}', [AdminController::class, 'confirmReturn'])->name('confirmReturn.confirm');


});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('user.home');
    Route::get('/mobil', [UserProductController::class, 'mobil'])->name('user.mobil');
    Route::get('/rental-create/{id}', [RentalController::class, 'getMobil'])->name('rental.create');
    // Route::get('/payment', [RentalController::class, 'getUser'])->name('payment');
    Route::post('/rental-create', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/show-rent', [RentalController::class, 'showRental'])->name('show-rent');
    Route::get('/show-history', [UserController::class, 'showHistory'])->name('show-history');
    Route::get('/rental-create/payment/{rentalId?}', [PaymentController::class, 'create'])->name('rental.payment');
    Route::post('/rental-create/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/rental-create/payment/Show-pay/{b?}', [PaymentController::class, 'showPay'])->name('payment.showPay');
    Route::put('/rental-create/payment/Show-pay/pay/{paymentid?}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/rental/return/{rental?}', [RentalController::class, 'getReturn'])->name('return.show');
    Route::put('/rental/return-update/{getReturn}', [RentalController::class, 'returnRental'])->name('return.update');

    // Route::get('/rental-create/return/{rental?}', [RentalController::class, 'returnRental'])->name('rental.return');

});

require __DIR__ . '/auth.php';
