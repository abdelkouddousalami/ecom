<?php $__env->startSection('title', 'Orders Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Orders Management</h1>
                <p class="text-gray-600 mt-2">Manage all customer orders</p>
            </div>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search orders..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900"><?php echo e($order->order_number); ?></div>
                            <div class="text-sm text-gray-500">ID: <?php echo e($order->id); ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900"><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></div>
                            <div class="text-sm text-gray-500"><?php echo e($order->phone); ?></div>
                            <div class="text-sm text-gray-500"><?php echo e($order->city); ?></div>
                            <?php if($order->notes): ?>
                            <div class="text-sm text-blue-600 mt-1" title="<?php echo e($order->notes); ?>">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Notes disponibles
                            </div>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900"><?php echo e($order->items->sum('quantity')); ?> item(s)</div>
                            <div class="text-sm text-gray-500">
                                <?php $__currentLoopData = $order->items->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($item->product->name); ?><?php echo e(!$loop->last ? ', ' : ''); ?>

                                    <?php if($item->custom_name): ?>
                                        <span class="text-blue-600 text-xs">✏️ Custom</span>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($order->items->count() > 2): ?>
                                    <span class="text-gray-400">+<?php echo e($order->items->count() - 2); ?> more</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900"><?php echo e(number_format($order->total, 2)); ?> DH</div>
                            <div class="text-sm text-gray-500">Subtotal: <?php echo e(number_format($order->subtotal, 2)); ?> DH</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                <?php if($order->payment_method === 'cod'): ?> bg-green-100 text-green-800
                                <?php elseif($order->payment_method === 'bank'): ?> bg-blue-100 text-blue-800
                                <?php else: ?> bg-purple-100 text-purple-800 <?php endif; ?>">
                                <?php echo e($order->getPaymentMethodLabel()); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <select class="order-status-select text-xs font-semibold rounded-full px-2 py-1 border-0 focus:ring-2 focus:ring-blue-500
                                <?php if($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                <?php elseif($order->status === 'confirmed'): ?> bg-blue-100 text-blue-800
                                <?php elseif($order->status === 'delivered'): ?> bg-green-100 text-green-800
                                <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>"
                                data-order-id="<?php echo e($order->id); ?>"
                                onchange="updateOrderStatus(this)">
                                <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>En attente</option>
                                <option value="confirmed" <?php echo e($order->status === 'confirmed' ? 'selected' : ''); ?>>Confirmée</option>
                                <option value="delivered" <?php echo e($order->status === 'delivered' ? 'selected' : ''); ?>>Livrée</option>
                                <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>Annulée</option>
                            </select>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900"><?php echo e($order->created_at->format('d/m/Y')); ?></div>
                            <div class="text-sm text-gray-500"><?php echo e($order->created_at->format('H:i')); ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="/admin/orders/<?php echo e($order->id); ?>" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                    View
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <p class="text-lg font-medium">No orders found</p>
                                <p class="text-sm">Orders will appear here when customers place them.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <?php if($orders->hasPages()): ?>
        <div class="px-6 py-4 border-t border-gray-200">
            <?php echo e($orders->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>

<!-- JavaScript for order status updates -->
<script>
function updateOrderStatus(selectElement) {
    const orderId = selectElement.dataset.orderId;
    const newStatus = selectElement.value;
    
    if (!orderId || !newStatus) {
        showNotification('Error: Missing order ID or status', 'error');
        return;
    }
    
    //('Updating order status:', orderId, 'to', newStatus);
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    
    if (!csrfToken) {
        showNotification('Error: CSRF token not found', 'error');
        return;
    }
    
    // Disable the select during update
    selectElement.disabled = true;
    
    fetch(`/admin/orders/${orderId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            status: newStatus
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update select appearance based on new status
            updateSelectStyling(selectElement, newStatus);
            showNotification('Order status updated successfully!', 'success');
        } else {
            throw new Error(data.message || 'Update failed');
        }
    })
    .catch(error => {
        console.error('Error updating order status:', error);
        showNotification('Error updating order status: ' + error.message, 'error');
        
        // Reset the select to its previous value
        selectElement.value = selectElement.defaultValue;
    })
    .finally(() => {
        // Re-enable the select
        selectElement.disabled = false;
    });
}

function updateSelectStyling(selectElement, status) {
    // Remove existing status classes
    selectElement.className = selectElement.className.replace(
        /bg-(yellow|blue|green|red)-100 text-(yellow|blue|green|red)-800/g, 
        ''
    );
    
    let statusClass = '';
    switch(status) {
        case 'pending':
            statusClass = 'bg-yellow-100 text-yellow-800';
            break;
        case 'confirmed':
            statusClass = 'bg-blue-100 text-blue-800';
            break;
        case 'delivered':
            statusClass = 'bg-green-100 text-green-800';
            break;
        case 'cancelled':
            statusClass = 'bg-red-100 text-red-800';
            break;
    }
    
    selectElement.className = selectElement.className.trim() + ' ' + statusClass;
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

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\orders.blade.php ENDPATH**/ ?>