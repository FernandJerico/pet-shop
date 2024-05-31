<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\OrderListController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::where('status', 'active')->get();
    return view('pages.index', compact('categories'));
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);   
Route::resource('sub-categories', SubCategoryController::class);
Route::resource('inventories', InventoryController::class); 
Route::resource('order-list', OrderListController::class);