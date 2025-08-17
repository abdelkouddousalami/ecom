<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MarketPlace - Your One-Stop Shopping Destination</title>
    <meta name="description" content="Discover amazing products at unbeatable prices. Shop electronics, fashion, home goods and more.">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Wishlist button styles */
        .wishlist-btn {
            position: relative;
            overflow: hidden;
        }
        
        .wishlist-btn.in-wishlist {
            background-color: #fef2f2 !important;
            border-color: #f87171 !important;
            color: #dc2626 !important;
        }
        
        .wishlist-btn.in-wishlist .heart-icon {
            color: #dc2626 !important;
        }
        
        .wishlist-btn .heart-icon {
            font-size: 16px;
            transition: all 0.3s ease;
        }
        

        
        /* Notification animation */
        @keyframes heartbeat {
            0% { transform: scale(1); }
            25% { transform: scale(1.1); }
            50% { transform: scale(1); }
            75% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Hero Section Background Image Optimization */
        .hero-background-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        .hero-background-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
        }

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
        
        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            /* Mobile hero section full height minus navbar */
            .hero-section {
                height: calc(100vh - 4rem) !important;
                min-height: calc(100vh - 4rem) !important;
            }
            
            /* Ensure background image covers entire hero section on mobile */
            .hero-section .absolute.inset-0 img {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
                object-position: center !important;
            }
            
            .hero-title {
                font-size: 2.5rem !important;
                line-height: 1.2 !important;
                margin-top: 10px !important;
            }
            
            .hero-description {
                width: 90% !important;
                font-size: 16px !important;
                padding: 0 10px;
            }
            
            .stats-container {
                flex-direction: column !important;
                gap: 20px !important;
            }
            
            .stat-item {
                text-align: center;
            }
            
            .hero-buttons {
                flex-direction: column !important;
                gap: 15px !important;
                width: 100%;
                padding: 0 20px;
            }
            
            .hero-button {
                width: 100% !important;
                text-align: center;
            }
            
            .categories-select-container {
                flex-direction: column !important;
                gap: 15px !important;
                align-items: center !important;
            }
            
            .category-select {
                width: 100% !important;
                max-width: 280px !important;
                padding: 12px 20px !important;
                font-size: 14px !important;
            }
            
            /* Mobile grid improvements */
            .grid {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
            }
            
            /* Mobile cards */
            .product-card {
                margin: 0 10px;
            }
            
            /* Mobile newsletter */
            .newsletter-form {
                flex-direction: column !important;
                gap: 15px !important;
            }
            
            .newsletter-input {
                width: 100% !important;
            }
            
            /* Mobile footer */
            .footer-grid {
                grid-template-columns: 1fr !important;
                gap: 30px !important;
                text-align: center;
            }
            
            /* Mobile special offers */
            .special-offers-grid {
                grid-template-columns: 1fr !important;
                gap: 30px !important;
                text-align: center;
            }
            
            .countdown-container {
                justify-content: center;
                gap: 20px !important;
            }
            
            /* Mobile section padding */
            section {
                padding: 40px 0 !important;
            }
            
            .section-title {
                font-size: 2rem !important;
                margin-bottom: 20px !important;
            }
            
            .section-subtitle {
                font-size: 1rem !important;
                margin-bottom: 30px !important;
            }
        }
        
        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem !important;
                letter-spacing: 1px !important;
            }
            
            .hero-description p {
                font-size: 14px !important;
            }
            
            .stat-item .text-4xl {
                font-size: 2.5rem !important;
            }
            
            .hero-button {
                padding: 12px 20px !important;
                font-size: 14px !important;
            }
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
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
                    <a href="/" class="text-blue-600 font-semibold transition duration-300">Home</a>
                    <a href="/products" class="text-gray-600 hover:text-blue-600 font-medium transition duration-300">Products</a>
                    <a href="/orders" class="text-gray-600 hover:text-blue-600 font-medium transition duration-300">Mes Commandes</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 font-medium transition duration-300">Contact</a>
                </div>

                <!-- Right side icons - Desktop Only -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Favorites -->
                    <div class="relative">
                        <a href="/wishlist" class="text-gray-600 hover:text-blue-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-50 block">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="wishlist-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-sm hidden" style="top: -1px; left: -1px;">0</span>
                        </a>
                    </div>
                    
                    <!-- Cart (Panier) -->
                    <div class="relative">
                        <a href="/cart" class="text-gray-600 hover:text-blue-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-50 block">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="cart-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-sm hidden" style="top: -1px; left: -1px;">0</span>
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
            <a href="/" class="block text-white text-xl font-semibold py-3 px-4 rounded-lg bg-white/10 hover:bg-white/20 transition duration-300">
                Home
            </a>
            <a href="/products" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Products
            </a>
            <a href="/orders" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Mes Commandes
            </a>
            <a href="/wishlist" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
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
                <p>Your Premium Shopping Destination</p>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section relative text-white overflow-hidden" style="height: calc(100vh - 4rem);">
        <!-- Background Image with Better Overlay -->
        <div class="hero-background-container">
            <img src="{{ asset('images/banners/hero.webp') }}" alt="Hero Background" class="hero-background-image">
            <div class="absolute inset-0 bg-black/60"></div>
        </div>
        
        <!-- Scroll Down Indicator -->
        <style>
        @media (max-width: 640px) {
            .scroll-down-svg-mobile {
                margin-bottom: -50px !important;
            }
        }
        </style>
        <div class="absolute z-20" style="position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); z-index: 30;">
            <div class="animate-bounce">
                <svg onclick="scrollToNextSection()" class="w-8 h-8 text-white cursor-pointer hover:text-blue-400 transition-colors duration-300 scroll-down-svg-mobile" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 h-full pt-16">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="w-full">
                    <!-- Title centered in hero section -->
                    <div class="pt-5 text-center" >
                        <style>
                        @media (max-width: 640px) {
                            .hero-title-container-mobile {
                                margin-top: -145px !important;
                            }
                        }
                        </style>
                        <div class="pt-5 text-center hero-title-container-mobile">
                        <h1 class="hero-title font-black leading-none" style="font-size: 50px; margin-top: 20px; font-family: 'Playfair Display', 'Cinzel', 'Cormorant Garamond', serif; font-weight: 700; letter-spacing: 2px;">
                            <span style="color: white !important;">Welcome to </span><span style="color: white !important; font-style: italic;">l3oc</span><span style="color: #e63946 !important;">haq store</span>
                        </h1>
                        <!-- Store Description -->
                        <div class="hero-description mt-6 mx-auto" style="width: 70%;">
                            <p class="text-white text-lg leading-relaxed" style="font-family: 'Playfair Display', serif; font-size: 18px; line-height: 1.8;">
                                Our store is perfect for those who seek quality, elegance, and exceptional service. 
                                Discover a curated collection of premium products that blend style with functionality. 
                                Experience shopping like never before with our commitment to excellence and customer satisfaction.
                            </p>
                        </div>
                        
                        <!-- Statistics Section -->
                        <div class="stats-container mt-8 flex flex-row justify-center items-center gap-12 max-w-4xl mx-auto">
                            <div class="stat-item text-center">
                                <div class="text-4xl font-bold text-blue-400 mb-2" style="font-family: 'Playfair Display', serif;">
                                    <span id="clients-counter">0</span>+
                                </div>
                                <div class="text-white text-lg" style="font-family: 'Playfair Display', serif;">Happy Clients</div>
                            </div>
                            <div class="stat-item text-center">
                                <div class="text-4xl font-bold text-blue-400 mb-2" style="font-family: 'Playfair Display', serif;">
                                    <span id="satisfaction-counter">0</span>%
                                </div>
                                <div class="text-white text-lg" style="font-family: 'Playfair Display', serif;">Satisfaction Rate</div>
                            </div>
                            <div class="stat-item text-center">
                                <div class="text-4xl font-bold text-blue-400 mb-2" style="font-family: 'Playfair Display', serif;">
                                    <span id="products-counter">0</span>+
                                </div>
                                <div class="text-white text-lg" style="font-family: 'Playfair Display', serif;">Products Sold</div>
                            </div>
                        </div>
                        
                        <!-- Hero Buttons -->
                        <div class="hero-buttons mt-8 flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{ url('/products') }}" class="hero-button bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 cursor-pointer text-center" style="font-family: 'Playfair Display', serif;">
                                See Our Products
                            </a>
                            <button class="hero-button bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 cursor-pointer" style="font-family: 'Playfair Display', serif;">
                                Contact Us
                            </button>
                        </div>
                        </div>
                    </div>
                    
                    <!-- Main Content -->
                    <div class="space-y-12">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-left mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">Shop by Category</h2>
                <p class="text-gray-600 text-lg">Discover our premium collection of jewelry and accessories</p>
            </div>

            <div class="categories-select-container flex flex-row items-start gap-8">
                <!-- Filters aligned left, same width -->
                <div class="group cursor-pointer w-72">
                    <select class="category-select w-full" style="background-color: #ffffff !important; color: #000000 !important; font-size: 16px !important; font-weight: 600 !important; padding: 16px 32px !important; border-radius: 25px !important; border: 2px solid #60a5fa !important; outline: none !important; cursor: pointer !important; font-family: 'Playfair Display', serif !important;" onmouseover="this.style.backgroundColor='#dbeafe'" onmouseout="this.style.backgroundColor='#ffffff'">
                        <option value="" style="background-color: white !important; color: black !important;">Select Bracelets</option>
                        <option value="gold-bracelets" style="background-color: white !important; color: black !important;">Gold Bracelets</option>
                        <option value="silver-bracelets" style="background-color: white !important; color: black !important;">Silver Bracelets</option>
                        <option value="diamond-bracelets" style="background-color: white !important; color: black !important;">Diamond Bracelets</option>
                        <option value="charm-bracelets" style="background-color: white !important; color: black !important;">Charm Bracelets</option>
                    </select>
                </div>

                <div class="group cursor-pointer w-72">
                    <select class="category-select w-full" style="background-color: #ffffff !important; color: #000000 !important; font-size: 16px !important; font-weight: 600 !important; padding: 16px 32px !important; border-radius: 25px !important; border: 2px solid #9ca3af !important; outline: none !important; cursor: pointer !important; font-family: 'Playfair Display', serif !important;" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='#ffffff'">
                        <option value="" style="background-color: white !important; color: black !important;">Select Watches</option>
                        <option value="luxury-watches" style="background-color: white !important; color: black !important;">Luxury Watches</option>
                        <option value="sport-watches" style="background-color: white !important; color: black !important;">Sport Watches</option>
                        <option value="classic-watches" style="background-color: white !important; color: black !important;">Classic Watches</option>
                        <option value="smart-watches" style="background-color: white !important; color: black !important;">Smart Watches</option>
                    </select>
                </div>

                <div class="group cursor-pointer w-72">
                    <select class="category-select w-full" style="background-color: #ffffff !important; color: #000000 !important; font-size: 16px !important; font-weight: 600 !important; padding: 16px 32px !important; border-radius: 25px !important; border: 2px solid #34d399 !important; outline: none !important; cursor: pointer !important; font-family: 'Playfair Display', serif !important;" onmouseover="this.style.backgroundColor='#d1fae5'" onmouseout="this.style.backgroundColor='#ffffff'">
                        <option value="" style="background-color: white !important; color: black !important;">Select Packs</option>
                        <option value="jewelry-sets" style="background-color: white !important; color: black !important;">Jewelry Sets</option>
                        <option value="gift-packages" style="background-color: white !important; color: black !important;">Gift Packages</option>
                        <option value="wedding-packs" style="background-color: white !important; color: black !important;">Wedding Packs</option>
                        <option value="special-collections" style="background-color: white !important; color: black !important;">Special Collections</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">Featured Products</h2>
                <p class="text-gray-600 text-lg">Discover our premium jewelry collection</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $index => $product)
                <div class="product-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 group overflow-hidden cursor-pointer" onclick="window.location.href='{{ route('product.show', $product->slug) }}'">
                    <!-- Image Carousel -->
                    <div class="relative h-80 overflow-hidden">
                        @if($product->images && $product->images->count() > 0)
                            <div class="carousel-container-{{$index}} flex transition-transform duration-300 ease-in-out h-full">
                                @foreach($product->images as $imageIndex => $image)
                                <div class="w-full h-full flex-shrink-0">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{$product->name}} - Image {{$imageIndex + 1}}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                @endforeach
                            </div>
                            
                            <!-- Navigation Buttons (only show if multiple images) -->
                            @if($product->images->count() > 1)
                                <button onclick="event.stopPropagation(); previousImage({{$index}})" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75 transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button onclick="event.stopPropagation(); nextImage({{$index}})" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75 transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Image Indicators -->
                                <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2">
                                    @foreach($product->images as $imageIndex => $image)
                                    <button onclick="event.stopPropagation(); goToImage({{$index}}, {{$imageIndex}})" class="indicator-{{$index}}-{{$imageIndex}} w-2 h-2 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300 {{$imageIndex == 0 ? 'bg-opacity-100' : ''}}"></button>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <!-- Fallback for products without images -->
                            <div class="w-full h-full">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/placeholder.jpg') }}" 
                                     alt="{{$product->name}}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgdmlld0JveD0iMCAwIDQwMCA0MDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iNDAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNzUgMTc1SDE1MEMxNDQuNDc3IDE3NSAxNDAgMTcwLjUyMyAxNDAgMTY1VjE0MEMxNDAgMTM0LjQ3NyAxNDQuNDc3IDEzMCAxNTAgMTMwSDE3NUMxODAuNTIzIDEzMCAxODUgMTM0LjQ3NyAxODUgMTQwVjE2NUMxODUgMTcwLjUyMyAxODAuNTIzIDE3NSAxNzUgMTc1WiIgZmlsbD0iIzlDQTNBRiIvPgo8cGF0aCBkPSJNMjUwIDI3MEgyMDBDMTg0LjUzNiAyNzAgMTcyIDI1Ny40NjQgMTcyIDI0MlYxOTJDMTcyIDE3Ni41MzYgMTg0LjUzNiAxNjQgMjAwIDE2NEgyNTBDMjY1LjQ2NCAxNjQgMjc4IDE3Ni41MzYgMjc4IDE5MlYyNDJDMjc4IDI1Ny40NjQgMjY1LjQ2NCAyNzAgMjUwIDI3MFoiIGZpbGw9IiNEMUQ1REIiLz4KPHRleHQgeD0iMjAwIiB5PSIzMjAiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzZCNzI4MCIgdGV4dC1hbmNob3I9Im1pZGRsZSI+Tm8gSW1hZ2U8L3RleHQ+Cjwvc3ZnPgo='">
                            </div>
                        @endif
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-gray-900 group-hover:text-blue-600 transition duration-300" style="font-family: 'Playfair Display', serif;">{{$product->name}}</h3>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($product->description, 80) }}</p>
                        
                        <!-- Rating & Reviews -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                @if($product->rating)
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= floor($product->rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                    <span class="text-gray-600 text-sm ml-2">({{$product->rating}} • {{$product->review_count}} reviews)</span>
                                @else
                                    <span class="text-gray-500 text-sm">No rating yet</span>
                                @endif
                            </div>
                        </div>

                        <!-- Current Viewers -->
                        <div class="flex items-center mb-4 text-sm">
                            <div class="flex items-center text-green-600">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-2"></div>
                                <span class="font-medium">{{ rand(3, 25) }} people viewing this now</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <span class="text-2xl font-bold text-green-600" style="font-family: 'Playfair Display', serif;">{{ number_format($product->price) }} DH</span>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="text-gray-500 line-through ml-2">{{ number_format($product->original_price) }} DH</span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            @if($product->stock > 0)
                                <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg transition duration-300 cursor-pointer" style="font-family: 'Playfair Display', serif;">
                                    Ajouter au Panier
                                </button>
                            @else
                                <button class="flex-1 bg-gray-400 text-white font-semibold py-2 px-3 rounded-lg cursor-not-allowed" style="font-family: 'Playfair Display', serif;" disabled>
                                    Out of Stock
                                </button>
                            @endif
                            <button onclick="event.stopPropagation(); addToWishlist({{ $product->id }})" class="wishlist-btn flex-1 bg-transparent border-2 border-gray-300 text-gray-700 hover:bg-red-50 hover:border-red-300 hover:text-red-600 font-semibold py-2 px-3 rounded-lg transition duration-300 cursor-pointer" data-product-id="{{ $product->id }}" style="font-family: 'Playfair Display', serif;">
                                <span class="heart-icon">♡</span> Favoris
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Special Offers -->
    <section class="py-16 bg-gradient-to-r from-orange-500 to-red-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="special-offers-grid grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="section-title text-4xl font-bold mb-6">Special Offers</h2>
                    <p class="section-subtitle text-xl mb-8 text-orange-100">
                        Don't miss out on our limited-time deals! Save up to 50% on selected items.
                    </p>
                    <div class="countdown-container flex items-center space-x-6 mb-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold">24</div>
                            <div class="text-orange-200">Hours</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">15</div>
                            <div class="text-orange-200">Minutes</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">42</div>
                            <div class="text-orange-200">Seconds</div>
                        </div>
                    </div>
                    <button class="bg-white text-orange-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Shop Deals Now
                    </button>
                </div>
                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8">
                        <h3 class="text-2xl font-bold mb-4">Today's Best Deal</h3>
                        @php $firstProduct = $products->first(); @endphp
                        <div class="text-center">
                            <div class="mb-4 flex justify-center">
                                @if($firstProduct && $firstProduct->images && $firstProduct->images->count() > 0)
                                    <img src="{{ asset('storage/' . $firstProduct->images->first()->image_path) }}" alt="{{ $firstProduct->name }}" class="w-24 h-24 object-cover rounded-xl shadow-lg border-2 border-white">
                                @else
                                    <img src="{{ $firstProduct && $firstProduct->image ? asset('storage/' . $firstProduct->image) : asset('images/products/placeholder.jpg') }}" alt="{{ $firstProduct ? $firstProduct->name : 'Special Offer' }}" class="w-24 h-24 object-cover rounded-xl shadow-lg border-2 border-white">
                                @endif
                            </div>
                            <h4 class="text-xl font-semibold mb-2">{{ $firstProduct ? $firstProduct->name : 'Special Offer' }}</h4>
                            <div class="text-3xl font-bold mb-2 text-green-200">
                                {{ $firstProduct ? number_format($firstProduct->price, 2) . ' DH' : '' }}
                            </div>
                            @if($firstProduct && $firstProduct->original_price && $firstProduct->original_price > $firstProduct->price)
                                <div class="text-orange-200 line-through">{{ number_format($firstProduct->original_price, 2) }} DH</div>
                                <div class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold mt-2 inline-block">
                                    {{ round(100 - ($firstProduct->price / $firstProduct->original_price) * 100) }}% OFF
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
            <p class="text-gray-300 text-lg mb-8">Subscribe to our newsletter and be the first to know about new products and exclusive offers.</p>
            
            <div class="newsletter-form flex flex-col sm:flex-row max-w-lg mx-auto gap-4">
                <input type="email" placeholder="Enter your email address" 
                       class="newsletter-input flex-1 px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-medium">
                    Subscribe
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <style>
            @media (max-width: 640px) {
                .footer-grid {
                    text-align: left !important;
                }
                .footer-grid > div, .footer-grid h3, .footer-grid h4, .footer-grid p, .footer-grid ul, .footer-grid li {
                    text-align: left !important;
                    justify-content: flex-start !important;
                    align-items: flex-start !important;
                }
            }
            </style>
            <div class="footer-grid grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <img src="{{ asset('images/logos/logo.png') }}" alt="l3ochaq Store Logo" class="h-12 w-auto mb-4 object-contain">
                    <p class="text-gray-400 mb-4">Your trusted online shopping destination with quality products and excellent service.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Shipping Info</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Returns</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Electronics</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Fashion</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Home & Garden</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Sports</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Books</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <div class="space-y-2 text-gray-400">
                        <p>📍 123 Market Street, City, State 12345</p>
                        <p>📞 (555) 123-4567</p>
                        <p>✉️ info@marketplace.com</p>
                        <p>🕒 Mon-Fri: 9AM-6PM</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 MarketPlace. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple countdown timer for special offers
        function updateCountdown() {
            const now = new Date().getTime();
            const endTime = now + (24 * 60 * 60 * 1000); // 24 hours from now
            
            const distance = endTime - now;
            
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // This would update the countdown elements if they exist
            // Implementation would depend on specific requirements
        }
        
        // Update countdown every second
        setInterval(updateCountdown, 1000);

        // Smooth scroll down function
        function scrollToNextSection() {
            const heroSection = document.querySelector('section');
            const nextSection = heroSection.nextElementSibling;
            if (nextSection) {
                nextSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            } else {
                // If no next section, scroll to bottom of hero
                window.scrollTo({
                    top: window.innerHeight,
                    behavior: 'smooth'
                });
            }
        }

        // Animated counter function
        function animateCounter(elementId, targetValue, duration = 2000) {
            const element = document.getElementById(elementId);
            const startValue = 0;
            const increment = targetValue / (duration / 16); // 60 FPS
            let currentValue = startValue;

            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= targetValue) {
                    currentValue = targetValue;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(currentValue);
            }, 16);
        }

        // Start counter animations when page loads
        window.addEventListener('load', () => {
            // Add a small delay to make it more noticeable
            setTimeout(() => {
                animateCounter('clients-counter', 500, 2000);
                animateCounter('satisfaction-counter', 98, 2000);
                animateCounter('products-counter', 1000, 2000);
            }, 500);
        });

        // Product carousel functionality
        let currentImageIndex = {}; // Use object to track each product separately
        
        function nextImage(productIndex) {
            if (!currentImageIndex[productIndex]) {
                currentImageIndex[productIndex] = 0;
            }
            const carousel = document.querySelector('.carousel-container-' + productIndex);
            if (!carousel) return; // Exit if carousel doesn't exist
            
            const totalImages = carousel.children.length;
            if (totalImages === 0) return;
            
            currentImageIndex[productIndex] = (currentImageIndex[productIndex] + 1) % totalImages;
            updateCarousel(productIndex, totalImages);
        }

        function previousImage(productIndex) {
            if (!currentImageIndex[productIndex]) {
                currentImageIndex[productIndex] = 0;
            }
            const carousel = document.querySelector('.carousel-container-' + productIndex);
            if (!carousel) return; // Exit if carousel doesn't exist
            
            const totalImages = carousel.children.length;
            if (totalImages === 0) return;
            
            currentImageIndex[productIndex] = (currentImageIndex[productIndex] - 1 + totalImages) % totalImages;
            updateCarousel(productIndex, totalImages);
        }

        function goToImage(productIndex, imageIndex) {
            const carousel = document.querySelector('.carousel-container-' + productIndex);
            if (!carousel) return; // Exit if carousel doesn't exist
            
            const totalImages = carousel.children.length;
            if (totalImages === 0) return;
            
            currentImageIndex[productIndex] = imageIndex;
            updateCarousel(productIndex, totalImages);
        }

        function updateCarousel(productIndex, totalImages) {
            const carousel = document.querySelector('.carousel-container-' + productIndex);
            if (!carousel) return; // Exit if carousel doesn't exist
            
            const translateX = -currentImageIndex[productIndex] * 100;
            carousel.style.transform = 'translateX(' + translateX + '%)';
            
            // Update indicators
            for (let i = 0; i < totalImages; i++) {
                const indicator = document.querySelector('.indicator-' + productIndex + '-' + i);
                if (indicator) {
                    if (i === currentImageIndex[productIndex]) {
                        indicator.classList.remove('bg-opacity-50');
                        indicator.classList.add('bg-opacity-100');
                    } else {
                        indicator.classList.remove('bg-opacity-100');
                        indicator.classList.add('bg-opacity-50');
                    }
                }
            }
        }

        // Auto-slide functionality (optional) - only if products exist
        let autoSlideInterval;
        
        function startAutoSlide() {
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
            }
            
            autoSlideInterval = setInterval(() => {
                const productCards = document.querySelectorAll('[class*="carousel-container-"]');
                productCards.forEach((carousel, index) => {
                    if (carousel && carousel.children.length > 1) { // Only slide if multiple images
                        nextImage(index);
                    }
                });
            }, 5000); // Auto-slide every 5 seconds
        }
        
        // Start auto-slide when page is loaded and has products
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(startAutoSlide, 1000); // Start after 1 second to ensure DOM is ready
        });
        
        // Stylish notification function
        function showNotification(message, type = 'success') {
            // Remove any existing notification
            const existingNotification = document.querySelector('.custom-notification');
            if (existingNotification) {
                existingNotification.remove();
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'custom-notification';

            const bgColor = type === 'success' ? '#3b82f6' : 
                           type === 'removed' ? '#6b7280' : '#3b82f6';

            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                background: ${bgColor};
                color: white;
                padding: 16px 24px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
                min-width: 320px;
                transform: translateX(100%) scale(0.8);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                font-family: system-ui, -apple-system, sans-serif;
                font-weight: 600;
                font-size: 14px;
                border: 2px solid rgba(255,255,255,0.2);
                text-align: left;
            `;

            notification.innerHTML = `<span>${message}</span>`;

            document.body.appendChild(notification);

            // Slide in animation with bounce
            setTimeout(() => {
                notification.style.transform = 'translateX(0) scale(1)';
            }, 100);

            // Auto remove after 3 seconds with slide out animation
            setTimeout(() => {
                notification.style.transform = 'translateX(100%) scale(0.8)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 400);
            }, 3000);
        }
        
        function addToCart(productId, quantity = 1) {
            console.log('addToCart called with productId:', productId, 'quantity:', quantity);
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Check if product already in cart
            const existingItem = cart.find(item => item.id == productId);
            if (existingItem) {
                existingItem.quantity += quantity;
                console.log('Updating cart quantity');
                showNotification('Quantité mise à jour dans le panier!', 'success');
            } else {
                cart.push({
                    id: productId,
                    quantity: quantity,
                    added_at: new Date().toISOString()
                });
                console.log('Adding new product to cart');
                showNotification('Produit ajouté au panier!', 'success');
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }
        
        function addToWishlist(productId) {
            let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            const wishlistBtn = document.querySelector(`[data-product-id="${productId}"]`);
            // Check if product already in wishlist
            const existingIndex = wishlist.findIndex(item => item.id == productId);
            if (existingIndex > -1) {
                wishlist.splice(existingIndex, 1);
                showNotification('Produit retiré des favoris!', 'removed' );
                // Update button appearance
                if (wishlistBtn) {
                    wishlistBtn.classList.remove('in-wishlist');
                    wishlistBtn.style.backgroundColor = '';
                    wishlistBtn.style.color = '';
                }
            } else {
                wishlist.push({
                    id: productId,
                    added_at: new Date().toISOString()
                });
                showNotification('Produit ajouté aux favoris!', 'success');
                // Update button appearance
                if (wishlistBtn) {
                    wishlistBtn.classList.add('in-wishlist');
                    wishlistBtn.style.backgroundColor = '#fee2e2'; // light red background
                    wishlistBtn.style.color = '#e63946'; // attractive red text
                }
            }
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
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

        function updateWishlistButtons() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            const wishlistBtns = document.querySelectorAll('.wishlist-btn');
            wishlistBtns.forEach(btn => {
                const productId = parseInt(btn.getAttribute('data-product-id'));
                const isInWishlist = wishlist.some(item => item.id == productId);
                if (isInWishlist) {
                    btn.classList.add('in-wishlist');
                    btn.style.backgroundColor = '#fee2e2';
                    btn.style.color = '#e63946';
                } else {
                    btn.classList.remove('in-wishlist');
                    btn.style.backgroundColor = '';
                    btn.style.color = '';
                }
            });
        }
        
        // Initialize cart and wishlist counts on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            updateWishlistCount();
            updateWishlistButtons();
            
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

            // Close mobile menu when clicking on a menu item (except current page)
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
        });
    </script>

</body>
</html>