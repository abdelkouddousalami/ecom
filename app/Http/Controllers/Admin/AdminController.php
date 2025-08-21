<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\PhoneNumber;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        // Calculate total revenue only from delivered orders
        $totalRevenue = Order::where('status', 'delivered')->sum('total');
        
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_categories' => Category::count(),
            'total_phone_numbers' => PhoneNumber::count(), // Added phone numbers count
            'revenue' => $totalRevenue, // Changed from total_revenue to revenue
            'delivered_orders' => Order::where('status', 'delivered')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'recent_users' => User::latest()->limit(5)->get(),
            'recent_orders' => Order::latest()->limit(5)->get(),
        ];

        // Simple recent activities for the dashboard
        $recentActivities = collect([
            (object) [
                'type' => 'order_created',
                'icon_type' => 'green',
                'title' => 'New Order Received',
                'description' => 'Order #ORD-2025-000001 has been placed',
                'time_ago' => '2 minutes ago'
            ],
            (object) [
                'type' => 'user_registered',
                'icon_type' => 'blue',
                'title' => 'New User Registration',
                'description' => 'A new customer has joined',
                'time_ago' => '15 minutes ago'
            ],
            (object) [
                'type' => 'product_viewed',
                'icon_type' => 'purple',
                'title' => 'Product Interest',
                'description' => 'Popular products getting more views',
                'time_ago' => '1 hour ago'
            ]
        ]);

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }

    /**
     * Show users management
     */
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'User role updated successfully!');
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        // Prevent deleting the current admin
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }

    /**
     * Show products management
     */
    public function products()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.products', compact('products'));
    }

    /**
     * Show create product form
     */
    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.create-product', compact('categories'));
    }

    /**
     * Store a new product
     */
    public function storeProduct(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'images' => 'nullable|array|max:10',
                'images.*' => 'image|mimes:jpeg,jpg,png,gif,svg|max:50000',
            ]);

            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->original_price = $request->original_price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;

            // Initialize ImageUploadService
            $imageService = app(ImageUploadService::class);

            // Handle multiple images upload
            if ($request->hasFile('images')) {
                $imagePaths = $imageService->storeProductImages($request->file('images'));
                
                // Set the first image as the main product image
                if (!empty($imagePaths)) {
                    $product->image = $imagePaths[0];
                }
                
                $product->save();
                
                // Store all images in the ProductImage table
                foreach ($imagePaths as $index => $imagePath) {
                    $product->images()->create([
                        'image_path' => $imagePath,
                        'is_primary' => $index === 0, // First image is primary
                        'sort_order' => $index + 1
                    ]);
                }
            } else {
                $product->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully!',
                'redirect' => route('admin.products')
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'errors' => $e->errors(),
                'message' => 'Please check your inputs and file formats.'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Product creation error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Server error',
                'message' => 'Unable to create product. Images will be automatically compressed.',
                'debug' => config('app.debug') ? $e->getMessage() : 'Contact administrator'
            ], 500);
        }
    }

    /**
     * Show product details
     */
    public function showProduct(Product $product)
    {
        $product->load('category', 'images');
        return view('admin.show-product', compact('product'));
    }

    /**
     * Show edit product form
     */
    public function editProduct(Product $product)
    {
        $categories = Category::all();
        $product->load('category', 'images');
        return view('admin.edit-product', compact('product', 'categories'));
    }

    /**
     * Update product
     */
    public function updateProduct(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp,tiff,svg',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp,tiff,svg',
            ]);

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->original_price = $request->original_price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;

            // Initialize ImageUploadService
            $imageService = app(ImageUploadService::class);

            // Handle main image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $imagePath = $imageService->processAndStoreImage($request->file('image'), 'products');
                if ($imagePath) {
                    $product->image = $imagePath;
                }
            }

            $product->save();

            // Handle multiple images upload
            if ($request->hasFile('images')) {
                $imagePaths = $imageService->storeProductImages($request->file('images'));
                foreach ($imagePaths as $imagePath) {
                    $product->images()->create([
                        'image_path' => $imagePath
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully!',
                'redirect' => route('admin.products')
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'errors' => $e->errors(),
                'message' => 'Please check your inputs and file formats.'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Product update error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Server error',
                'message' => 'Unable to update product. Images will be automatically compressed.',
                'debug' => config('app.debug') ? $e->getMessage() : 'Contact administrator'
            ], 500);
        }
    }

    /**
     * Delete product
     */
    public function destroyProduct(Product $product)
    {
        // Delete main image if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete all associated images
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    /**
     * Show orders management
     */
    public function orders()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    /**
     * Show single order
     */
    public function showOrder(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.show-order', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        // If it's an AJAX request, return JSON
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully!',
                'order' => [
                    'id' => $order->id,
                    'status' => $order->status
                ]
            ]);
        }

        // Otherwise, return a redirect (for regular form submissions)
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Show categories management
     */
    public function categories()
    {
        $categories = Category::withCount('products')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    /**
     * Store new category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000'
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

    /**
     * Delete category
     */
    public function destroyCategory(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category that contains products!');
        }

        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }

    /**
     * Show phone numbers management
     */
    public function phoneNumbers()
    {
        $phoneNumbers = PhoneNumber::latest()->paginate(15);
        
        $totalNumbers = PhoneNumber::count();
        $activeNumbers = PhoneNumber::where('is_active', true)->count();
        $fromOrders = PhoneNumber::where('source', 'order')->count();
        $manual = PhoneNumber::where('source', 'manual')->count();
        $recentSubscriptions = PhoneNumber::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        
        $stats = [
            // New keys expected by the view
            'total' => $totalNumbers,
            'from_orders' => $fromOrders,
            'manual' => $manual,
            'active' => $activeNumbers,
            // Keep existing keys for backward compatibility
            'total_numbers' => $totalNumbers,
            'active_numbers' => $activeNumbers,
            'recent_subscriptions' => $recentSubscriptions,
        ];
        
        return view('admin.phone-numbers', compact('phoneNumbers', 'stats'));
    }

    /**
     * Store new phone number
     */
    public function storePhoneNumber(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'required|string|unique:phone_numbers,phone',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        PhoneNumber::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'notes' => $request->notes,
            'source' => 'admin',
        ]);

        return back()->with('success', 'Phone number added successfully!');
    }

    /**
     * Delete phone number
     */
    public function deletePhoneNumber(PhoneNumber $phoneNumber)
    {
        $phoneNumber->delete();
        return back()->with('success', 'Phone number deleted successfully!');
    }

    /**
     * Export all data as PDF
     */
    public function exportAllData()
    {
        $data = [
            'users' => User::all(),
            'products' => Product::with('category')->get(),
            'orders' => Order::with('items.product')->get(),
            'categories' => Category::all(),
            'phoneNumbers' => PhoneNumber::all(),
            'export_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'total_revenue' => Order::where('status', 'delivered')->sum('total'),
        ];

        $pdf = PDF::loadView('admin.exports.all-data', $data);
        return $pdf->download('ecommerce-all-data-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export users as PDF
     */
    public function exportUsers()
    {
        $users = User::all();
        $data = [
            'users' => $users,
            'export_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'total_users' => $users->count(),
        ];

        $pdf = PDF::loadView('admin.exports.users', $data);
        return $pdf->download('users-export-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export products as PDF
     */
    public function exportProducts()
    {
        $products = Product::with('category')->get();
        $data = [
            'products' => $products,
            'export_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'total_products' => $products->count(),
            'total_value' => $products->sum('price'),
        ];

        $pdf = PDF::loadView('admin.exports.products', $data);
        return $pdf->download('products-export-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export orders as PDF
     */
    public function exportOrders()
    {
        $orders = Order::with('items.product')->get();
        $data = [
            'orders' => $orders,
            'export_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'total_orders' => $orders->count(),
            'total_revenue' => $orders->where('status', 'delivered')->sum('total'),
        ];

        $pdf = PDF::loadView('admin.exports.orders', $data);
        return $pdf->download('orders-export-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export phone numbers as PDF
     */
    public function exportPhoneNumbers()
    {
        $phoneNumbers = PhoneNumber::orderBy('created_at', 'desc')->get();
        $stats = [
            'total_phone_numbers' => PhoneNumber::count(),
            'from_orders' => PhoneNumber::where('source', 'order')->count(),
            'manual_entries' => PhoneNumber::where('source', 'manual')->count(),
            'active_numbers' => PhoneNumber::where('is_active', true)->count(),
        ];

        $pdf = PDF::loadView('admin.exports.phone-numbers', compact('phoneNumbers', 'stats'));
        return $pdf->download('phone-numbers-export-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Collect phone numbers from orders
     */
    public function collectFromOrders()
    {
        try {
            $collected = PhoneNumber::collectFromOrders();
            return redirect()->back()->with('success', "Successfully collected {$collected} phone numbers from orders!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error collecting phone numbers: ' . $e->getMessage());
        }
    }
}
