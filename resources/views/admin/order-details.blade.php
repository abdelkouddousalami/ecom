@extends('admin.layout')

@section('title', 'Order Details - ' . $order->order_number)

@section('content')
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
                    <h1 class="text-3xl font-bold text-gray-900">Order {{ $order->order_number }}</h1>
                </div>
                <p class="text-gray-600 mt-2">Order placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
            <div class="flex space-x-3">
                <select class="order-status-select px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                    @elseif($order->status === 'processing') bg-purple-100 text-purple-800
                    @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif"
                    data-order-id="{{ $order->id }}"
                    onchange="updateOrderStatus(this)">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>En préparation</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Expédiée</option>
                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Livrée</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
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
                    @foreach($order->items as $item)
                    <div class="px-6 py-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                @if($item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-gray-600 text-sm mt-1">{{ $item->product->category->name ?? 'No Category' }}</p>
                                @if($item->custom_name)
                                    <div class="mt-2 p-2 bg-blue-50 border border-blue-200 rounded-md">
                                        <span class="text-blue-800 text-sm font-medium">
                                            ✏️ Custom Name: "{{ $item->custom_name }}"
                                        </span>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex items-center space-x-4">
                                        <span class="text-sm text-gray-600">Qty: {{ $item->quantity }}</span>
                                        <span class="text-sm text-gray-600">Price: {{ number_format($item->price, 2) }} DH</span>
                                    </div>
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ number_format($item->total, 2) }} DH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Order Summary -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="text-gray-900">{{ number_format($order->subtotal, 2) }} DH</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping:</span>
                            <span class="text-green-600">{{ $order->shipping_cost > 0 ? number_format($order->shipping_cost, 2) . ' DH' : 'Free' }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-medium border-t border-gray-200 pt-3">
                            <span class="text-gray-900">Total:</span>
                            <span class="text-gray-900">{{ number_format($order->total, 2) }} DH</span>
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
                        <p class="text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Phone</label>
                        <p class="text-gray-900">{{ $order->phone }}</p>
                    </div>
                    @if($order->notes)
                    <div>
                        <label class="text-sm font-medium text-gray-700">Notes</label>
                        <div class="mt-1 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-gray-900 text-sm">{{ $order->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Shipping Address</h2>
                </div>
                <div class="px-6 py-4">
                    <p class="text-gray-900">{{ $order->address }}</p>
                    <p class="text-gray-900">{{ $order->city }}</p>
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
                        <p class="text-gray-900">{{ $order->getPaymentMethodLabel() }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Status</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                            @elseif($order->status === 'processing') bg-purple-100 text-purple-800
                            @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                            @elseif($order->status === 'delivered') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $order->getStatusLabel() }}
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
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                        @if($order->updated_at != $order->created_at)
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-gray-400 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                <p class="text-sm text-gray-500">{{ $order->updated_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                        @endif
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
@endsection
