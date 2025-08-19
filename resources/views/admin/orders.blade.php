@extends('admin.layout')

@section('title', 'Orders Management')

@section('content')
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
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $order->order_number }}</div>
                            <div class="text-sm text-gray-500">ID: {{ $order->id }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</div>
                            <div class="text-sm text-gray-500">{{ $order->email }}</div>
                            <div class="text-sm text-gray-500">{{ $order->phone }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $order->items->sum('quantity') }} item(s)</div>
                            <div class="text-sm text-gray-500">
                                @foreach($order->items->take(2) as $item)
                                    {{ $item->product->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                                @if($order->items->count() > 2)
                                    <span class="text-gray-400">+{{ $order->items->count() - 2 }} more</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ number_format($order->total, 2) }} DH</div>
                            <div class="text-sm text-gray-500">Subtotal: {{ number_format($order->subtotal, 2) }} DH</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if($order->payment_method === 'cod') bg-green-100 text-green-800
                                @elseif($order->payment_method === 'bank') bg-blue-100 text-blue-800
                                @else bg-purple-100 text-purple-800 @endif">
                                {{ $order->getPaymentMethodLabel() }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <select class="order-status-select text-xs font-semibold rounded-full px-2 py-1 border-0 focus:ring-2 focus:ring-blue-500
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
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $order->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $order->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="/admin/orders/{{ $order->id }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                    View
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
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
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>

<!-- JavaScript for order status updates -->
<script>
function updateOrderStatus(selectElement) {
    const orderId = selectElement.dataset.orderId;
    const newStatus = selectElement.value;
    
    console.log('=== DEBUGGING ORDER STATUS UPDATE ===');
    console.log('Order ID:', orderId);
    console.log('New Status:', newStatus);
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    console.log('CSRF token element:', csrfToken);
    console.log('CSRF token value:', csrfToken ? csrfToken.getAttribute('content') : 'NOT FOUND');
    
    // First, let's test if our debug route works
    console.log('Testing debug route first...');
    fetch('/admin/debug-json', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            test: 'debug test',
            orderId: orderId,
            newStatus: newStatus
        })
    })
    .then(response => {
        console.log('DEBUG ROUTE - Response status:', response.status);
        console.log('DEBUG ROUTE - Content type:', response.headers.get('content-type'));
        
        if (!response.ok) {
            throw new Error(`Debug route failed: ${response.status}`);
        }
        
        return response.json();
    })
    .then(debugData => {
        console.log('DEBUG ROUTE - Success:', debugData);
        console.log('Now testing the actual order update...');
        
        // Now test the actual order status update
        return fetch(`/admin/orders/${orderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                status: newStatus
            })
        });
    })
    .then(response => {
        console.log('ORDER UPDATE - Response status:', response.status);
        console.log('ORDER UPDATE - Response URL:', response.url);
        console.log('ORDER UPDATE - Content type:', response.headers.get('content-type'));
        
        // Get the response text to see what we're actually receiving
        return response.text().then(text => {
            console.log('ORDER UPDATE - Raw response:', text.substring(0, 500));
            
            // Check if it's HTML or JSON
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                try {
                    const jsonData = JSON.parse(text);
                    return { isJson: true, data: jsonData, status: response.status };
                } catch (e) {
                    console.error('Failed to parse JSON:', e);
                    return { isJson: false, text: text, status: response.status };
                }
            } else {
                console.error('Response is not JSON, content-type:', contentType);
                return { isJson: false, text: text, status: response.status };
            }
        });
    })
    .then(result => {
        console.log('ORDER UPDATE - Final result:', result);
        
        if (result.isJson && result.data.success) {
            console.log('Order updated successfully!');
            
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
            showNotification('Order status updated successfully!', 'success');
        } else {
            console.error('Order update failed:', result);
            showNotification(result.data?.message || 'Unknown error occurred', 'error');
        }
    })
    .catch(error => {
        console.error('Error during order status update:', error);
        showNotification('Error updating order status: ' + error.message, 'error');
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
