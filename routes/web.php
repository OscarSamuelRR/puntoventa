<?php

use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('vender');
}); */

Route::get('/', [App\Http\Controllers\ProductoController::class, 'venta'])->name('productos.venta');
Route::post('/get_data_producto', [App\Http\Controllers\ProductoController::class, 'get_data_producto'])->name('get_data_producto');

Route::resource('productos', 'App\Http\Controllers\ProductoController'::class);

Route::resource('ventas', 'App\Http\Controllers\VentaController'::class);

Route::get('ventas/{id}/reimprimir', [VentaController::class, 'reimprimir'])->name('ventas.reimprimir');

