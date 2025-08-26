<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Activity;
use App\Models\ProductInteraction;
use App\Models\PhoneNumber;
use App\Http\Requests\StoreProductRequest;
use App\Services\ImageUploadService;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'revenue' => Order::sum('total'),
            'total_users' => User::count(),
            'total_phone_numbers' => PhoneNumber::count()
        ];
        
        $categories = Category::where('is_active', true)->get();
        
        // Get recent orders
        $recentOrders = Order::with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get recent activities from database
        $recentActivities = Activity::recent(6)->get();
        
        return view('admin.dashboard', compact('stats', 'categories', 'recentOrders', 'recentActivities'));
    }

    public function products()
    {
        $products = Product::with(['category', 'images'])->latest()->paginate(15);
        return view('admin.products', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.create-product', compact('categories'));
    }

    public function storeProduct(StoreProductRequest $request, ImageUploadService $imageService)
    {
        try {
            // Debug: Log what we receive from the select dropdown
            Log::info('Product creation - Select dropdown value:', [
                'customizable_raw' => $request->get('customizable'),
                'customizable_input' => $request->input('customizable'),
                'will_be_customizable' => $request->input('customizable', '0') == '1',
                'all_form_data' => $request->all()
            ]);
            
            // The request is already validated by StoreProductRequest
            
            // Handle multiple image uploads with the service
            $imagePaths = [];
            if ($request->hasFile('images')) {
                $imagePaths = $imageService->storeProductImages($request->file('images'));
                
                if (empty($imagePaths)) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['images' => 'Failed to process any images. Please check your image files and try again.']);
                }
            }

            // Create product
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'original_price' => $request->original_price,
                'category_id' => $request->category_id,
                'image' => !empty($imagePaths) ? $imagePaths[0] : null, // Keep the first image as main image for backward compatibility
                'stock' => $request->stock,
                'rating' => $request->rating ?? 0,
                'review_count' => $request->review_count ?? 0,
                'is_featured' => $request->input('featured') == '1',
                'is_customizable' => $request->input('customizable', '0') == '1',
                'tags' => $request->tags,
                'specifications' => $request->specifications,
                'slug' => Str::slug($request->name),
            ]);

            // Store all images in product_images table
            foreach ($imagePaths as $index => $imagePath) {
                $product->images()->create([
                    'image_path' => $imagePath,
                    'sort_order' => $index,
                    'is_primary' => $index === 0, // First image is primary
                ]);
            }

            Log::info('Product created successfully', [
                'product_id' => $product->id,
                'images_count' => count($imagePaths)
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product created successfully!',
                    'redirect' => route('admin.products')
                ]);
            }

            return redirect()->route('admin.products')->with('success', 'Product created successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage(), [
                'request_data' => $request->except('images'),
                'files_count' => $request->hasFile('images') ? count($request->file('images')) : 0
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating product: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error creating product: ' . $e->getMessage()]);
        }
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        // Handle image upload - Simple Laravel approach first
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        // Create category
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

    public function destroyCategory(Category $category)
    {
        try {
            Log::info('Delete category request received for category ID: ' . $category->id . ' - Name: ' . $category->name);
            
            // Check if category has products
            $productCount = $category->products()->count();
            if ($productCount > 0) {
                return redirect()->back()->withErrors(['error' => "Cannot delete category '{$category->name}' because it has {$productCount} products associated with it. Please move or delete the products first."]);
            }
            
            // Delete category image from storage if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            // Delete the category
            $categoryName = $category->name;
            $category->delete();
            
            Log::info('Category deleted successfully: ' . $categoryName);
            return redirect()->route('admin.categories')->with('success', "Category '{$categoryName}' deleted successfully!");
            
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error deleting category: ' . $e->getMessage()]);
        }
    }

    // Product CRUD Methods
    public function editProduct(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        $product->load('category', 'images');
        return view('admin.edit-product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product, ImageUploadService $imageService)
    {
        try {
            // Force the response to never be JSON - debug headers
            if ($request->wantsJson() || $request->expectsJson()) {
                Log::warning('Request wants JSON but forcing redirect', [
                    'accept_header' => $request->header('Accept'),
                    'content_type' => $request->header('Content-Type'),
                    'x_requested_with' => $request->header('X-Requested-With')
                ]);
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|min:10',
                'price' => 'required|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'images' => 'nullable|array|max:10',
                'images.*' => [
                    'nullable',
                    'file',
                    'image',
                    'mimes:jpeg,jpg,png,gif,webp,bmp,tiff,svg',
                    'max:10240', // 10MB max per file
                    'dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000'
                ],
                'new_images' => 'nullable|array|max:10',
                'new_images.*' => [
                    'nullable',
                    'file',
                    'image',
                    'mimes:jpeg,jpg,png,gif,webp,bmp,tiff,svg',
                    'max:10240', // 10MB max per file
                    'dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000'
                ],
                'stock' => 'required|integer|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'review_count' => 'nullable|integer|min:0',
            ]);

            // Handle new image uploads (adding to existing)
            if ($request->hasFile('new_images')) {
                // Check total image limit
                $currentImageCount = $product->images->count();
                $newImageCount = count($request->file('new_images'));
                
                if ($currentImageCount + $newImageCount > 10) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['new_images' => 'Total images cannot exceed 10. Current: ' . $currentImageCount . ', Adding: ' . $newImageCount]);
                }
                
                // Process new images
                $imagePaths = $imageService->storeProductImages($request->file('new_images'));
                
                if (!empty($imagePaths)) {
                    // Add new images
                    foreach ($imagePaths as $index => $imagePath) {
                        $product->images()->create([
                            'image_path' => $imagePath,
                            'sort_order' => $currentImageCount + $index,
                            'is_primary' => $currentImageCount === 0 && $index === 0, // Set as primary if it's the first image overall
                        ]);
                    }

                    // Update main image reference if this is the first image
                    if ($currentImageCount === 0) {
                        $product->update(['image' => $imagePaths[0]]);
                    }
                }
            }

            // Handle full image replacement (legacy feature)
            if ($request->hasFile('images')) {
                // Process new images
                $imagePaths = $imageService->storeProductImages($request->file('images'));
                
                if (!empty($imagePaths)) {
                    // Delete old images
                    foreach ($product->images as $oldImage) {
                        $imageService->deleteImage($oldImage->image_path);
                        $oldImage->delete();
                    }

                    // Add new images
                    foreach ($imagePaths as $index => $imagePath) {
                        $product->images()->create([
                            'image_path' => $imagePath,
                            'sort_order' => $index,
                            'is_primary' => $index === 0,
                        ]);
                    }

                    // Update main image reference
                    $product->update(['image' => $imagePaths[0]]);
                }
            }

            // Update product details
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'original_price' => $request->original_price,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'rating' => $request->rating ?? 0,
                'review_count' => $request->review_count ?? 0,
                'is_featured' => $request->has('featured'),
                'tags' => $request->tags,
                'specifications' => $request->specifications,
                'slug' => Str::slug($request->name),
            ]);

            Log::info('Product updated successfully', [
                'product_id' => $product->id,
                'updated_images' => $request->hasFile('images'),
                'added_new_images' => $request->hasFile('new_images'),
                'request_wants_json' => $request->wantsJson(),
                'request_expects_json' => $request->expectsJson(),
                'request_headers' => $request->headers->all()
            ]);

            // Force HTML redirect response - never return JSON for product updates
            $redirect = redirect()->route('admin.products')->with('success', 'Product updated successfully!');
            
            // Explicitly set content type to prevent JSON response
            $redirect->header('Content-Type', 'text/html');
            
            return $redirect;
            
        } catch (\Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage(), [
                'product_id' => $product->id
            ]);
            
            // Always redirect for form submissions, never return JSON for product updates
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error updating product: ' . $e->getMessage()]);
        }
    }

    public function updateProductForm(Request $request, Product $product, ImageUploadService $imageService)
    {
        // This method is specifically for form submissions - NEVER returns JSON
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|min:10',
                'price' => 'required|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'new_images' => 'nullable|array|max:10',
                'new_images.*' => [
                    'nullable',
                    'file',
                    'image',
                    'mimes:jpeg,jpg,png,gif,webp,bmp,tiff,svg',
                    'max:10240',
                    'dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000'
                ],
                'stock' => 'required|integer|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'review_count' => 'nullable|integer|min:0',
            ]);

            // Handle new image uploads
            if ($request->hasFile('new_images')) {
                $currentImageCount = $product->images->count();
                $newImageCount = count($request->file('new_images'));
                
                if ($currentImageCount + $newImageCount <= 10) {
                    $imagePaths = $imageService->storeProductImages($request->file('new_images'));
                    
                    if (!empty($imagePaths)) {
                        foreach ($imagePaths as $index => $imagePath) {
                            $product->images()->create([
                                'image_path' => $imagePath,
                                'sort_order' => $currentImageCount + $index,
                                'is_primary' => $currentImageCount === 0 && $index === 0,
                            ]);
                        }

                        if ($currentImageCount === 0) {
                            $product->update(['image' => $imagePaths[0]]);
                        }
                    }
                }
            }

            // Update product details
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'original_price' => $request->original_price,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'rating' => $request->rating ?? 0,
                'review_count' => $request->review_count ?? 0,
                'is_featured' => $request->has('featured'),
                'is_customizable' => $request->has('customizable'),
                'tags' => $request->tags,
                'specifications' => $request->specifications,
                'slug' => Str::slug($request->name),
            ]);

            Log::info('Product updated successfully via form', ['product_id' => $product->id]);

            // Force redirect with Location header
            return redirect()->away(url('/admin/products'))->with('success', 'Product updated successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error updating product via form: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Error updating product: ' . $e->getMessage()]);
        }
    }

    public function destroyProduct(Product $product, ImageUploadService $imageService)
    {
        try {
            Log::info('Delete product request received for product ID: ' . $product->id . ' - Name: ' . $product->name);
            
            // Delete associated images from storage
            foreach ($product->images as $image) {
                $imageService->deleteImage($image->image_path);
                $image->delete();
            }

            // Delete main product image if exists
            if ($product->image) {
                $imageService->deleteImage($product->image);
            }

            // Delete the product
            $product->delete();
            
            Log::info('Product deleted successfully: ' . $product->id);

            return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error deleting product: ' . $e->getMessage()]);
        }
    }

    public function deleteProductImage(ProductImage $image, ImageUploadService $imageService)
    {
        try {
            $product = $image->product;
            $wasPrimary = $image->is_primary;
            
            // Delete image from storage
            $imageService->deleteImage($image->image_path);
            
            // Delete from database
            $image->delete();
            
            // If this was the primary image, set another image as primary
            if ($wasPrimary) {
                $newPrimaryImage = $product->images()->orderBy('sort_order')->first();
                if ($newPrimaryImage) {
                    $newPrimaryImage->update(['is_primary' => true]);
                    $product->update(['image' => $newPrimaryImage->image_path]);
                } else {
                    // No images left
                    $product->update(['image' => null]);
                }
            }
            
            Log::info('Product image deleted successfully', [
                'image_id' => $image->id,
                'product_id' => $product->id,
                'was_primary' => $wasPrimary
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully!'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error deleting product image: ' . $e->getMessage(), [
                'image_id' => $image->id ?? 'unknown'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function setPrimaryImage(ProductImage $image)
    {
        try {
            $product = $image->product;
            
            // Remove primary status from all images
            $product->images()->update(['is_primary' => false]);
            
            // Set this image as primary
            $image->update(['is_primary' => true]);
            
            // Update product's main image reference
            $product->update(['image' => $image->image_path]);
            
            Log::info('Primary product image updated', [
                'image_id' => $image->id,
                'product_id' => $product->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Primary image updated successfully!'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error setting primary image: ' . $e->getMessage(), [
                'image_id' => $image->id ?? 'unknown'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error setting primary image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showProduct(Product $product)
    {
        $product->load('category', 'images');
        
        // Get real analytics data from database
        $analytics = [
            'cart_additions' => ProductInteraction::forProduct($product->id)->cartAdditions()->count(),
            'wishlist_additions' => ProductInteraction::forProduct($product->id)->wishlistAdditions()->count(),
            'views' => ProductInteraction::forProduct($product->id)->views()->count(),
            'daily_cart_data' => $this->getDailyData($product->id, 30, ProductInteraction::TYPE_CART_ADD),
            'daily_wishlist_data' => $this->getDailyData($product->id, 30, ProductInteraction::TYPE_WISHLIST_ADD),
            'weekly_summary' => $this->getWeeklySummary($product->id),
            'conversion_rate' => $this->calculateConversionRate($product->id),
            'bounce_rate' => rand(20, 40), // This would need session tracking for real data
        ];
        
        return view('admin.product-analytics', compact('product', 'analytics'));
    }
    
    private function getDailyData($productId, $days, $type)
    {
        $data = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $startDate = $date->copy()->startOfDay();
            $endDate = $date->copy()->endOfDay();
            
            $count = ProductInteraction::forProduct($productId)
                ->where('type', $type)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();
            
            $data[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count
            ];
        }
        
        return $data;
    }
    
    private function getWeeklySummary($productId)
    {
        $thisWeekStart = Carbon::now()->startOfWeek();
        $thisWeekEnd = Carbon::now()->endOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();
        
        return [
            'this_week' => [
                'cart' => ProductInteraction::forProduct($productId)
                    ->cartAdditions()
                    ->whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])
                    ->count(),
                'wishlist' => ProductInteraction::forProduct($productId)
                    ->wishlistAdditions()
                    ->whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])
                    ->count(),
                'views' => ProductInteraction::forProduct($productId)
                    ->views()
                    ->whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])
                    ->count()
            ],
            'last_week' => [
                'cart' => ProductInteraction::forProduct($productId)
                    ->cartAdditions()
                    ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
                    ->count(),
                'wishlist' => ProductInteraction::forProduct($productId)
                    ->wishlistAdditions()
                    ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
                    ->count(),
                'views' => ProductInteraction::forProduct($productId)
                    ->views()
                    ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
                    ->count()
            ]
        ];
    }
    
    private function calculateConversionRate($productId)
    {
        $views = ProductInteraction::forProduct($productId)->views()->count();
        $cartAdditions = ProductInteraction::forProduct($productId)->cartAdditions()->count();
        
        if ($views == 0) {
            return 0;
        }
        
        return round(($cartAdditions / $views) * 100, 2);
    }

    // Order Management Methods
    public function orders()
    {
        $orders = Order::with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.orders', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load(['items.product']);
        return view('admin.order-details', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        \Illuminate\Support\Facades\Log::info('Order status update attempt', [
            'order_id' => $order->id,
            'current_status' => $order->status,
            'new_status' => $request->input('status'),
            'request_headers' => $request->headers->all(),
            'is_ajax' => $request->ajax()
        ]);

        try {
            $request->validate([
                'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
            ]);

            \Illuminate\Support\Facades\Log::info('Validation passed, updating order status');

            $order->update([
                'status' => $request->status
            ]);

            \Illuminate\Support\Facades\Log::info('Order status updated successfully', [
                'order_id' => $order->id,
                'new_status' => $order->fresh()->status
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Statut de la commande mis à jour avec succès!',
                    'order' => [
                        'id' => $order->id,
                        'status' => $order->fresh()->status
                    ]
                ]);
            }

            return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Illuminate\Support\Facades\Log::error('Validation failed', ['errors' => $e->errors()]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Données invalides: ' . implode(', ', collect($e->errors())->flatten()->toArray())
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Order status update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour du statut.');
        }
    }

    // Phone Numbers Management
    public function phoneNumbers()
    {
        $phoneNumbers = PhoneNumber::with([])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total' => PhoneNumber::count(),
            'from_orders' => PhoneNumber::where('source', 'order')->count(),
            'manual' => PhoneNumber::where('source', 'manual')->count(),
            'active' => PhoneNumber::where('is_active', true)->count(),
        ];

        return view('admin.phone-numbers', compact('phoneNumbers', 'stats'));
    }

    // User Management Methods (Both Admin and Super Admin can access)
    public function users()
    {
        // Get all users but filter out super admins if current user is not super admin
        $query = User::query();
        
        if (!Auth::user()->canSeeSuperAdmins()) {
            $query->where('role', '!=', 'super_admin');
        }
        
        $users = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $stats = [
            'total_users' => Auth::user()->canSeeSuperAdmins() ? User::count() : User::where('role', '!=', 'super_admin')->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'super_admin_users' => Auth::user()->canSeeSuperAdmins() ? User::where('role', 'super_admin')->count() : 0,
            'regular_users' => User::where('role', 'user')->count(),
        ];
        
        return view('admin.users', compact('users', 'stats'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        // Both admins and super admins can manage user roles, but with restrictions
        if (!Auth::user()->hasAdminPrivileges()) {
            abort(403, 'Unauthorized. Admin access required.');
        }

        // Super admins cannot be modified by anyone (not even other super admins)
        if ($user->isSuperAdmin()) {
            return redirect()->back()->withErrors(['error' => 'Super Admin roles cannot be modified.']);
        }

        // Regular admins can only manage user/admin roles, super admins can do more
        $allowedRoles = ['user', 'admin'];
        if (Auth::user()->isSuperAdmin()) {
            // Super admins could potentially assign more roles if needed in the future
            $allowedRoles = ['user', 'admin'];
        }

        $request->validate([
            'role' => 'required|in:' . implode(',', $allowedRoles)
        ]);

        $oldRole = $user->role;
        $user->update(['role' => $request->role]);

        Log::info('User role updated', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'old_role' => $oldRole,
            'new_role' => $request->role,
            'updated_by' => Auth::user()->email,
            'updated_by_role' => Auth::user()->role
        ]);

        return redirect()->back()->with('success', "User role updated from {$oldRole} to {$request->role} successfully!");
    }

    public function deleteUser(User $user)
    {
        // Both admins and super admins can delete users, but with restrictions
        if (!Auth::user()->hasAdminPrivileges()) {
            abort(403, 'Unauthorized. Admin access required.');
        }

        // Prevent deletion of super admins
        if ($user->isSuperAdmin()) {
            return redirect()->back()->withErrors(['error' => 'Super Admin accounts cannot be deleted.']);
        }

        // Prevent self-deletion
        if ($user->id === Auth::user()->id) {
            return redirect()->back()->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $userEmail = $user->email;
        $user->delete();

        Log::info('User deleted', [
            'deleted_user_id' => $user->id,
            'deleted_user_email' => $userEmail,
            'deleted_by' => Auth::user()->email,
            'deleted_by_role' => Auth::user()->role
        ]);

        return redirect()->back()->with('success', "User {$userEmail} deleted successfully!");
    }

    public function storePhoneNumber(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:phone_numbers,phone',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        PhoneNumber::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'source' => 'manual',
            'notes' => $request->notes,
            'collected_at' => now(),
        ]);

        return redirect()->route('admin.phone-numbers')
            ->with('success', 'Phone number added successfully!');
    }

    public function deletePhoneNumber(PhoneNumber $phoneNumber)
    {
        $phoneNumber->delete();
        return redirect()->route('admin.phone-numbers')
            ->with('success', 'Phone number deleted successfully!');
    }

    public function collectFromOrders()
    {
        $collected = PhoneNumber::collectFromOrders();
        
        return redirect()->route('admin.phone-numbers')
            ->with('success', "Successfully collected {$collected} phone numbers from existing orders!");
    }

    // Export Methods
    public function exportAllData()
    {
        $data = [
            'users' => User::with([])->get(),
            'products' => Product::with(['category', 'images'])->get(),
            'orders' => Order::with(['items.product'])->get(),
            'phone_numbers' => PhoneNumber::all(),
            'export_date' => now()->format('Y-m-d H:i:s'),
            'stats' => [
                'total_users' => User::count(),
                'total_products' => Product::count(),
                'total_orders' => Order::count(),
                'total_phone_numbers' => PhoneNumber::count(),
                'total_revenue' => Order::sum('total'),
            ]
        ];
        
        // Extract individual variables for the view
        $data['total_users'] = $data['stats']['total_users'];
        $data['total_products'] = $data['stats']['total_products'];
        $data['total_orders'] = $data['stats']['total_orders'];
        $data['total_phone_numbers'] = $data['stats']['total_phone_numbers'];
        $data['total_revenue'] = $data['stats']['total_revenue'];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.all-data', $data);
        return $pdf->download('all-data-export-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $export_date = now()->format('Y-m-d H:i:s');
        $stats = [
            'total_users' => User::count(),
            'recent_users' => User::where('created_at', '>=', now()->subDays(30))->count(),
            'admin_users' => User::where('role', 'admin')->count(),
        ];
        
        // Extract individual variables for the view
        $total_users = $stats['total_users'];
        $recent_users = $stats['recent_users'];
        $admin_users = $stats['admin_users'];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.users', compact('users', 'stats', 'export_date', 'total_users', 'recent_users', 'admin_users'));
        return $pdf->download('users-export-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportProducts()
    {
        $products = Product::with(['category', 'images'])->orderBy('created_at', 'desc')->get();
        $export_date = now()->format('Y-m-d H:i:s');
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_categories' => Category::count(),
            'total_value' => Product::sum('price'),
        ];
        
        // Extract individual variables for the view
        $total_products = $stats['total_products'];
        $active_products = $stats['active_products'];
        $total_categories = $stats['total_categories'];
        $total_value = $stats['total_value'];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.products', compact('products', 'stats', 'export_date', 'total_products', 'active_products', 'total_categories', 'total_value'));
        return $pdf->download('products-export-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportOrders()
    {
        $orders = Order::with(['items.product'])->orderBy('created_at', 'desc')->get();
        $export_date = now()->format('Y-m-d H:i:s');
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'delivered')->count(),
            'total_revenue' => Order::sum('total'),
        ];
        
        // Extract individual variables for the view
        $total_orders = $stats['total_orders'];
        $pending_orders = $stats['pending_orders'];
        $completed_orders = $stats['completed_orders'];
        $total_revenue = $stats['total_revenue'];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.orders', compact('orders', 'stats', 'export_date', 'total_orders', 'pending_orders', 'completed_orders', 'total_revenue'));
        return $pdf->download('orders-export-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportPhoneNumbers()
    {
        $phoneNumbers = PhoneNumber::orderBy('created_at', 'desc')->get();
        $stats = [
            'total_phone_numbers' => PhoneNumber::count(),
            'from_orders' => PhoneNumber::where('source', 'order')->count(),
            'manual_entries' => PhoneNumber::where('source', 'manual')->count(),
            'active_numbers' => PhoneNumber::where('is_active', true)->count(),
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.phone-numbers', compact('phoneNumbers', 'stats'));
        return $pdf->download('phone-numbers-export-' . now()->format('Y-m-d') . '.pdf');
    }

    public function collectPhoneNumbers()
    {
        try {
            $collected = PhoneNumber::collectFromOrders();
            return redirect()->back()->with('success', "Successfully collected {$collected} phone numbers from orders!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error collecting phone numbers: ' . $e->getMessage());
        }
    }
}
