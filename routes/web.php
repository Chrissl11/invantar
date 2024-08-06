<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InventoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/inventories',InventoriesController::class);
Route::resource('/products',ProductsController::class);
Route::resource('/categories',CategoriesController::class);
Route::resource('/statuses',StatusesController::class);
/*Route::get('/products', [ProductsController::class, 'indexFiltering'])->name('products.index');*/
Route::patch('/products/{id}/restore', [ProductsController::class, 'restore'])->name('products.restore');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
