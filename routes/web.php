<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\RoleController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Reservas
    Route::resource('/orders', OrderController::class)->names('orders');
    Route::get('/new_order_ref', [OrderController::class, 'generarOrderRef']);
    Route::get('/bloqueos_horas', [OrderController::class, 'bloqueosHoras']);
    Route::get('/check_discount_code', [OrderController::class, 'checkDiscountCode']);
    Route::get('/user_orders', [OrderController::class, 'user_orders'])->name('user_orders');
    Route::put('/cancel_order/{order}', OrderController::class .'@cancel_order')->name('orders.cancel_order');
    
    // Servicios
    Route::resource('/services', ServiceController::class)->names('services');
    Route::get('/services_prices', [ServiceController::class, 'services_prices']);

    // Usuarios
    Route::resource('/users', UserController::class)->names('users');

    // Cupones
    Route::resource('/coupons', CouponController::class)->names('coupons');
    Route::get('/new_discount_code', [CouponController::class, 'generarDiscountCode']);
    Route::get('/verif_manual_code', [CouponController::class, 'verificarCodManualUnico']);

    // PDF
    Route::get('/today_orders', [PDFController::class, 'today_orders'])->name('today_orders');

    // Tarjetas de fidelización
    Route::resource('/cards', CardController::class)->names('cards');

    // Roles
    Route::resource('/roles', RoleController::class)->names('roles');
});
