@extends('admin.layout')

@section('title', 'Order Details')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-8">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <a href="{{ route('admin.orders') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
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
                <h1 class="text-2xl font-bold text-gray-900">Order {{ $order->order_number }}</h1>
                <p class="text-gray-600 mt-1">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-gray-900">{{ number_format($order->total) }} DH</div>
                <div class="mt-2">
                    @if($order->status == 'pending')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div>
                            Pending
                        </span>
                    @elseif($order->status == 'confirmed')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                            Confirmed
                        </span>
                    @elseif($order->status == 'processing')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            <div class="w-2 h-2 bg-purple-400 rounded-full mr-2"></div>
                            Processing
                        </span>
                    @elseif($order->status == 'shipped')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            <div class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></div>
                            Shipped
                        </span>
                    @elseif($order->status == 'delivered')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                            Delivered
                        </span>
                    @elseif($order->status == 'cancelled')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                            Cancelled
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <form action="{{ route('admin.update-order-status', $order) }}" method="POST" class="flex items-center space-x-3">
                @csrf
                @method('PATCH')
                <label class="text-sm font-medium text-gray-700">Update Status:</label>
                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                        @foreach($order->items as $item)
                        <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100">
                                    @if($item->product && $item->product->image)
                                        <img class="w-full h-full object-cover" 
                                             src="{{ Storage::url($item->product->image) }}" 
                                             alt="{{ $item->product->name }}"
                                             onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-gray-100\'><svg class=\'w-8 h-8 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>'">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">{{ $item->product_name }}</h3>
                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                <p class="text-sm text-gray-600">Unit Price: {{ number_format($item->price) }} DH</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900">
                                    {{ number_format($item->price * $item->quantity) }} DH
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium">{{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; })) }} DH</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total:</span>
                                <span>{{ number_format($order->total) }} DH</span>
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
                            <p class="text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Phone</label>
                            <p class="text-gray-900">{{ $order->phone }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $order->email ?? 'Not provided' }}</p>
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
                            <p class="text-gray-900">{{ $order->address }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">City</label>
                            <p class="text-gray-900">{{ $order->city }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Postal Code</label>
                            <p class="text-gray-900">{{ $order->postal_code ?? 'Not provided' }}</p>
                        </div>
                        @if($order->notes)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Notes</label>
                            <p class="text-gray-900">{{ $order->notes }}</p>
                        </div>
                        @endif
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
                            <p class="text-gray-900">{{ ucfirst($order->payment_method ?? 'Cash on Delivery') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Payment Status</label>
                            <p class="text-gray-900">
                                @if($order->payment_status == 'paid')
                                    <span class="text-green-600 font-medium">Paid</span>
                                @elseif($order->payment_status == 'pending')
                                    <span class="text-yellow-600 font-medium">Pending</span>
                                @else
                                    <span class="text-red-600 font-medium">Unpaid</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
