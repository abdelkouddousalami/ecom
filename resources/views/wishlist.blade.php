<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris - l3ochaq Store</title>
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
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
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
                border-radius: 2px;
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
                    <a href="/orders" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Mes Commandes</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Contact</a>
                </div>

                <!-- Right side icons -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Favorites -->
                    <div class="relative">
                        <a href="/wishlist" class="text-blue-600 relative transition duration-300 p-2 rounded-lg bg-blue-50 block">
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
            <a href="/orders" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Mes Commandes
            </a>
            <a href="/wishlist" class="block text-white text-xl font-semibold py-3 px-4 rounded-lg bg-white/10 hover:bg-white/20 transition duration-300">
                Mes Favoris
            </a>
            <a href="#" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Contact
            </a>
        </div>

        <!-- Mobile Menu Footer -->
        <div class="absolute bottom-8 left-6 right-6">
            <div class="text-center text-white/70 text-sm">
                <p>© 2025 l3ochaq Store</p>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="bg-red-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center">Mes Favoris</h1>
            <p class="text-red-100 text-center mt-2">Vos produits préférés en un seul endroit</p>
        </div>
    </div>

    <!-- Wishlist Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div id="wishlist-container">
            <!-- Wishlist items will be loaded here -->
            <div id="empty-wishlist" class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Aucun produit dans vos favoris</h3>
                <p class="text-gray-600 mb-6">Explorez nos produits et ajoutez ceux que vous aimez à vos favoris</p>
                <a href="/" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    Découvrir les produits
                </a>
            </div>

            <!-- Wishlist Items -->
            <div id="wishlist-items" class="hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Vos produits favoris</h2>
                    <button onclick="clearWishlist()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                        Vider les favoris
                    </button>
                </div>
                
                <div id="items-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Dynamic wishlist items will be inserted here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        let products = @json($products ?? []); // Pass products data from controller

        function loadWishlist() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            const wishlistContainer = document.getElementById('wishlist-container');
            const emptyWishlist = document.getElementById('empty-wishlist');
            const wishlistItems = document.getElementById('wishlist-items');
            const itemsGrid = document.getElementById('items-grid');

            if (wishlist.length === 0) {
                emptyWishlist.classList.remove('hidden');
                wishlistItems.classList.add('hidden');
            } else {
                emptyWishlist.classList.add('hidden');
                wishlistItems.classList.remove('hidden');
                
                itemsGrid.innerHTML = '';

                wishlist.forEach(item => {
                    const product = products.find(p => p.id == item.id);
                    if (product) {
                        const wishlistItemHTML = `
                            <div class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="${product.image || 'https://via.placeholder.com/300'}" alt="${product.name}" class="w-full h-48 object-cover">
                                    <button onclick="removeFromWishlist(${item.id})" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-2">${product.name}</h3>
                                    <p class="text-gray-600 text-sm mb-3">${product.description ? product.description.substring(0, 80) + '...' : ''}</p>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-xl font-bold text-green-600">${product.price} DH</span>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        <button onclick="addToCartFromWishlist(${item.id})" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg transition duration-300">
                                            Ajouter au Panier
                                        </button>
                                        <button onclick="viewProduct(${item.id})" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-3 rounded-lg transition duration-300">
                                            Voir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        itemsGrid.innerHTML += wishlistItemHTML;
                    }
                });
            }
            
            updateCartCount();
            updateWishlistCount();
        }

        function removeFromWishlist(productId) {
            let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            wishlist = wishlist.filter(item => item.id != productId);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            loadWishlist();
            alert('Produit retiré des favoris!');
        }

        function addToCartFromWishlist(productId) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            const existingItem = cart.find(item => item.id == productId);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: productId,
                    quantity: 1,
                    added_at: new Date().toISOString()
                });
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            alert('Produit ajouté au panier!');
        }

        function viewProduct(productId) {
            const product = products.find(p => p.id == productId);
            if (product && product.slug) {
                window.location.href = `/product/${product.slug}`;
            } else {
                window.location.href = `/`;
            }
        }

        function clearWishlist() {
            if (confirm('Êtes-vous sûr de vouloir vider vos favoris?')) {
                localStorage.removeItem('wishlist');
                loadWishlist();
                alert('Favoris vidés!');
            }
        }

        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            const cartCountElements = document.querySelectorAll('.cart-count');
            cartCountElements.forEach(element => {
                if (count > 0) {
                    element.textContent = count;
                    element.classList.remove('hidden');
                    element.classList.add('flex');
                } else {
                    element.classList.add('hidden');
                    element.classList.remove('flex');
                }
            });
        }

        function updateWishlistCount() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            const count = wishlist.length;
            const wishlistCountElements = document.querySelectorAll('.wishlist-count');
            wishlistCountElements.forEach(element => {
                if (count > 0) {
                    element.textContent = count;
                    element.classList.remove('hidden');
                    element.classList.add('flex');
                } else {
                    element.classList.add('hidden');
                    element.classList.remove('flex');
                }
            });
        }

        // Load wishlist on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality
            const mobileMenuBtn = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const closeMobileMenuBtn = document.getElementById('closeMobileMenu');

            if (mobileMenuBtn && mobileMenu && mobileMenuOverlay) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenuBtn.classList.toggle('active');
                    mobileMenu.classList.toggle('active');
                    mobileMenuOverlay.classList.toggle('active');
                });

                // Close menu when clicking overlay
                mobileMenuOverlay.addEventListener('click', function() {
                    mobileMenuBtn.classList.remove('active');
                    mobileMenu.classList.remove('active');
                    mobileMenuOverlay.classList.remove('active');
                });

                // Close menu when clicking close button
                if (closeMobileMenuBtn) {
                    closeMobileMenuBtn.addEventListener('click', function() {
                        mobileMenuBtn.classList.remove('active');
                        mobileMenu.classList.remove('active');
                        mobileMenuOverlay.classList.remove('active');
                    });
                }
            }

            loadWishlist();
        });
    </script>
</body>
</html>
