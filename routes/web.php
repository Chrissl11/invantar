<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InventoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StatusesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/inventories',InventoriesController::class);
Route::resource('/products',ProductsController::class);
Route::resource('/categories',CategoriesController::class);
Route::resource('/statuses',StatusesController::class);
