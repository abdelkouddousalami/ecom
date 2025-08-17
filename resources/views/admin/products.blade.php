@extends('admin.layout')

@section('title', 'Products')
@section('header', 'Products Management')

@section('content')
<div class="px-4 py-6 sm:px-0 mt-8">
    <!-- Success/Error Messages -->
    @if(session('success'))
    <div id="success-toast" class="fixed top-6 right-6 z-50 bg-gradient-to-r from-emerald-50 to-green-50 border-l-4 border-emerald-500 text-emerald-800 px-6 py-4 rounded-xl shadow-2xl backdrop-blur-sm transform transition-all duration-500 ease-out animate-in slide-in-from-right-full">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="font-semibold text-emerald-900">Success!</p>
                <p class="text-sm text-emerald-700">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-6 text-emerald-600 hover:text-emerald-800 transition-colors duration-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414L10 11.414l-4.293 4.293a1 1 0 00-1.414 1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="error-toast" class="fixed top-6 right-6 z-50 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-xl shadow-2xl backdrop-blur-sm transform transition-all duration-500 ease-out animate-in slide-in-from-right-full">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 001.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="font-semibold text-red-900">Error!</p>
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-6 text-red-600 hover:text-red-800 transition-colors duration-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

    <!-- Products Table -->
    <div class="bg-white shadow-2xl rounded-3xl overflow-hidden backdrop-blur-sm relative">
        <!-- Decorative gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 via-transparent to-indigo-50/30 pointer-events-none"></div>
        
        <div class="relative px-8 py-8 bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-white tracking-tight">Product Inventory</h3>
                        <p class="text-blue-200 text-sm font-medium mt-1">Manage your product catalog</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 shadow-lg">
                        <span class="text-black text-sm font-semibold">1 Items</span>
                    </div>
                    <a href="{{ route('admin.create-product') }}" class="group inline-flex items-center px-6 py-3 text-sm font-bold rounded-2xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-900 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl border border-white/20">
                        <svg class="-ml-1 mr-2 h-5 w-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Product
                    </a>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto" style="margin-bottom: 15px !important;">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gradient-to-r from-gray-50 to-slate-50">
                    <tr>
                        <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center" style="margin: 5px;">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <span>Product</span>
                            </div>
                        </th>
                        <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center" style="margin: 5px;">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <span>Category</span>
                            </div>
                        </th>
                        <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center" style="margin: 5px;">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <span>Price</span>
                            </div>
                        </th>
                        <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center" style="margin: 5px;">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <span>Stock</span>
                            </div>
                        </th>
                        <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                                <span>Rating</span>
                            </div>
                        </th>
                        <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center" style="margin: 5px;">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span>Status</span>
                            </div>
                        </th>
                        <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center" style="margin: 5px;">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </div>
                                <span>Actions</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($products as $product)
                    <tr class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/50 transition-all duration-300 hover:shadow-lg hover:shadow-blue-100/50" style="margin-bottom: 15px;">
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="relative group-hover:scale-110 transition-transform duration-300">
                                        <!-- Fixed product image to 100px width with auto height -->
                                        <img style="width: 100px !important;"; class="w-[100px] h-auto rounded-xl object-cover shadow-md border-2 border-gray-100 group-hover:border-blue-300 transition-all duration-300 " 
                                             src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=100&h=100&fit=crop' }}" 
                                             alt="{{ $product->name }}">
                                        <div class="absolute inset-0 bg-blue-500/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-1">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500 bg-gray-50 px-3 py-1 rounded-full inline-block mb-2">
                                        {{ Str::limit($product->description, 25) }}
                                    </div>
                                    @if($product->category)
                                    <div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-indigo-100 to-blue-100 text-indigo-700 border border-indigo-200">
                                            {{ $product->category->name }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-xl bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-900 border border-blue-200 shadow-sm">
                                {{ $product->category->name ?? 'No Category' }}
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="text-lg font-bold text-gray-900 mb-1">{{ number_format($product->price) }} DH</div>
                            @if($product->original_price)
                                <div class="text-sm text-gray-500 line-through bg-gray-100 px-2 py-1 rounded-lg inline-block">{{ number_format($product->original_price) }} DH</div>
                            @endif
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-sm font-bold text-gray-900">{{ $product->stock }} units</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($product->rating)
                                    <div class="flex items-center bg-gradient-to-r from-yellow-50 to-orange-50 px-3 py-2 rounded-xl border border-yellow-200 shadow-sm">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= floor($product->rating) ? 'text-yellow-500' : 'text-gray-300' }} transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-sm font-bold text-yellow-800">{{ $product->rating }}</span>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400 italic bg-gray-100 px-3 py-2 rounded-xl">No rating</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            @if($product->stock > 0)
                                <span class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-xl bg-gradient-to-r from-green-100 to-emerald-100 text-green-900 border border-green-200 shadow-sm">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-xl bg-gradient-to-r from-red-100 to-rose-100 text-red-900 border border-red-200 shadow-sm">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                    Out of Stock
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.edit-product', $product) }}" class="group inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-semibold rounded-xl text-blue-800 bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <a href="{{ route('admin.show-product', $product) }}" class="group inline-flex items-center px-4 py-2 border border-green-200 text-sm font-semibold rounded-xl text-green-800 bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 hover:border-green-300 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                                <form action="{{ route('admin.delete-product', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('⚠️ Are you sure you want to delete {{ addslashes($product->name) }}?\n\nThis action cannot be undone and will permanently remove:\n• Product information\n• Product images\n• All associated data\n\nClick OK to proceed or Cancel to abort.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="group inline-flex items-center px-4 py-2 border border-red-200 text-sm font-semibold rounded-xl text-red-800 bg-gradient-to-r from-red-50 to-rose-50 hover:from-red-100 hover:to-rose-100 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-red-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mb-6 shadow-lg">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">No products found</h3>
                                <p class="text-gray-500 mb-6 max-w-md">Get started by adding your first product to the inventory and begin managing your catalog.</p>
                                <a href="{{ route('admin.create-product') }}" class="group inline-flex items-center px-8 py-4 text-sm font-bold rounded-2xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add your first product
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Enhanced script is running');
    
    // Enhanced auto-hide toast messages with smooth animations
    const successToast = document.getElementById('success-toast');
    const errorToast = document.getElementById('error-toast');
    
    function hideToast(toast) {
        if (toast) {
            // Add exit animation
            toast.style.transform = 'translateX(100%) scale(0.95)';
            toast.style.opacity = '0';
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 500);
        }
    }
    
    if (successToast) {
        setTimeout(() => hideToast(successToast), 5000);
    }
    
    if (errorToast) {
        setTimeout(() => hideToast(errorToast), 5000);
    }
    
    // Add subtle hover effects to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-1px)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>

@endsection
