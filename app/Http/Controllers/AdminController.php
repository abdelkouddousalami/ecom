<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Activity;
use App\Models\ProductInteraction;
use App\Models\PhoneNumber;
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

    public function storeProduct(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'images' => 'required|array|min:1|max:6',
                'images.*' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max each
                'stock' => 'required|integer|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'review_count' => 'nullable|integer|min:0',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        try {
            // Handle multiple image uploads
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('products', 'public');
                    $imagePaths[] = $imagePath;
                }
            }

            // Create product
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'original_price' => $request->original_price,
                'category_id' => $request->category_id,
                'image' => $imagePaths[0] ?? null, // Keep the first image as main image for backward compatibility
                'stock' => $request->stock,
                'rating' => $request->rating,
                'review_count' => $request->review_count ?? 0,
                'is_featured' => $request->has('featured'),
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

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product created successfully!',
                    'redirect' => route('admin.products')
                ]);
            }

            return redirect()->route('admin.products')->with('success', 'Product created successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating product: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->withErrors(['error' => 'Error creating product: ' . $e->getMessage()]);
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

    public function updateProduct(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'images' => 'nullable|array|max:6',
                'images.*' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max each
                'stock' => 'required|integer|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'review_count' => 'nullable|integer|min:0',
            ]);

            // Handle new image uploads
            if ($request->hasFile('images')) {
                // Delete old images
                foreach ($product->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->image_path);
                    $oldImage->delete();
                }

                // Upload new images
                foreach ($request->file('images') as $index => $image) {
                    $imagePath = $image->store('products', 'public');
                    $product->images()->create([
                        'image_path' => $imagePath,
                        'sort_order' => $index,
                        'is_primary' => $index === 0,
                    ]);
                }

                // Update main image reference
                $firstImage = $product->images()->orderBy('sort_order')->first();
                if ($firstImage) {
                    $product->update(['image' => $firstImage->image_path]);
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
                'rating' => $request->rating,
                'review_count' => $request->review_count ?? 0,
                'is_featured' => $request->has('featured'),
                'tags' => $request->tags,
                'specifications' => $request->specifications,
                'slug' => Str::slug($request->name),
            ]);

            return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error updating product: ' . $e->getMessage()]);
        }
    }

    public function destroyProduct(Product $product)
    {
        try {
            Log::info('Delete product request received for product ID: ' . $product->id . ' - Name: ' . $product->name);
            
            // Delete associated images from storage
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }

            // Delete main product image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
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
            'stats' => [
                'total_users' => User::count(),
                'total_products' => Product::count(),
                'total_orders' => Order::count(),
                'total_phone_numbers' => PhoneNumber::count(),
                'total_revenue' => Order::sum('total'),
            ]
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.all-data', $data);
        return $pdf->download('all-data-export-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $stats = [
            'total_users' => User::count(),
            'recent_users' => User::where('created_at', '>=', now()->subDays(30))->count(),
            'admin_users' => User::where('role', 'admin')->count(),
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.users', compact('users', 'stats'));
        return $pdf->download('users-export-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportProducts()
    {
        $products = Product::with(['category', 'images'])->orderBy('created_at', 'desc')->get();
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_categories' => Category::count(),
            'total_value' => Product::sum('price'),
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.products', compact('products', 'stats'));
        return $pdf->download('products-export-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportOrders()
    {
        $orders = Order::with(['items.product'])->orderBy('created_at', 'desc')->get();
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'delivered')->count(),
            'total_revenue' => Order::sum('total'),
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.orders', compact('orders', 'stats'));
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
