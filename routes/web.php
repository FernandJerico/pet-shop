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
});

Route::get('/detail/{id}', function (Request $request, $id) {
    $categories = Category::where('status', 'active')->get();
    $product = Product::find($id);
    $categoryId = $product->category_id;
    $relatedProducts = Product::where('category_id', $categoryId)
        ->where('id', '!=', $id)->inRandomOrder()->limit(4)->get();

    $search = $request->input('search', '');
    
    return view('pages.product-detail', compact('product', 'categories', 'relatedProducts', 'search'));
})->name('product.detail');

Route::get('/cart', function (Request $request) {
    $categories = Category::where('status', 'active')->get();
    $search = $request->input('search', '');
    return view('pages.cart', compact('categories', 'search'));
});

Route::get('/checkout', function (Request $request) {
    $categories = Category::where('status', 'active')->get();
    $search = $request->input('search', '');
    return view('pages.checkout', compact('categories', 'search'));
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
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('settings/update', [SettingController::class, 'update'])->name('settings.update');


// Route::get('/category/{category}', function ($category) {
//     $categories = Category::where('status', 'active')->with('subcategories')->get();
//     // Mengambil kategori berdasarkan nama
//     $category = Category::where('name', $category)->firstOrFail();
//     // Mengambil produk berdasarkan kategori
//     $products = Product::where('status', 'active')->where('category_id', $category->id)->get();
//     // Mengambil semua inventory
//     $inventory = Inventory::get();

//     return view('pages.product', compact('categories','category', 'products', 'inventory'));
// })->name('category.products');

Route::get('/category/{category}/subcategory/{subcategory}', function (Request $request, $categoryName, $subcategoryName) {
    $categories = Category::where('status', 'active')->with('subcategories')->get();
    // Mengambil kategori berdasarkan nama
    $category = Category::where('name', $categoryName)->firstOrFail();
    // Mengambil subkategori berdasarkan nama dan kategori
    $subcategory = $category->subCategories()->where('name', $subcategoryName)->firstOrFail();
    // Mengambil semua inventory
    $inventory = Inventory::get();

    $search = $request->input('search', '');
    $productsQuery = Product::where('status', 'active')->where('sub_category_id', $subcategory->id);
    if ($search) {
        $productsQuery->where('product_name', 'LIKE', "%{$search}%");
    }
    $products = $productsQuery->get();

    return view('pages.product', compact('categories','category', 'subcategory', 'products', 'inventory', 'search'));
})->name('subcategory.products');