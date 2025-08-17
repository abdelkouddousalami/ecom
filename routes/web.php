<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'welcome']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('product.show');

// Cart and Wishlist View Pages
Route::get('/cart', [ProductController::class, 'cart'])->name('cart.view');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout.view');
Route::get('/wishlist', [ProductController::class, 'wishlist'])->name('wishlist.view');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/update', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::get('/get', [CartController::class, 'getCart'])->name('cart.get');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('cart.count');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Wishlist Routes
Route::prefix('wishlist')->group(function () {
    Route::post('/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/get', [WishlistController::class, 'getWishlist'])->name('wishlist.get');
    Route::get('/count', [WishlistController::class, 'getWishlistCount'])->name('wishlist.count');
    Route::post('/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
});

// Order Routes
Route::prefix('orders')->group(function () {
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Test route for debugging
Route::post('/test-orders', function() {
    return response()->json(['success' => true, 'message' => 'Test route works']);
});

Route::get('/order-success/{order}', [OrderController::class, 'success'])->name('order.success');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Products Management
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('create-product');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('store-product');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('edit-product');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('update-product');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('delete-product');
    Route::get('/products/{product}', [AdminController::class, 'showProduct'])->name('show-product');
    
    // Categories Management
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('store-category');
    
    // Orders Management
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('show-order');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('update-order-status');
});
