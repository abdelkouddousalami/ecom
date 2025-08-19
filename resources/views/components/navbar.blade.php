@props(['activePage' => 'home'])

<!-- Navbar Styles -->
<style>
    /* Mobile Navigation Styles */
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
    
    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 998;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .mobile-menu-overlay.active {
        opacity: 1;
        visibility: visible;
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
        margin: 2px 0;
        transition: 0.3s;
        border-radius: 3px;
    }

    .hamburger:hover span {
        background-color: #dc2626;
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

<!-- Navigation -->
<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
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

            <!-- Navigation Links (Center) - Desktop Only -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="{{ $activePage === 'home' ? 'text-red-600 hover:text-red-700' : 'text-gray-600 hover:text-red-600' }} font-medium transition duration-300" style="font-family: 'Playfair Display', serif;">Home</a>
                <a href="/products" class="{{ $activePage === 'products' ? 'text-red-600 hover:text-red-700' : 'text-gray-600 hover:text-red-600' }} font-medium transition duration-300" style="font-family: 'Playfair Display', serif;">Products</a>
                <a href="/orders" class="{{ $activePage === 'orders' ? 'text-red-600 hover:text-red-700' : 'text-gray-600 hover:text-red-600' }} font-medium transition duration-300" style="font-family: 'Playfair Display', serif;">Orders</a>
                <a href="#" class="{{ $activePage === 'contact' ? 'text-red-600 hover:text-red-700' : 'text-gray-600 hover:text-red-600' }} font-medium transition duration-300" style="font-family: 'Playfair Display', serif;">Contact</a>
            </div>

            <!-- Right side icons - Desktop Only -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Favorites -->
                <div class="relative">
                    <a href="/wishlist" class="text-gray-600 hover:text-red-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-50 block">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="wishlist-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-sm hidden" style="top: -1px; left: -1px;">0</span>
                    </a>
                </div>
                
                <!-- Cart (Panier) -->
                <div class="relative">
                    <a href="/cart" class="text-gray-600 hover:text-red-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-50 block">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="cart-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-sm hidden" style="top: -1px; left: -1px;">0</span>
                    </a>
                </div>

                <!-- Authentication Links -->
                @auth
                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-red-600 transition duration-300 p-2 rounded-lg hover:bg-gray-50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                            <div class="py-1">
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-200">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Mon Profil
                                </a>
                                <a href="/orders" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-200">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Mes Commandes
                                </a>
                                @if(Auth::user()->role === 'admin')
                                    <a href="/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-200">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Admin Panel
                                    </a>
                                @endif
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="/logout" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-200">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Se Déconnecter
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Authentication links are hidden - users must know the secret URLs -->
                    <div class="flex items-center space-x-3">
                        <!-- Empty space for guests -->
                    </div>
                @endauth
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
                <button id="mobileMenuToggle" class="hamburger text-gray-600 hover:text-red-600 p-2">
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
        <h2 class="text-white text-2xl font-bold" style="font-family: 'Playfair Display', serif;">Menu</h2>
        <button id="closeMobileMenu" class="text-white text-3xl">&times;</button>
    </div>
    
    <div class="space-y-6">
        <a href="/" class="block text-white text-xl {{ $activePage === 'home' ? 'font-semibold bg-white/10' : 'font-medium hover:bg-white/10' }} py-3 px-4 rounded-lg transition duration-300" style="font-family: 'Playfair Display', serif;">
            Home
        </a>
        <a href="/products" class="block text-white text-xl {{ $activePage === 'products' ? 'font-semibold bg-white/10' : 'font-medium hover:bg-white/10' }} py-3 px-4 rounded-lg transition duration-300" style="font-family: 'Playfair Display', serif;">
            Products
        </a>
        <a href="/orders" class="block text-white text-xl {{ $activePage === 'orders' ? 'font-semibold bg-white/10' : 'font-medium hover:bg-white/10' }} py-3 px-4 rounded-lg transition duration-300" style="font-family: 'Playfair Display', serif;">
            Orders
        </a>
        <a href="/wishlist" class="block text-white text-xl {{ $activePage === 'wishlist' ? 'font-semibold bg-white/10' : 'font-medium hover:bg-white/10' }} py-3 px-4 rounded-lg transition duration-300" style="font-family: 'Playfair Display', serif;">
            Mes Favoris
        </a>
        <a href="#" class="block text-white text-xl {{ $activePage === 'contact' ? 'font-semibold bg-white/10' : 'font-medium hover:bg-white/10' }} py-3 px-4 rounded-lg transition duration-300" style="font-family: 'Playfair Display', serif;">
            Contact
        </a>

        <!-- Mobile Authentication Links -->
        <div class="border-t border-white/20 pt-4 mt-6">
            @auth
                <div class="space-y-3">
                    <a href="/profile" class="flex items-center text-white text-lg font-medium hover:bg-white/10 py-3 px-4 rounded-lg transition duration-300" style="font-family: 'Playfair Display', serif;">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Mon Profil
                    </a>
                    @if(Auth::user()->role === 'admin')
                        <a href="/admin/dashboard" class="flex items-center text-yellow-300 text-lg font-medium hover:bg-yellow-500/20 py-3 px-4 rounded-lg transition duration-300" style="font-family: 'Playfair Display', serif;">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Admin Panel
                        </a>
                    @endif
                    <form method="POST" action="/logout" class="block">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-left text-red-300 text-lg font-medium hover:bg-red-500/20 py-3 px-4 rounded-lg transition duration-300" style="font-family: 'Playfair Display', serif;">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Se Déconnecter
                        </button>
                    </form>
                </div>
            @else
                <!-- Authentication links are hidden for mobile too -->
                <div class="space-y-3">
                    <!-- Empty space for guests -->
                </div>
            @endauth
        </div>
    </div>

    <!-- Mobile Menu Footer -->
    <div class="absolute bottom-8 left-6 right-6">
        <div class="text-center text-white/70 text-sm" style="font-family: 'Playfair Display', serif;">
            <p>© 2025 l3ochaq Store</p>
            <p>Your Premium Shopping Destination</p>
        </div>
    </div>
</div>

<!-- Navbar JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const closeMobileMenu = document.getElementById('closeMobileMenu');

    function openMobileMenu() {
        if (mobileMenu && mobileMenuOverlay && mobileMenuToggle) {
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            mobileMenuToggle.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeMobileMenuFunc() {
        if (mobileMenu && mobileMenuOverlay && mobileMenuToggle) {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                closeMobileMenuFunc();
            } else {
                openMobileMenu();
            }
        });
    }

    if (closeMobileMenu) {
        closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
    }

    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
    }

    // Close mobile menu when clicking on a menu item (except current page)
    const mobileMenuLinks = document.querySelectorAll('#mobileMenu a');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            setTimeout(closeMobileMenuFunc, 300);
        });
    });

    // Close mobile menu on window resize if open
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenuFunc();
        }
    });
});
</script>
