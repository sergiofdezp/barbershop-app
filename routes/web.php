<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/orders', OrderController::class)->names('orders');
    Route::get('/new_order_ref', [OrderController::class, 'generarOrderRef']);
    Route::get('/bloqueos_horas', [OrderController::class, 'bloqueosHoras']);
    Route::get('/check_discount_code', [OrderController::class, 'checkDiscountCode']);
    Route::get('/user_orders', [OrderController::class, 'userOrders'])->name('user_orders');
    
    Route::resource('/services', ServiceController::class)->names('services');
    Route::get('/services_prices', [ServiceController::class, 'services_prices']);

    Route::resource('/users', UserController::class)->names('users');

    Route::resource('/coupons', CouponController::class)->names('coupons');

    Route::get('/new_discount_code', [CouponController::class, 'generarDiscountCode']);
    Route::get('/verif_manual_code', [CouponController::class, 'verificarCodManualUnico']);

    Route::get('/today_orders', [PDFController::class, 'today_orders'])->name('today_orders');
});
