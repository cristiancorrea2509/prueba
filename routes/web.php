<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PruebaApiController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TopController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource("productos", ProductoController::class);
Route::resource("sale", SaleController::class);
Route::get("top", [TopController::class,'index'])->name('top');
Route::get("pruebapi", [PruebaApiController::class,'index'])->name('pruebapi');
Route::get("productosapi", [PruebaApiController::class,'listado'])->name('productosapi');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
