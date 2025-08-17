<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - l3ochaq Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js for dropdown functionality -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        
        /* Professional gradients */
        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .gradient-success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .gradient-warning {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        
        /* Card shadows */
        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .card-shadow:hover {
            box-shadow: 0 20px 35px -5px rgba(0, 0, 0, 0.15), 0 15px 15px -5px rgba(0, 0, 0, 0.06);
        }
        
        /* Glass effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Background pattern */
        body {
            background: #f3f4f6;
            font-family: 'Inter', sans-serif;
        }
        
        /* Tab styling */
        .tab-active {
            background-color: #2563eb;
            color: white;
        }
        .tab-inactive {
            color: #6b7280;
            background-color: transparent;
        }
        .tab-inactive:hover {
            color: #374151;
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="h-full font-inter bg-gray-100">
    <!-- Admin Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Left side - Logo only -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                        <img src="{{ asset('images/logos/logo.png') }}" 
                             alt="l3ochaq Store Logo" 
                             class="h-8 w-auto object-contain">
                    </a>
                </div>

                <!-- Center - Quick Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200">
                       
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.orders') }}" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200">
                        
                        <span class="font-medium">Orders</span>
                    </a>
                    
                    <a href="{{ route('admin.products') }}" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200">
                        
                        <span class="font-medium">Products</span>
                    </a>
                    
                    <a href="{{ route('admin.categories') }}" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200">
                        
                        <span class="font-medium">Categories</span>
                    </a>
                    
                    <a href="{{ url('/') }}" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200">
                        
                        <span class="font-medium">Store</span>
                    </a>
                </div>

                <!-- Right side - User menu and actions -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-3.5-3.5a.92.92 0 00-1.5 0L12 17h3zm-9.5-8.5A3.5 3.5 0 019 5a3.5 3.5 0 013.5 3.5c0 1.93-1.57 3.5-3.5 3.5S5.5 10.43 5.5 8.5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8a3 3 0 01-3 3m0 0a3 3 0 01-3-3m3 3h6m-9 4v6a1 1 0 001 1h8a1 1 0 001-1v-6"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                        </button>
                    </div>

                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 px-4 py-2 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">A</span>
                            </div>
                            <div class="hidden sm:block text-left">
                                <div class="text-sm font-semibold text-gray-900">Admin User</div>
                                <div class="text-xs text-gray-600">admin@l3ochaq.com</div>
                            </div>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50" style="display: none;">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <div class="text-sm font-medium text-gray-900">Signed in as</div>
                                <div class="text-sm text-gray-600">admin@l3ochaq.com</div>
                            </div>
                            
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>Profile Settings</span>
                                </div>
                            </a>
                            
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Admin Settings</span>
                                </div>
                            </a>
                            
                            <div class="border-t border-gray-200 mt-2 pt-2">
                                <a href="{{ url('/') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Sign Out</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button" class="p-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200" onclick="toggleMobileMenu()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="md:hidden hidden border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white">
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Dashboard</a>
                    <a href="{{ route('admin.products') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Products</a>
                    <a href="{{ route('admin.categories') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Categories</a>
                    <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Store</a>
                    <div class="border-t border-gray-200 pt-2">
                        <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Visit Store</a>
                        <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-red-600 hover:bg-red-50 rounded-lg">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen bg-gray-100">
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        // Tab switching functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('tab-active');
                button.classList.add('tab-inactive');
            });
            
            // Show selected tab content
            const selectedTab = document.getElementById(tabName + '-tab');
            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }
            
            // Add active class to selected tab button
            const selectedButton = document.querySelector(`[onclick="switchTab('${tabName}')"]`);
            if (selectedButton) {
                selectedButton.classList.add('tab-active');
                selectedButton.classList.remove('tab-inactive');
            }
        }

        // Initialize first tab as active
        document.addEventListener('DOMContentLoaded', function() {
            switchTab('overview');
        });

        // Product management functions
        function showAddProductForm() {
            document.getElementById('add-product-form').classList.remove('hidden');
            document.getElementById('add-product-btn').classList.add('hidden');
        }

        function hideAddProductForm() {
            document.getElementById('add-product-form').classList.add('hidden');
            document.getElementById('add-product-btn').classList.remove('hidden');
            // Clear form
            document.getElementById('product-form').reset();
        }

        function editProduct(id, name, price, stock, category) {
            document.getElementById('add-product-form').classList.remove('hidden');
            document.getElementById('add-product-btn').classList.add('hidden');
            
            // Fill form with product data
            document.querySelector('input[name="name"]').value = name;
            document.querySelector('input[name="price"]').value = price;
            document.querySelector('input[name="stock"]').value = stock;
            document.querySelector('select[name="category"]').value = category;
            
            // Change form title and button
            document.querySelector('#add-product-form h3').textContent = 'Edit Product';
            document.querySelector('#add-product-form button[type="submit"]').textContent = 'Update Product';
        }

        function deleteProduct(id, name) {
            if (confirm(`Are you sure you want to delete "${name}"?`)) {
                // Add delete functionality here
                console.log('Deleting product:', id);
            }
        }

        // Search functionality
        function searchProducts() {
            const searchTerm = document.getElementById('product-search').value.toLowerCase();
            const rows = document.querySelectorAll('#products-table tbody tr');
            
            rows.forEach(row => {
                const productName = row.cells[0].textContent.toLowerCase();
                const category = row.cells[1].textContent.toLowerCase();
                
                if (productName.includes(searchTerm) || category.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Order search functionality
        function searchOrders() {
            const searchTerm = document.getElementById('order-search').value.toLowerCase();
            const rows = document.querySelectorAll('#orders-table tbody tr');
            
            rows.forEach(row => {
                const orderId = row.cells[0].textContent.toLowerCase();
                const customer = row.cells[1].textContent.toLowerCase();
                
                if (orderId.includes(searchTerm) || customer.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
