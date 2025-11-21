

<?php $__env->startSection('title', 'Product Analytics - ' . $product->name); ?>
<?php $__env->startSection('header', 'Product Analytics'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="<?php echo e(route('admin.products')); ?>" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?php echo e($product->name); ?></h1>
                    <p class="text-gray-600 mt-1">Analytics Dashboard - Product ID: #<?php echo e($product->id); ?></p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="<?php echo e(route('admin.edit-product', $product)); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Product
                </a>
                <a href="<?php echo e(route('product.show', $product->slug)); ?>" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    View on Store
                </a>
            </div>
        </div>
    </div>

    <!-- Analytics Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Cart Additions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5M17 16a2 2 0 11-4 0 2 2 0 014 0zM9 20a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <p class="text-sm font-medium text-gray-600">Cart Additions</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo e(number_format($analytics['cart_additions'])); ?></p>
                    <p class="text-sm text-green-600 font-medium">+12% from last week</p>
                </div>
            </div>
        </div>

        <!-- Total Wishlist Additions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <p class="text-sm font-medium text-gray-600">Wishlist Additions</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo e(number_format($analytics['wishlist_additions'])); ?></p>
                    <p class="text-sm text-green-600 font-medium">+8% from last week</p>
                </div>
            </div>
        </div>

        <!-- Total Views -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <p class="text-sm font-medium text-gray-600">Product Views</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo e(number_format($analytics['views'])); ?></p>
                    <p class="text-sm text-green-600 font-medium">+15% from last week</p>
                </div>
            </div>
        </div>

        <!-- Conversion Rate -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <p class="text-sm font-medium text-gray-600">Conversion Rate</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo e($analytics['conversion_rate']); ?>%</p>
                    <p class="text-sm text-green-600 font-medium">+3% from last week</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Cart Additions Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Cart Additions (Last 30 Days)</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Daily additions</span>
                </div>
            </div>
            <div class="h-80">
                <canvas id="cartChart"></canvas>
            </div>
        </div>

        <!-- Wishlist Additions Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Wishlist Additions (Last 30 Days)</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Daily additions</span>
                </div>
            </div>
            <div class="h-80">
                <canvas id="wishlistChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Combined Analytics Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Cart vs Wishlist Comparison</h3>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Cart Additions</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Wishlist Additions</span>
                </div>
            </div>
        </div>
        <div class="h-96">
            <canvas id="comparisonChart"></canvas>
        </div>
    </div>

    <!-- Weekly Summary -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Weekly Performance Summary</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- This Week -->
            <div class="text-center">
                <h4 class="text-sm font-medium text-gray-600 mb-4">This Week</h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Cart</span>
                        <span class="text-lg font-bold text-blue-600"><?php echo e($analytics['weekly_summary']['this_week']['cart']); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Wishlist</span>
                        <span class="text-lg font-bold text-red-600"><?php echo e($analytics['weekly_summary']['this_week']['wishlist']); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Views</span>
                        <span class="text-lg font-bold text-green-600"><?php echo e($analytics['weekly_summary']['this_week']['views']); ?></span>
                    </div>
                </div>
            </div>

            <!-- Last Week -->
            <div class="text-center">
                <h4 class="text-sm font-medium text-gray-600 mb-4">Last Week</h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Cart</span>
                        <span class="text-lg font-bold text-blue-600"><?php echo e($analytics['weekly_summary']['last_week']['cart']); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Wishlist</span>
                        <span class="text-lg font-bold text-red-600"><?php echo e($analytics['weekly_summary']['last_week']['wishlist']); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Views</span>
                        <span class="text-lg font-bold text-green-600"><?php echo e($analytics['weekly_summary']['last_week']['views']); ?></span>
                    </div>
                </div>
            </div>

            <!-- Change Indicators -->
            <div class="text-center">
                <h4 class="text-sm font-medium text-gray-600 mb-4">Week-over-Week Change</h4>
                <div class="space-y-3">
                    <?php
                        $cartChange = $analytics['weekly_summary']['last_week']['cart'] > 0 
                            ? round((($analytics['weekly_summary']['this_week']['cart'] - $analytics['weekly_summary']['last_week']['cart']) / $analytics['weekly_summary']['last_week']['cart']) * 100)
                            : ($analytics['weekly_summary']['this_week']['cart'] > 0 ? 100 : 0);
                        
                        $wishlistChange = $analytics['weekly_summary']['last_week']['wishlist'] > 0 
                            ? round((($analytics['weekly_summary']['this_week']['wishlist'] - $analytics['weekly_summary']['last_week']['wishlist']) / $analytics['weekly_summary']['last_week']['wishlist']) * 100)
                            : ($analytics['weekly_summary']['this_week']['wishlist'] > 0 ? 100 : 0);
                        
                        $viewsChange = $analytics['weekly_summary']['last_week']['views'] > 0 
                            ? round((($analytics['weekly_summary']['this_week']['views'] - $analytics['weekly_summary']['last_week']['views']) / $analytics['weekly_summary']['last_week']['views']) * 100)
                            : ($analytics['weekly_summary']['this_week']['views'] > 0 ? 100 : 0);
                    ?>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Cart</span>
                        <span class="text-lg font-bold <?php echo e($cartChange >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                            <?php echo e($cartChange >= 0 ? '+' : ''); ?><?php echo e($cartChange); ?>%
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Wishlist</span>
                        <span class="text-lg font-bold <?php echo e($wishlistChange >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                            <?php echo e($wishlistChange >= 0 ? '+' : ''); ?><?php echo e($wishlistChange); ?>%
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Views</span>
                        <span class="text-lg font-bold <?php echo e($viewsChange >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                            <?php echo e($viewsChange >= 0 ? '+' : ''); ?><?php echo e($viewsChange); ?>%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Prepare data for charts
const cartData = <?php echo json_encode($analytics['daily_cart_data'], 15, 512) ?>;
const wishlistData = <?php echo json_encode($analytics['daily_wishlist_data'], 15, 512) ?>;

// Extract labels and values
const labels = cartData.map(item => {
    const date = new Date(item.date);
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
});

const cartValues = cartData.map(item => item.count);
const wishlistValues = wishlistData.map(item => item.count);

// Chart configuration
const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: false
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            grid: {
                color: '#f3f4f6'
            },
            ticks: {
                color: '#6b7280'
            }
        },
        x: {
            grid: {
                color: '#f3f4f6'
            },
            ticks: {
                color: '#6b7280'
            }
        }
    }
};

// Cart Additions Chart
const cartCtx = document.getElementById('cartChart').getContext('2d');
new Chart(cartCtx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Cart Additions',
            data: cartValues,
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#3b82f6',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: chartOptions
});

// Wishlist Additions Chart
const wishlistCtx = document.getElementById('wishlistChart').getContext('2d');
new Chart(wishlistCtx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Wishlist Additions',
            data: wishlistValues,
            borderColor: '#ef4444',
            backgroundColor: 'rgba(239, 68, 68, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#ef4444',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: chartOptions
});

// Comparison Chart
const comparisonCtx = document.getElementById('comparisonChart').getContext('2d');
new Chart(comparisonCtx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Cart Additions',
                data: cartValues,
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: false,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            },
            {
                label: 'Wishlist Additions',
                data: wishlistValues,
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                borderWidth: 3,
                fill: false,
                tension: 0.4,
                pointBackgroundColor: '#ef4444',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }
        ]
    },
    options: {
        ...chartOptions,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    color: '#374151'
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        }
    }
});

// Auto-refresh charts every 30 seconds (optional)
// setInterval(() => {
//     window.location.reload();
// }, 30000);
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\product-analytics.blade.php ENDPATH**/ ?>