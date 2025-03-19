<?php

use App\Http\Controllers\ApiProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas de la API de tu aplicación.
| Estas rutas son cargadas por RouteServiceProvider dentro de un grupo
| que tiene el middleware "api". ¡Disfruta construyendo tu API!
|
*/

Route::apiResource('productos', ApiProductoController::class);