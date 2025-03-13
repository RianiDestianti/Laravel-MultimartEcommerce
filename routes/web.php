<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});
Route::resource('products', ProductController::class)->except(['show']);
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
