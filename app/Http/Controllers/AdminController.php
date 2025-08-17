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
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'revenue' => Order::sum('total')
        ];
        
        $categories = Category::where('is_active', true)->get();
        
        // Get recent orders
        $recentOrders = Order::with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact('stats', 'categories', 'recentOrders'));
    }

    public function products()
    {
        $products = Product::with(['category', 'images'])->latest()->get();
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
        return view('admin.show-product', compact('product'));
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
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Statut de la commande mis à jour avec succès!'
            ]);
        }

        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès!');
    }
}
