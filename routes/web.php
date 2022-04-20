<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MerchantController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/', [App\Http\Controllers\HomeController::class, 'store'])->name('delivery.store');
Route::post('/merchant-auth', [App\Http\Controllers\HomeController::class, 'merchantAuth'])->name('merchant.auth');
Route::get('/status', [App\Http\Controllers\HomeController::class, 'redirectionPage'])->name('payment.status');
Route::get('/success/{session_id}', [App\Http\Controllers\HomeController::class, 'successPage'])->name('success.page');
Route::get('/cancel/{session_id}', [App\Http\Controllers\HomeController::class, 'cancelPage'])->name('cancel.page');

Route::group(['prefix' => 'admin'], function () {

    Route::middleware(['auth'])->group(function() {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/delivery-request', [App\Http\Controllers\DashboardController::class, 'deliveryRequest'])->name('delivery.request');
        Route::post('/delivery-request/updatestatus', [App\Http\Controllers\DashboardController::class, 'deliveryRequestStatusUpdate'])->name('delivery.statusUpdate');
        Route::resource('merchant', MerchantController::class);
    });
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'submitLogin'])->name('login.submit'); 
    Route::get('/forget-password', [LoginController::class, 'forgetPassword'])->name('forgetPassword');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});
