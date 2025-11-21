<?php $__env->startSection('title', 'Order Details - ' . $order->order_number); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-4">
                    <a href="/admin/orders" class="text-blue-600 hover:text-blue-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Order <?php echo e($order->order_number); ?></h1>
                </div>
                <p class="text-gray-600 mt-2">Order placed on <?php echo e($order->created_at->format('F j, Y \a\t g:i A')); ?></p>
            </div>
            <div class="flex space-x-3">
                <select class="order-status-select px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                    <?php if($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                    <?php elseif($order->status === 'confirmed'): ?> bg-blue-100 text-blue-800
                    <?php elseif($order->status === 'processing'): ?> bg-purple-100 text-purple-800
                    <?php elseif($order->status === 'shipped'): ?> bg-indigo-100 text-indigo-800
                    <?php elseif($order->status === 'delivered'): ?> bg-green-100 text-green-800
                    <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>"
                    data-order-id="<?php echo e($order->id); ?>"
                    onchange="updateOrderStatus(this)">
                    <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>En attente</option>
                    <option value="confirmed" <?php echo e($order->status === 'confirmed' ? 'selected' : ''); ?>>Confirmée</option>
                    <option value="processing" <?php echo e($order->status === 'processing' ? 'selected' : ''); ?>>En préparation</option>
                    <option value="shipped" <?php echo e($order->status === 'shipped' ? 'selected' : ''); ?>>Expédiée</option>
                    <option value="delivered" <?php echo e($order->status === 'delivered' ? 'selected' : ''); ?>>Livrée</option>
                    <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>Annulée</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Order Items -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Order Items</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="px-6 py-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                <?php if($item->product->image): ?>
                                    <img src="<?php echo e(Storage::url($item->product->image)); ?>" 
                                         alt="<?php echo e($item->product->name); ?>" 
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900"><?php echo e($item->product->name); ?></h3>
                                <p class="text-gray-600 text-sm mt-1"><?php echo e($item->product->category->name ?? 'No Category'); ?></p>
                                <?php if($item->custom_name): ?>
                                    <div class="mt-2 p-2 bg-blue-50 border border-blue-200 rounded-md">
                                        <span class="text-blue-800 text-sm font-medium">
                                            ✏️ Custom Name: "<?php echo e($item->custom_name); ?>"
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex items-center space-x-4">
                                        <span class="text-sm text-gray-600">Qty: <?php echo e($item->quantity); ?></span>
                                        <span class="text-sm text-gray-600">Price: <?php echo e(number_format($item->price, 2)); ?> DH</span>
                                    </div>
                                    <div class="text-lg font-medium text-gray-900">
                                        <?php echo e(number_format($item->total, 2)); ?> DH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <!-- Order Summary -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="text-gray-900"><?php echo e(number_format($order->subtotal, 2)); ?> DH</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping:</span>
                            <span class="text-green-600"><?php echo e($order->shipping_cost > 0 ? number_format($order->shipping_cost, 2) . ' DH' : 'Free'); ?></span>
                        </div>
                        <div class="flex justify-between text-lg font-medium border-t border-gray-200 pt-3">
                            <span class="text-gray-900">Total:</span>
                            <span class="text-gray-900"><?php echo e(number_format($order->total, 2)); ?> DH</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer & Order Info -->
        <div class="space-y-8">
            <!-- Customer Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Customer Information</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Name</label>
                        <p class="text-gray-900"><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Phone</label>
                        <p class="text-gray-900"><?php echo e($order->phone); ?></p>
                    </div>
                    <?php if($order->notes): ?>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Notes</label>
                        <div class="mt-1 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-gray-900 text-sm"><?php echo e($order->notes); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Shipping Address</h2>
                </div>
                <div class="px-6 py-4">
                    <p class="text-gray-900"><?php echo e($order->address); ?></p>
                    <p class="text-gray-900"><?php echo e($order->city); ?></p>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Payment Information</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Payment Method</label>
                        <p class="text-gray-900"><?php echo e($order->getPaymentMethodLabel()); ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Status</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            <?php if($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                            <?php elseif($order->status === 'confirmed'): ?> bg-blue-100 text-blue-800
                            <?php elseif($order->status === 'processing'): ?> bg-purple-100 text-purple-800
                            <?php elseif($order->status === 'shipped'): ?> bg-indigo-100 text-indigo-800
                            <?php elseif($order->status === 'delivered'): ?> bg-green-100 text-green-800
                            <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>">
                            <?php echo e($order->getStatusLabel()); ?>

                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Order Timeline</h2>
                </div>
                <div class="px-6 py-4">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Order Placed</p>
                                <p class="text-sm text-gray-500"><?php echo e($order->created_at->format('F j, Y \a\t g:i A')); ?></p>
                            </div>
                        </div>
                        <?php if($order->updated_at != $order->created_at): ?>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-gray-400 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                <p class="text-sm text-gray-500"><?php echo e($order->updated_at->format('F j, Y \a\t g:i A')); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for order status updates -->
<script>
function updateOrderStatus(selectElement) {
    const orderId = selectElement.dataset.orderId;
    const newStatus = selectElement.value;
    
    //('Updating order:', orderId, 'to status:', newStatus);
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    //('CSRF token element:', csrfToken);
    //('CSRF token value:', csrfToken ? csrfToken.getAttribute('content') : 'NOT FOUND');
    
    fetch(`/admin/orders/${orderId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : ''
        },
        body: JSON.stringify({
            status: newStatus
        })
    })
    .then(response => {
        //('Response status:', response.status);
        //('Response headers:', response.headers);
        
        // Check if response is HTML (error page) or JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('text/html')) {
            console.error('Server returned HTML instead of JSON');
            return response.text().then(html => {
                console.error('HTML response:', html.substring(0, 500) + '...');
                throw new Error('Server error: received HTML instead of JSON');
            });
        }
        
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error response text:', text);
                try {
                    const errorData = JSON.parse(text);
                    return Promise.reject(errorData);
                } catch (e) {
                    return Promise.reject({ message: `HTTP ${response.status}: ${text}` });
                }
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update select appearance based on new status
            selectElement.className = selectElement.className.replace(
                /bg-(yellow|blue|purple|indigo|green|red)-100 text-(yellow|blue|purple|indigo|green|red)-800/g, 
                ''
            );
            
            let statusClass = '';
            switch(newStatus) {
                case 'pending':
                    statusClass = 'bg-yellow-100 text-yellow-800';
                    break;
                case 'confirmed':
                    statusClass = 'bg-blue-100 text-blue-800';
                    break;
                case 'processing':
                    statusClass = 'bg-purple-100 text-purple-800';
                    break;
                case 'shipped':
                    statusClass = 'bg-indigo-100 text-indigo-800';
                    break;
                case 'delivered':
                    statusClass = 'bg-green-100 text-green-800';
                    break;
                case 'cancelled':
                    statusClass = 'bg-red-100 text-red-800';
                    break;
            }
            
            selectElement.className += ' ' + statusClass;
            
            // Update status badge
            const statusBadge = document.querySelector('.inline-flex.px-2.py-1');
            if (statusBadge) {
                statusBadge.className = statusBadge.className.replace(
                    /bg-(yellow|blue|purple|indigo|green|red)-100 text-(yellow|blue|purple|indigo|green|red)-800/g,
                    statusClass
                );
            }
            
            // Show success notification
            showNotification('Order status updated successfully!', 'success');
        } else {
            showNotification(data.message || 'Error updating order status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        const errorMessage = error.message || (error.errors ? Object.values(error.errors).flat().join(', ') : 'Error updating order status');
        showNotification(errorMessage, 'error');
    });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-4 rounded-lg text-white z-50 ${
        type === 'success' ? 'bg-green-600' : 'bg-red-600'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\order-details.blade.php ENDPATH**/ ?>