<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - l3ochaq Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        /* Mobile Navigation Styles */
        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100vh;
            background: rgba(55, 65, 75, 0.3);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 999;
            transition: right 0.3s ease-in-out;
            padding: 20px;
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
        }
        
        .mobile-menu.active {
            right: 0;
        }
        
        .mobile-menu-overlay nav {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }
        
        .mobile-menu-overlay nav a {
            color: #1f2937;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .mobile-menu-overlay nav a:hover,
        .mobile-menu-overlay nav a.active {
            color: #2563eb;
        }
        
        .hamburger {
            display: flex;
            flex-direction: column;
            cursor: pointer;
            padding: 4px;
        }
        
        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: #374151;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 3px;
        }
        
        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }
    </style>
</head>
<body class="bg-gray-50" style="font-family: 'Playfair Display', serif;">
    
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0">
                        <img src="{{ asset('images/logos/logo.png') }}" 
                             alt="l3ochaq Store Logo" 
                             class="h-8 w-auto object-contain">
                    </a>
                </div>

                <!-- Navigation Links (Center) -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Home</a>
                    <a href="/products" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Products</a>
                    <a href="/orders" class="text-blue-600 font-semibold transition duration-300">Mes Commandes</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Contact</a>
                </div>

                <!-- Right side icons -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Favorites -->
                    <div class="relative">
                        <a href="/wishlist" class="text-gray-700 hover:text-blue-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-100 block">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="wishlist-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-lg hidden">0</span>
                        </a>
                    </div>
                    
                    <!-- Cart (Panier) -->
                    <div class="relative">
                        <a href="/cart" class="text-gray-700 hover:text-blue-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-100 block">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="cart-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-lg hidden">0</span>
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button and icons -->
                <div class="md:hidden flex items-center space-x-3">
                    <!-- Mobile Wishlist Icon -->
                    <a href="/wishlist" class="text-gray-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="wishlist-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-sm hidden" style="top: -1px; left: -1px;">0</span>
                    </a>
                    
                    <!-- Mobile Cart Icon -->
                    <a href="/cart" class="text-gray-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="cart-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-sm hidden" style="top: -1px; left: -1px;">0</span>
                    </a>
                    
                    <!-- Hamburger Menu Button -->
                    <button id="mobileMenuToggle" class="hamburger text-gray-600 hover:text-blue-600 p-2">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenuOverlay" class="mobile-menu-overlay"></div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-white text-2xl font-bold">Menu</h2>
            <button id="closeMobileMenu" class="text-white text-3xl">&times;</button>
        </div>
        
        <div class="space-y-6">
            <a href="/" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Home
            </a>
            <a href="/products" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Products
            </a>
            <a href="/orders" class="block text-white text-xl font-semibold py-3 px-4 rounded-lg bg-white/10 hover:bg-white/20 transition duration-300">
                Mes Commandes
            </a>
            <a href="/wishlist" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Mes Favoris
            </a>
            <a href="#" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Contact
            </a>
        </div>
    </div>

    <!-- Page Header -->
    <div class="bg-blue-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center">Mes Commandes</h1>
            <p class="text-blue-100 text-center mt-2">Suivez l'état de vos commandes</p>
        </div>
    </div>

    <!-- Orders Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($orders->isEmpty())
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Aucune commande</h3>
                <p class="text-gray-600 mb-6">Vous n'avez pas encore passé de commandes</p>
                <a href="/products" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    Commencer à acheter
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $order->order_number }}</h3>
                                <p class="text-gray-600">Commande passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            <div class="flex items-center space-x-4 mt-4 lg:mt-0">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'processing') bg-purple-100 text-purple-800
                                    @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $order->getStatusLabel() }}
                                </span>
                                <span class="text-xl font-bold text-blue-600">{{ number_format($order->total, 2) }} DH</span>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Livraison à:</p>
                                    <p class="text-gray-600">{{ $order->first_name }} {{ $order->last_name }}</p>
                                    <p class="text-gray-600">{{ $order->address }}</p>
                                    <p class="text-gray-600">{{ $order->city }} {{ $order->postal_code }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Contact:</p>
                                    <p class="text-gray-600">{{ $order->email }}</p>
                                    <p class="text-gray-600">{{ $order->phone }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Mode de paiement:</p>
                                    <p class="text-gray-600">{{ $order->getPaymentMethodLabel() }}</p>
                                </div>
                            </div>
                            
                            <div class="border-t pt-4">
                                <h4 class="font-semibold text-gray-900 mb-3">Articles commandés:</h4>
                                <div class="space-y-2">
                                    @foreach($order->items as $item)
                                        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-white border">
                                                    <img src="{{ asset('images/products/' . $item->product->image) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="w-full h-full object-cover"
                                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0yMS4zMzMzIDIxLjMzMzNIMjMuOTk5OUMyNC4zNjgzIDIxLjMzMzMgMjQuNzIxIDIxLjMzMzMgMjUuMDU3NiAyMS4zNTU5QzI1LjcxMTUgMjEuMzk5OSAyNi4zMjI1IDIxLjY0NTIgMjYuNzkwMiAyMi4wNzEzTDQyLjY2NjYgMzcuOTk5OVY0OEMzMS40NjY2IDQ4IDE5LjMzMzMgNDggMTYgNDhWMjYuNjY2NkMxNiAyNC45MjI5IDE2IDI0LjA1MTMgMTYuMzk4MSAyMy4zNTE5QzE2LjUwMTEgMjMuMTUxNyAxNi42Mjg0IDIyLjk2MyAxNi43Nzc4IDIyLjc4ODlMMTYuODg4OSAyMi42NjY2QzE3LjU4NDcgMjEuOTcwNyAxOC42OTAzIDIxLjMzMzMgMjEuMzMzMyAyMS4zMzMzWiIgZmlsbD0iIzlDQTNBRiIvPgo8Y2lyY2xlIGN4PSIyNiIgY3k9IjI5LjMzMzMiIHI9IjMuOTk5OSIgZmlsbD0iI0Q5RDlEOSIvPgo8L3N2Zz4K'">
                                                </div>
                                                <div>
                                                    <h5 class="font-semibold text-gray-900">{{ $item->product->name }}</h5>
                                                    <p class="text-gray-600">{{ number_format($item->price, 2) }} DH × {{ $item->quantity }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-green-600">{{ number_format($item->total, 2) }} DH</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        @endif
    </div>

    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const closeMobileMenu = document.getElementById('closeMobileMenu');

            function openMobileMenu() {
                mobileMenu.classList.add('active');
                mobileMenuOverlay.classList.add('active');
                mobileMenuToggle.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeMobileMenuFunc() {
                mobileMenu.classList.remove('active');
                mobileMenuOverlay.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                document.body.style.overflow = '';
            }

            mobileMenuToggle.addEventListener('click', function() {
                if (mobileMenu.classList.contains('active')) {
                    closeMobileMenuFunc();
                } else {
                    openMobileMenu();
                }
            });

            closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
            mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);

            // Close mobile menu when clicking on a menu item
            const mobileMenuLinks = document.querySelectorAll('#mobileMenu a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    setTimeout(closeMobileMenuFunc, 300);
                });
            });

            // Close mobile menu on window resize if open
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768 && mobileMenu.classList.contains('active')) {
                    closeMobileMenuFunc();
                }
            });

            // Cart and Wishlist functionality
            function updateCartCount() {
                const cartData = JSON.parse(localStorage.getItem('cart') || '[]');
                const cartCount = cartData.reduce((sum, item) => sum + item.quantity, 0);
                const cartCountElements = document.querySelectorAll('.cart-count');
                
                cartCountElements.forEach(element => {
                    element.textContent = cartCount;
                    if (cartCount > 0) {
                        element.style.display = 'flex';
                        element.classList.remove('hidden');
                    } else {
                        element.style.display = 'none';
                        element.classList.add('hidden');
                    }
                });
            }

            function updateWishlistCount() {
                const wishlistData = JSON.parse(localStorage.getItem('wishlist') || '[]');
                const wishlistCount = wishlistData.length;
                const wishlistCountElements = document.querySelectorAll('.wishlist-count');
                
                wishlistCountElements.forEach(element => {
                    element.textContent = wishlistCount;
                    if (wishlistCount > 0) {
                        element.style.display = 'flex';
                        element.classList.remove('hidden');
                    } else {
                        element.style.display = 'none';
                        element.classList.add('hidden');
                    }
                });
            }

            // Update counts on page load
            updateCartCount();
            updateWishlistCount();

            // Listen for storage changes
            window.addEventListener('storage', function(e) {
                if (e.key === 'cart') {
                    updateCartCount();
                }
                if (e.key === 'wishlist') {
                    updateWishlistCount();
                }
            });

            console.log('Orders page loaded');
        });
    </script>
</body>
</html>
