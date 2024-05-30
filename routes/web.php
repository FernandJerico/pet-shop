<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});

Route::resource('products', ProductController::class);    
Route::resource('categories', CategoryController::class);   
Route::resource('sub-categories', SubCategoryController::class);