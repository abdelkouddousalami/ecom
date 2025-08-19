@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2 font-playfair">
                        Welcome back, Admin! 👋
                    </h1>
                    <p class="text-gray-600 text-lg">Here's what's happening with your store today.</p>
                </div>
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                    <button class="btn-primary px-6 py-3 rounded-lg text-white font-medium transition-all duration-200 text-sm sm:text-base hover-lift">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Product
                    </button>
                    <button class="px-6 py-3 bg-white border-2 border-gray-300 rounded-lg text-gray-700 font-medium hover:border-gray-400 hover:bg-gray-50 transition-all duration-200 text-sm sm:text-base hover-lift">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="responsive-grid mb-8">
            <!-- Revenue Card -->
            <div class="bg-white rounded-xl card-shadow p-6 border-modern stats-revenue hover-lift">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <p class="text-gray-500 text-sm font-medium">Total Revenue</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 font-playfair">{{ number_format($stats['revenue'] ?? 0, 2) }} DH</p>
                        <div class="flex items-center mt-3">
                            <span class="text-green-600 text-sm font-medium bg-green-100 px-2 py-1 rounded-full">+12.5%</span>
                            <span class="text-gray-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="w-16 h-16 icon-bg-green rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Products Card -->
            <div class="bg-white rounded-xl card-shadow p-6 border-modern stats-products hover-lift">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <p class="text-gray-500 text-sm font-medium">Total Products</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 font-playfair">{{ $stats['total_products'] ?? 0 }}</p>
                        <div class="flex items-center mt-3">
                            <span class="text-blue-600 text-sm font-medium bg-blue-100 px-2 py-1 rounded-full">+3 new</span>
                            <span class="text-gray-500 text-sm ml-2">this week</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="w-16 h-16 icon-bg-blue rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Orders Card -->
            <div class="bg-white rounded-xl card-shadow p-6 border-modern stats-orders hover-lift">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                            <p class="text-gray-500 text-sm font-medium">Total Orders</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 font-playfair">{{ $stats['total_orders'] ?? 0 }}</p>
                        <div class="flex items-center mt-3">
                            <span class="text-purple-600 text-sm font-medium bg-purple-100 px-2 py-1 rounded-full">5 today</span>
                            <span class="text-gray-500 text-sm ml-2">so far</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="w-16 h-16 icon-bg-purple rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pending Orders Card -->
            <div class="bg-white rounded-xl card-shadow p-6 border-modern stats-pending hover-lift">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-orange-500 rounded-full mr-2"></div>
                            <p class="text-gray-500 text-sm font-medium">Pending Orders</p>
                        </div>
                        <p class="text-3xl font-bold text-orange-600 font-playfair">{{ $stats['pending_orders'] ?? 0 }}</p>
                        <div class="flex items-center mt-3">
                            <span class="text-orange-600 text-sm font-medium bg-orange-100 px-2 py-1 rounded-full">Needs attention</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="w-16 h-16 icon-bg-orange rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Users Card -->
            <div class="bg-white rounded-xl card-shadow p-6 border-modern stats-users hover-lift">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                            <p class="text-gray-500 text-sm font-medium">Total Users</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 font-playfair">{{ $stats['total_users'] ?? 0 }}</p>
                        <div class="flex items-center mt-3">
                            <a href="/admin/users" class="text-purple-600 text-sm font-medium bg-purple-100 px-2 py-1 rounded-full hover:bg-purple-200 transition duration-200">
                                Manage Users
                            </a>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="w-16 h-16 icon-bg-purple rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Recent Orders -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl card-shadow p-6 border-modern">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 sm:mb-0 font-playfair">Recent Orders</h3>
                        <a href="/admin/orders" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center transition-colors duration-200">
                            View All
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="responsive-table custom-scrollbar">
                        <div class="space-y-3">
                            @forelse($stats['recent_orders'] ?? [] as $order)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 border-modern">
                                <div class="flex-1 mb-2 sm:mb-0">
                                    <p class="font-semibold text-gray-900 text-base">{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->first_name }} {{ $order->last_name }}</p>
                                    <p class="text-xs text-gray-400 sm:hidden">{{ $order->created_at->format('M j, Y') }}</p>
                                </div>
                                <div class="flex items-center justify-between sm:justify-end sm:space-x-4">
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900 text-base">{{ number_format($order->total, 2) }} DH</p>
                                        <p class="text-xs text-gray-500 hidden sm:block">{{ $order->created_at->format('M j, Y') }}</p>
                                    </div>
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full ml-4
                                        @if($order->status === 'pending') status-pending
                                        @elseif($order->status === 'confirmed') status-confirmed
                                        @elseif($order->status === 'processing') status-processing
                                        @elseif($order->status === 'shipped') status-shipped
                                        @elseif($order->status === 'delivered') status-delivered
                                        @else status-cancelled @endif">
                                        {{ $order->getStatusLabel() }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-12">
                                <div class="w-20 h-20 icon-bg-blue rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-base font-medium">No recent orders</p>
                                <p class="text-gray-400 text-sm mt-1">Orders will appear here when customers make purchases</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                <!-- Quick Stats -->
                <div class="bg-white rounded-xl card-shadow p-6 border-modern">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 font-playfair">Quick Stats</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 icon-bg-green rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Today's Sales</span>
                            </div>
                            <span class="font-bold text-green-600">150.00 DH</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 icon-bg-blue rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">New Customers</span>
                            </div>
                            <span class="font-bold text-blue-600">7</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg border border-orange-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 icon-bg-orange rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Low Stock</span>
                            </div>
                            <span class="font-bold text-orange-600">3</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl card-shadow p-6 border-modern">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 font-playfair">Recent Activity</h3>
                    <div class="space-y-4">
                        @forelse($recentActivities as $activity)
                        <div class="flex items-start space-x-3 p-3 
                            @if($activity->icon_type === 'green') bg-green-50 border border-green-200
                            @elseif($activity->icon_type === 'blue') bg-blue-50 border border-blue-200
                            @elseif($activity->icon_type === 'purple') bg-purple-50 border border-purple-200
                            @elseif($activity->icon_type === 'orange') bg-orange-50 border border-orange-200
                            @elseif($activity->icon_type === 'red') bg-red-50 border border-red-200
                            @else bg-blue-50 border border-blue-200
                            @endif rounded-lg">
                            <div class="w-10 h-10 
                                @if($activity->icon_type === 'green') icon-bg-green
                                @elseif($activity->icon_type === 'blue') icon-bg-blue
                                @elseif($activity->icon_type === 'purple') icon-bg-purple
                                @elseif($activity->icon_type === 'orange') icon-bg-orange
                                @elseif($activity->icon_type === 'red') icon-bg-red
                                @else icon-bg-blue
                                @endif rounded-lg flex items-center justify-center flex-shrink-0">
                                @if($activity->type === 'order_created')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                @elseif($activity->type === 'product_added')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                @elseif($activity->type === 'inventory_updated')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                                    </svg>
                                @elseif($activity->type === 'order_updated')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $activity->title }}</p>
                                <p class="text-xs text-gray-500">{{ $activity->description }} - {{ $activity->time_ago }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 icon-bg-blue rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm font-medium">No recent activity</p>
                            <p class="text-gray-400 text-xs mt-1">Activities will appear here when customers place orders</p>
                            <div class="mt-4 text-xs text-gray-400">
                                <p class="font-medium mb-2">💡 Real-time activities will show here when:</p>
                                <div class="text-left inline-block space-y-1">
                                    <p>• Customers place new orders</p>
                                    <p>• Orders are updated or completed</p>
                                    <p>• Products are added or modified</p>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl card-shadow p-6 border-modern">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 font-playfair">Quick Actions</h3>
                    <div class="space-y-3">
                        <button class="w-full text-left p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200 border border-blue-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 icon-bg-blue rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Add New Product</span>
                            </div>
                        </button>
                        
                        <button class="w-full text-left p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200 border border-green-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 icon-bg-green rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">View All Orders</span>
                            </div>
                        </button>
                        
                        <button class="w-full text-left p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200 border border-purple-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 icon-bg-purple rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Analytics Report</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
