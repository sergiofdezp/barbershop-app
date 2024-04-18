<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;

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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/orders', OrderController::class)->names('orders');
    
    Route::resource('/services', ServiceController::class)->names('services');

    Route::get('/services_prices', [ServiceController::class, 'services_prices']);

    Route::get('/new_order_ref', [OrderController::class, 'generarOrderRef']);

    Route::get('/bloqueos_horas', [ServiceController::class, 'bloqueosHoras']);
});
