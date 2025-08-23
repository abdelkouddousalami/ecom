<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', [ProductController::class, 'welcome']);

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('product.show');

// Category redirect route
Route::get('/category/{category}', [ProductController::class, 'categoryRedirect'])->name('category.redirect');

// Authentication Routes (Hidden URLs)
Route::middleware('guest')->group(function () {
    Route::get('/samad', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/samad', [AuthController::class, 'login']);
    Route::get('/samad1', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/samad1', [AuthController::class, 'register']);
});

// Redirect old authentication URLs to homepage (security measure)
Route::get('/login', function() {
    return redirect('/')->with('info', 'Page not found');
});
Route::get('/register', function() {
    return redirect('/')->with('info', 'Page not found');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');
});

// Cart and Wishlist View Pages
Route::get('/cart', [ProductController::class, 'cart'])->name('cart.view');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout.view');
Route::get('/checkout/buy-now/{id}', [ProductController::class, 'buyNowCheckout'])->name('checkout.buynow');
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

// Test route for cart tracking with analytics check
Route::get('/test-cart-tracking/{product}', function($productId) {
    try {
        $product = \App\Models\Product::findOrFail($productId);
        
        // Track cart addition (simulate adding to cart)
        \App\Models\ProductInteraction::trackCartAddition($product->id, 1);
        
        // Get analytics data exactly like the admin panel does
        $analytics = [
            'cart_additions' => \App\Models\ProductInteraction::forProduct($product->id)->cartAdditions()->count(),
            'wishlist_additions' => \App\Models\ProductInteraction::forProduct($product->id)->wishlistAdditions()->count(),
            'views' => \App\Models\ProductInteraction::forProduct($product->id)->views()->count(),
        ];
        
        // Get total counts
        $totalCart = \App\Models\ProductInteraction::where('type', 'cart_add')->count();
        $totalWishlist = \App\Models\ProductInteraction::where('type', 'wishlist_add')->count();
        
        return response()->json([
            'success' => true,
            'message' => 'Cart tracking test completed',
            'product_id' => $product->id,
            'product_name' => $product->name,
            'analytics_for_this_product' => $analytics,
            'totals' => [
                'total_cart_additions' => $totalCart,
                'total_wishlist_additions' => $totalWishlist
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
});

// Test route for debugging
Route::post('/test-orders', function() {
    return response()->json(['success' => true, 'message' => 'Test route works']);
});

// Test image route
Route::get('/test-image/{filename}', function($filename) {
    $path = storage_path('app/public/products/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    return response('Image not found: ' . $path, 404);
})->name('test-image');

// Test route for AJAX debugging
Route::post('/admin/test-ajax', function(\Illuminate\Http\Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'AJAX test successful',
        'csrf_token' => $request->header('X-CSRF-TOKEN'),
        'data' => $request->all()
    ]);
})->name('admin.test-ajax');

// Test order status update route
Route::patch('/admin/test-order-status/{order}', function(\Illuminate\Http\Request $request, \App\Models\Order $order) {
    try {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Test order status updated successfully!',
            'order' => $order->fresh(['id', 'order_number', 'status'])
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Test error: ' . $e->getMessage()
        ], 500);
    }
})->name('admin.test-order-status');

// Debug route to check if basic JSON responses work
Route::post('/admin/debug-json', function(\Illuminate\Http\Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'JSON response working',
        'timestamp' => now(),
        'request_data' => $request->all()
    ]);
})->name('admin.debug-json');

Route::get('/order-success/{order}', [OrderController::class, 'success'])->name('order.success');

// SEO Routes
Route::get('/sitemap.xml', [App\Http\Controllers\SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [App\Http\Controllers\SeoController::class, 'robots'])->name('robots');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('index');
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Users Management
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::put('/users/{user}/role', [App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Products Management
    Route::get('/products', [App\Http\Controllers\AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [App\Http\Controllers\AdminController::class, 'createProduct'])->name('create-product');
    Route::post('/products', [App\Http\Controllers\AdminController::class, 'storeProduct'])->name('store-product');
    Route::get('/products/{product}/edit', [App\Http\Controllers\AdminController::class, 'editProduct'])->name('edit-product');
    Route::put('/products/{product}', [App\Http\Controllers\AdminController::class, 'updateProduct'])->name('update-product');
    Route::post('/products/{product}/update-form', [App\Http\Controllers\AdminController::class, 'updateProductForm'])->name('update-product-form');
    Route::delete('/products/{product}', [App\Http\Controllers\AdminController::class, 'destroyProduct'])->name('delete-product');
    Route::get('/products/{product}', [App\Http\Controllers\AdminController::class, 'showProduct'])->name('show-product');
    
    // Product Image Management
    Route::delete('/products/images/{image}', [App\Http\Controllers\AdminController::class, 'deleteProductImage'])->name('delete-product-image');
    Route::post('/products/images/{image}/set-primary', [App\Http\Controllers\AdminController::class, 'setPrimaryImage'])->name('set-primary-image');
    
    // Categories Management
    Route::get('/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [App\Http\Controllers\AdminController::class, 'storeCategory'])->name('store-category');
    Route::get('/categories/{category}/edit', [App\Http\Controllers\AdminController::class, 'editCategory'])->name('edit-category');
    Route::put('/categories/{category}', [App\Http\Controllers\AdminController::class, 'updateCategory'])->name('update-category');
    Route::patch('/categories/{category}/toggle-status', [App\Http\Controllers\AdminController::class, 'toggleCategoryStatus'])->name('toggle-category-status');
    Route::delete('/categories/{category}', [App\Http\Controllers\AdminController::class, 'destroyCategory'])->name('delete-category');
    
    // Orders Management
    Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [App\Http\Controllers\AdminController::class, 'showOrder'])->name('show-order');
    Route::patch('/orders/{order}/status', [App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('update-order-status');

    // Phone Numbers Management
    Route::get('/phone-numbers', [App\Http\Controllers\AdminController::class, 'phoneNumbers'])->name('phone-numbers');
    Route::post('/phone-numbers', [App\Http\Controllers\AdminController::class, 'storePhoneNumber'])->name('store-phone-number');
    Route::delete('/phone-numbers/{phoneNumber}', [App\Http\Controllers\AdminController::class, 'deletePhoneNumber'])->name('delete-phone-number');
    Route::get('/collect-from-orders', [App\Http\Controllers\AdminController::class, 'collectFromOrders'])->name('collect-from-orders');
    Route::post('/collect-from-orders', [App\Http\Controllers\AdminController::class, 'collectFromOrders'])->name('collect-from-orders.post');

    // Export Routes
    Route::get('/export/all-data', [App\Http\Controllers\AdminController::class, 'exportAllData'])->name('export.all-data');
    Route::get('/export/users', [App\Http\Controllers\AdminController::class, 'exportUsers'])->name('export.users');
    Route::get('/export/products', [App\Http\Controllers\AdminController::class, 'exportProducts'])->name('export.products');
    Route::get('/export/orders', [App\Http\Controllers\AdminController::class, 'exportOrders'])->name('export.orders');
    Route::get('/export/phone-numbers', [App\Http\Controllers\AdminController::class, 'exportPhoneNumbers'])->name('export.phone-numbers');
});
