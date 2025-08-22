<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
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
                    <a href="<?php echo e(route('admin.create-product')); ?>" class="btn-primary px-6 py-3 rounded-lg text-white font-medium transition-all duration-200 text-sm sm:text-base hover-lift text-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Product
                    </a>
                    
                    <!-- Export Dropdown -->
                    <div class="relative">
                        <button onclick="toggleExportDropdown()" class="px-6 py-3 bg-white border-2 border-gray-300 rounded-lg text-gray-700 font-medium hover:border-gray-400 hover:bg-gray-50 transition-all duration-200 text-sm sm:text-base hover-lift flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Data
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div id="exportDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                            <div class="py-2">
                                <a href="<?php echo e(route('admin.export.all-data')); ?>" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    All Data Export
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <a href="<?php echo e(route('admin.export.users')); ?>" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    Users Export
                                </a>
                                <a href="<?php echo e(route('admin.export.products')); ?>" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Products Export
                                </a>
                                <a href="<?php echo e(route('admin.export.orders')); ?>" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Orders Export
                                </a>
                                <a href="<?php echo e(route('admin.export.phone-numbers')); ?>" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Phone Numbers Export
                                </a>
                            </div>
                        </div>
                    </div>
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
                        <p class="text-3xl font-bold text-gray-900 font-playfair"><?php echo e(number_format($stats['revenue'] ?? 0, 2)); ?> DH</p>
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
                        <p class="text-3xl font-bold text-gray-900 font-playfair"><?php echo e($stats['total_products'] ?? 0); ?></p>
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
                        <p class="text-3xl font-bold text-gray-900 font-playfair"><?php echo e($stats['total_orders'] ?? 0); ?></p>
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
                        <p class="text-3xl font-bold text-orange-600 font-playfair"><?php echo e($stats['pending_orders'] ?? 0); ?></p>
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
                        <p class="text-3xl font-bold text-gray-900 font-playfair"><?php echo e($stats['total_users'] ?? 0); ?></p>
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
            
            <!-- Phone Numbers Card -->
            <div class="bg-white rounded-xl card-shadow p-6 border-modern stats-phone hover-lift">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-pink-500 rounded-full mr-2"></div>
                            <p class="text-gray-500 text-sm font-medium">Phone Numbers</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 font-playfair"><?php echo e($stats['total_phone_numbers'] ?? 0); ?></p>
                        <div class="flex items-center mt-3">
                            <a href="<?php echo e(route('admin.phone-numbers')); ?>" class="text-pink-600 text-sm font-medium bg-pink-100 px-2 py-1 rounded-full hover:bg-pink-200 transition duration-200">
                                Manage Contacts
                            </a>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="w-16 h-16 icon-bg-pink rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
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
                            <?php $__empty_1 = true; $__currentLoopData = $stats['recent_orders'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 border-modern">
                                <div class="flex-1 mb-2 sm:mb-0">
                                    <p class="font-semibold text-gray-900 text-base"><?php echo e($order->order_number); ?></p>
                                    <p class="text-sm text-gray-500"><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></p>
                                    <p class="text-xs text-gray-400 sm:hidden"><?php echo e($order->created_at->format('M j, Y')); ?></p>
                                </div>
                                <div class="flex items-center justify-between sm:justify-end sm:space-x-4">
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900 text-base"><?php echo e(number_format($order->total, 2)); ?> DH</p>
                                        <p class="text-xs text-gray-500 hidden sm:block"><?php echo e($order->created_at->format('M j, Y')); ?></p>
                                    </div>
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full ml-4
                                        <?php if($order->status === 'pending'): ?> status-pending
                                        <?php elseif($order->status === 'confirmed'): ?> status-confirmed
                                        <?php elseif($order->status === 'processing'): ?> status-processing
                                        <?php elseif($order->status === 'shipped'): ?> status-shipped
                                        <?php elseif($order->status === 'delivered'): ?> status-delivered
                                        <?php else: ?> status-cancelled <?php endif; ?>">
                                        <?php echo e($order->getStatusLabel()); ?>

                                    </span>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-12">
                                <div class="w-20 h-20 icon-bg-blue rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-base font-medium">No recent orders</p>
                                <p class="text-gray-400 text-sm mt-1">Orders will appear here when customers make purchases</p>
                            </div>
                            <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-start space-x-3 p-3 
                            <?php if($activity->icon_type === 'green'): ?> bg-green-50 border border-green-200
                            <?php elseif($activity->icon_type === 'blue'): ?> bg-blue-50 border border-blue-200
                            <?php elseif($activity->icon_type === 'purple'): ?> bg-purple-50 border border-purple-200
                            <?php elseif($activity->icon_type === 'orange'): ?> bg-orange-50 border border-orange-200
                            <?php elseif($activity->icon_type === 'red'): ?> bg-red-50 border border-red-200
                            <?php else: ?> bg-blue-50 border border-blue-200
                            <?php endif; ?> rounded-lg">
                            <div class="w-10 h-10 
                                <?php if($activity->icon_type === 'green'): ?> icon-bg-green
                                <?php elseif($activity->icon_type === 'blue'): ?> icon-bg-blue
                                <?php elseif($activity->icon_type === 'purple'): ?> icon-bg-purple
                                <?php elseif($activity->icon_type === 'orange'): ?> icon-bg-orange
                                <?php elseif($activity->icon_type === 'red'): ?> icon-bg-red
                                <?php else: ?> icon-bg-blue
                                <?php endif; ?> rounded-lg flex items-center justify-center flex-shrink-0">
                                <?php if($activity->type === 'order_created'): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                <?php elseif($activity->type === 'product_added'): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                <?php elseif($activity->type === 'inventory_updated'): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                                    </svg>
                                <?php elseif($activity->type === 'order_updated'): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                <?php else: ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900"><?php echo e($activity->title); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e($activity->description); ?> - <?php echo e($activity->time_ago); ?></p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
                        <?php endif; ?>
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

<script>
    function toggleExportDropdown() {
        const dropdown = document.getElementById('exportDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('exportDropdown');
        const button = event.target.closest('button');
        
        if (!button || !button.onclick || button.onclick.toString().indexOf('toggleExportDropdown') === -1) {
            dropdown.classList.add('hidden');
        }
    });

    // Animate stat cards on page load
    window.addEventListener('load', function() {
        const cards = document.querySelectorAll('.stats-revenue, .stats-orders, .stats-pending, .stats-users, .stats-phone');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.transform = 'translateY(0)';
                card.style.opacity = '1';
            }, index * 100);
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>