<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/productos');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/{producto}', [ProductoController::class, 'show'])
    ->whereNumber('producto')
    ->name('productos.show');
