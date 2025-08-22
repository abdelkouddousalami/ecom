

<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-8">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <a href="<?php echo e(route('admin.orders')); ?>" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Orders
        </a>
    </div>

    <!-- Order Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Order <?php echo e($order->order_number); ?></h1>
                <p class="text-gray-600 mt-1">Placed on <?php echo e($order->created_at->format('M d, Y \a\t h:i A')); ?></p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-gray-900"><?php echo e(number_format($order->total)); ?> DH</div>
                <div class="mt-2">
                    <?php if($order->status == 'pending'): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div>
                            Pending
                        </span>
                    <?php elseif($order->status == 'confirmed'): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                            Confirmed
                        </span>
                    <?php elseif($order->status == 'processing'): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            <div class="w-2 h-2 bg-purple-400 rounded-full mr-2"></div>
                            Processing
                        </span>
                    <?php elseif($order->status == 'shipped'): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            <div class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></div>
                            Shipped
                        </span>
                    <?php elseif($order->status == 'delivered'): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                            Delivered
                        </span>
                    <?php elseif($order->status == 'cancelled'): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                            Cancelled
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <form action="<?php echo e(route('admin.update-order-status', $order)); ?>" method="POST" class="flex items-center space-x-3">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <label class="text-sm font-medium text-gray-700">Update Status:</label>
                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="confirmed" <?php echo e($order->status == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                    <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>Processing</option>
                    <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                    <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                    <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Update
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Order Items</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100">
                                    <?php if($item->product && $item->product->image): ?>
                                        <img class="w-full h-full object-cover" 
                                             src="<?php echo e(Storage::url($item->product->image)); ?>" 
                                             alt="<?php echo e($item->product->name); ?>"
                                             onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-gray-100\'><svg class=\'w-8 h-8 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>'">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900"><?php echo e($item->product_name); ?></h3>
                                <p class="text-sm text-gray-600">Quantity: <?php echo e($item->quantity); ?></p>
                                <p class="text-sm text-gray-600">Unit Price: <?php echo e(number_format($item->price)); ?> DH</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900">
                                    <?php echo e(number_format($item->price * $item->quantity)); ?> DH
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Order Summary -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium"><?php echo e(number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }))); ?> DH</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total:</span>
                                <span><?php echo e(number_format($order->total)); ?> DH</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="space-y-6">
            <!-- Customer Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Customer Information</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Name</label>
                            <p class="text-gray-900"><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Phone</label>
                            <p class="text-gray-900"><?php echo e($order->phone); ?></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900"><?php echo e($order->email ?? 'Not provided'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Shipping Address</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Address</label>
                            <p class="text-gray-900"><?php echo e($order->address); ?></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">City</label>
                            <p class="text-gray-900"><?php echo e($order->city); ?></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Postal Code</label>
                            <p class="text-gray-900"><?php echo e($order->postal_code ?? 'Not provided'); ?></p>
                        </div>
                        <?php if($order->notes): ?>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Notes</label>
                            <p class="text-gray-900"><?php echo e($order->notes); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Payment Information</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Payment Method</label>
                            <p class="text-gray-900"><?php echo e(ucfirst($order->payment_method ?? 'Cash on Delivery')); ?></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Payment Status</label>
                            <p class="text-gray-900">
                                <?php if($order->payment_status == 'paid'): ?>
                                    <span class="text-green-600 font-medium">Paid</span>
                                <?php elseif($order->payment_status == 'pending'): ?>
                                    <span class="text-yellow-600 font-medium">Pending</span>
                                <?php else: ?>
                                    <span class="text-red-600 font-medium">Unpaid</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views/admin/show-order.blade.php ENDPATH**/ ?>