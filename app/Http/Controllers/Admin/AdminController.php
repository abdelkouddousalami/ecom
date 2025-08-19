<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
     * Show orders management
     */
    public function orders()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }
}
