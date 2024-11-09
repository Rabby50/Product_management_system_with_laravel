<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;



Route::get('/',[ProductsController::class, 'index'])->name('products');

Route::get('/products/create',[ProductsController::class, 'create'])->name('products.create');
Route::post('/products/store',[ProductsController::class, 'store'])->name('products.store');

Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');

Route::get('/products/{id}',[ProductsController::class, 'delete'])->name('product.delete');
Route::get('/single/product',[ProductsController::class, 'view'])->name('product.single');



