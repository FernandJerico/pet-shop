<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\OrderListController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::where('status', 'active')->get();
    $products = Product::where('status', 'active')->get();
    $inventory = Inventory::get();
    return view('pages.index', compact('categories', 'products', 'inventory'));
});

Route::get('/detail/{id}', function ($id) {
    $categories = Category::where('status', 'active')->get();
    $product = Product::find($id);
    $categoryId = $product->category_id;
    $relatedProducts = Product::where('category_id', $categoryId)
        ->where('id', '!=', $id)->inRandomOrder()->limit(4)->get();
    return view('pages.product-detail', compact('product', 'categories', 'relatedProducts'));
})->name('product.detail');

Route::get('/cart', function () {
    $categories = Category::where('status', 'active')->get();
    return view('pages.cart', compact('categories'));
});

Route::get('/checkout', function () {
    $categories = Category::where('status', 'active')->get();
    return view('pages.checkout', compact('categories'));
});

Route::get('/admin-login', function () {
    return view('dashboard.login');
})->name('admin-login');

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);   
Route::resource('sub-categories', SubCategoryController::class);
Route::resource('inventories', InventoryController::class); 
Route::resource('order-list', OrderListController::class);