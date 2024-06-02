<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\OrderListController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $categories = Category::where('status', 'active')->with('subcategories')->get();
    $search = $request->input('search', '');
    $productsQuery = Product::where('status', 'active');
    if ($search) {
        $productsQuery->where('product_name', 'LIKE', "%{$search}%");
    }
    $products = $productsQuery->get();
    $inventory = Inventory::get();
    return view('pages.index', compact('categories', 'products', 'inventory', 'search'));
})->name('index');

Route::get('/detail/{id}', function (Request $request, $id) {
    $categories = Category::where('status', 'active')->get();
    $product = Product::with('inventories')->find($id);
    $categoryId = $product->category_id;
    $relatedProducts = Product::with('inventories')->where('category_id', $categoryId)
        ->where('id', '!=', $id)->inRandomOrder()->limit(4)->get();

    $search = $request->input('search', '');

    return view('pages.product-detail', compact('product', 'categories', 'relatedProducts', 'search'));
})->name('product.detail');

Route::get('/admin-login', function () {
    return view('dashboard.login');
})->name('admin-login');

Route::get('/category/{category}', function (Request $request, $category) {
    $categories = Category::where('status', 'active')->with('subcategories')->get();
    $category = Category::where('name', $category)->firstOrFail();
    $products = Product::where('status', 'active')->where('category_id', $category->id)->get();
    $inventory = Inventory::get();
    $search = $request->input('search', '');

    return view('pages.product', compact('categories', 'category', 'products', 'inventory', 'search'));
})->name('category.products');

Route::get('/category/{category}/subcategory/{subcategory}', function (Request $request, $categoryName, $subcategoryName) {
    $categories = Category::where('status', 'active')->with('subcategories')->get();
    $category = Category::where('name', $categoryName)->firstOrFail();
    $subcategory = $category->subCategories()->where('name', $subcategoryName)->firstOrFail();
    $inventory = Inventory::get();

    $search = $request->input('search', '');
    $productsQuery = Product::where('status', 'active')->where('sub_category_id', $subcategory->id);
    if ($search) {
        $productsQuery->where('product_name', 'LIKE', "%{$search}%");
    }
    $products = $productsQuery->get();

    return view('pages.product', compact('categories', 'category', 'subcategory', 'products', 'inventory', 'search'));
})->name('subcategory.products');

Auth::routes();

Route::middleware(['isAuth'])->group(function () {
    Route::get('cart', [App\Http\Controllers\User\TransactionController::class, 'cart'])->name('cart');
    Route::post('cart/add', [App\Http\Controllers\User\TransactionController::class, 'addToCart'])->name('cart.add');
    Route::put('cart/update/qty', [App\Http\Controllers\User\TransactionController::class, 'updateQTY'])->name('cart.update.qty');
    Route::delete('cart/delete/{id}', [App\Http\Controllers\User\TransactionController::class, 'deleteCartByID'])->name('cart.delete.id');
    Route::delete('cart/delete', [App\Http\Controllers\User\TransactionController::class, 'deleteAllCart'])->name('cart.delete');
    Route::get('checkout/preview', [App\Http\Controllers\User\TransactionController::class, 'checkoutPreview'])->name('checkout.preview');
    Route::post('checkout', [App\Http\Controllers\User\TransactionController::class, 'checkout'])->name('checkout');
});

Route::name('admin.')->prefix('admin')->group(function () {
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/', function () {
            return view('dashboard.index');
        })->name('index');
        Route::resource('products', ProductController::class);
        Route::post('/product/image/add/{id}', [App\Http\Controllers\Admin\ProductController::class, 'addImage'])->name('product.image.add');
        Route::delete('/product/image/delete/{id}', [App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('product.image.delete');

        Route::resource('categories', CategoryController::class);
        Route::resource('sub-categories', SubCategoryController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('order-list', OrderListController::class);
        Route::put('order-list/update-paid/{id}', [OrderListController::class, 'markAsPaid'])->name('order-list.update-paid');
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [SettingController::class, 'update'])->name('settings.update');
    });
});