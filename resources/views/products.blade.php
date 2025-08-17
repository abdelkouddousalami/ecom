<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - l3ochaq Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    
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
        
        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }
        
        /* Mobile hero section full height */
        @media (max-width: 768px) {
            .hero-section {
                height: calc(100vh - 4rem) !important;
                min-height: calc(100vh - 4rem) !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50 h-full m-0 p-0" style="font-family: 'Playfair Display', serif;">

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="flex-shrink-0">
                        <img src="{{ asset('images/logos/logo.png') }}" 
                             alt="MarketPlace Logo" 
                             class="h-8 w-auto object-contain">
                    </a>
                </div>

                <!-- Navigation Links (Center) - Desktop Only -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Home</a>
                    <a href="/products" class="text-blue-600 hover:text-blue-700 font-medium transition duration-300">Products</a>
                    <a href="/orders" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Mes Commandes</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Contact</a>
                    <a href="/admin/products" class="text-gray-700 hover:text-orange-600 font-medium transition duration-300">Admin</a>
                </div>

                <!-- Right side icons - Desktop Only -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Favorites -->
                    <div class="relative">
                        <a href="/wishlist" class="text-gray-700 hover:text-blue-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-100 block">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="wishlist-count absolute top-0 -left-2 bg-red-500 text-white rounded-full w-4 h-4 items-center justify-center text-xs font-semibold shadow-sm hidden">0</span>
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
            <a href="/products" class="block text-white text-xl font-semibold py-3 px-4 rounded-lg bg-white/10 hover:bg-white/20 transition duration-300">
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
            <a href="/admin/products" class="block text-white text-xl font-medium py-3 px-4 rounded-lg hover:bg-white/10 transition duration-300">
                Admin
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

    <!-- Page Header -->
    <section class="hero-section relative text-white w-full overflow-hidden" style="height: 80vh; background-image: url('{{ asset('images/banners/prosucts.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2" style="background-size: 60px 60px;"></div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full animate-float"></div>
        <div class="absolute top-20 right-20 w-16 h-16 bg-white bg-opacity-10 rounded-full animate-float-delayed"></div>
        <div class="absolute bottom-10 left-1/4 w-12 h-12 bg-white bg-opacity-10 rounded-full animate-float"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center h-full flex flex-col justify-center items-center pt-20">
            <!-- Breadcrumb -->
            <div class="mb-6 animate-fade-in-up-delay-1" style="margin-top: 20px;">
                <nav class="flex justify-center" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ url('/') }}" class="inline-flex items-center text-gray-200 hover:text-white transition-colors duration-300">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-white font-medium">Products</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Main Title -->
            <div class="animate-fade-in-up-delay-2">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight font-playfair">
                    <span class="block text-white">Discover Our</span>
                    <span class="block text-gray-200 italic">Premium Collection</span>
                </h1>
            </div>

            <!-- Subtitle -->
            <div class="animate-fade-in-up-delay-3">
                <p class="text-xl md:text-2xl text-gray-100 mb-8 max-w-3xl mx-auto leading-relaxed font-playfair">
                    Explore our curated selection of exquisite jewelry, accessories, and luxury items crafted with passion and precision
                </p>
            </div>

            <!-- Statistics -->
            <div class="animate-fade-in-up-delay-4">
                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12 mb-8">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-gray-200 mb-2 font-playfair">
                            <span id="total-products-counter">0</span>+
                        </div>
                        <div class="text-white text-sm md:text-base font-playfair">Products Available</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-gray-200 mb-2 font-playfair">
                            <span id="categories-counter">0</span>+
                        </div>
                        <div class="text-white text-sm md:text-base font-playfair">Categories</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-gray-200 mb-2 font-playfair">
                            <span id="daily-views-counter">0</span>+
                        </div>
                        <div class="text-white text-sm md:text-base font-playfair">Daily Views</div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="animate-fade-in-up-delay-5">
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button onclick="scrollToProducts()" class="bg-white text-gray-900 hover:bg-gray-100 font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-playfair">
                        Browse Products
                    </button>
                    <button class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-playfair">
                        Filter by Category
                    </button>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-16 left-1/2 transform -translate-x-1/2 animate-bounce z-20" style="left: 50%; bottom: 16px; transform: translateX(-50%);">
            <svg onclick="scrollToProducts()" class="w-8 h-8 text-white cursor-pointer hover:text-gray-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Filters -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <div class="flex justify-center items-center">
                <!-- Category Filter -->
                <div class="flex gap-6">
                    <select class="px-6 py-4 bg-white rounded-xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:shadow-xl transition-all duration-300 font-medium text-gray-700 hover:shadow-2xl transform hover:-translate-y-1">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <!-- Sort By -->
                    <select class="px-6 py-4 bg-white rounded-xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:shadow-xl transition-all duration-300 font-medium text-gray-700 hover:shadow-2xl transform hover:-translate-y-1">
                        <option value="newest">Newest</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="rating">Highest Rated</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-12">
                @foreach($products as $product)
                <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 group overflow-hidden cursor-pointer transform hover:-translate-y-3 hover:scale-105 animate-fade-in mx-4 my-6" onclick="window.location.href='{{ route('product.show', $product->slug) }}'">
                    <!-- Product Images with Slider -->
                    <div class="relative h-72 overflow-hidden group rounded-t-3xl">
                        @if($product->images && $product->images->count() > 0)
                            <!-- Main Image -->
                            <div class="image-slider relative w-full h-full" data-product-id="{{ $product->id }}">
                                @foreach($product->images as $index => $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="slider-image w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 {{ $index === 0 ? 'block' : 'hidden' }}"
                                         data-index="{{ $index }}">
                                @endforeach
                                
                                <!-- Navigation Arrows (only show if multiple images) -->
                                @if($product->images->count() > 1)
                                    <button onclick="event.stopPropagation(); prevImage({{ $product->id }})" class="slider-prev absolute left-3 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-black/80 to-gray-800/80 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-500 z-10 hover:scale-110 hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <button onclick="event.stopPropagation(); nextImage({{ $product->id }})" class="slider-next absolute right-3 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-black/80 to-gray-800/80 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-500 z-10 hover:scale-110 hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                    
                                    <!-- Image Indicators -->
                                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                        @foreach($product->images as $index => $image)
                                            <div class="indicator w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white shadow-lg' : 'bg-white/50 hover:bg-white/80' }}" 
                                                 data-index="{{ $index }}"></div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Fallback for products without images -->
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&h=400&fit=crop' }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @endif
                        
                        <!-- Quick Actions -->
                        <div class="absolute top-5 right-5 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                            <button onclick="event.stopPropagation(); addToWishlist({{ $product->id }})" class="bg-white/90 backdrop-blur-sm p-3 rounded-full shadow-xl hover:bg-gray-100 hover:shadow-2xl transition-all duration-300 mb-3 transform hover:scale-110">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-8 space-y-4">
                        <h3 class="font-bold text-xl mb-3 text-gray-900 group-hover:text-gray-700 transition-all duration-300 leading-tight">{{ $product->name }}</h3>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-base mb-4 leading-relaxed">{{ Str::limit($product->description, 80) }}</p>
                        
                        <!-- Rating & Reviews -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                @if($product->rating)
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= floor($product->rating) ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                    <span class="text-gray-600 text-sm ml-3 font-medium">({{ $product->rating }} • {{ $product->review_count }} reviews)</span>
                                @else
                                    <span class="text-gray-500 text-sm font-medium">No rating yet</span>
                                @endif
                            </div>
                        </div>

                        <!-- Current Viewers -->
                        <div class="flex items-center mb-5 text-sm">
                            <div class="flex items-center text-gray-700 bg-gray-100 px-3 py-2 rounded-full">
                                <div class="w-2 h-2 bg-gray-600 rounded-full animate-pulse mr-3"></div>
                                <span class="font-semibold">{{ rand(3, 25) }} people viewing this now</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="space-y-1">
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($product->price) }} DH</span>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <div class="flex items-center space-x-2">
                                        <span class="text-gray-500 line-through text-base">{{ number_format($product->original_price) }} DH</span>
                                        <span class="bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-full font-bold">-{{ $product->discount_percentage }}%</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Stock Status -->
                        @if($product->stock <= 5)
                            <div class="mb-5">
                                <span class="inline-flex px-3 py-2 text-sm font-semibold rounded-full transition-colors duration-200 {{ $product->stock == 0 ? 'bg-gray-200 text-gray-800' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $product->stock == 0 ? 'Out of Stock' : 'Only ' . $product->stock . ' left!' }}
                                </span>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex gap-2 pt-2">
                            @if($product->stock > 0)
                                <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-3 rounded-lg transition-all duration-300 cursor-pointer text-sm shadow-md hover:shadow-lg transform hover:scale-105">
                                    Panier
                                </button>
                            @else
                                <button class="flex-1 bg-gray-400 text-white font-medium py-2 px-3 rounded-lg cursor-not-allowed text-sm opacity-50" disabled>
                                    Stock
                                </button>
                            @endif
                            <button onclick="event.stopPropagation(); addToWishlist({{ $product->id }})" class="flex-1 bg-transparent hover:bg-gray-50 text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded-lg transition-all duration-300 cursor-pointer text-sm shadow-md hover:shadow-lg transform hover:scale-105 ring-1 ring-gray-200 hover:ring-gray-300">
                                Favoris
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center space-x-3">
                    <button class="px-5 py-3 text-gray-500 hover:text-gray-900 transition-all duration-300 rounded-xl hover:bg-gray-100 hover:shadow-lg transform hover:scale-105 font-medium">Previous</button>
                    <button class="px-5 py-3 bg-gray-900 text-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 font-semibold">1</button>
                    <button class="px-5 py-3 text-gray-700 hover:text-gray-900 transition-all duration-300 rounded-xl hover:bg-gray-100 hover:shadow-lg transform hover:scale-105 font-medium">2</button>
                    <button class="px-5 py-3 text-gray-700 hover:text-gray-900 transition-all duration-300 rounded-xl hover:bg-gray-100 hover:shadow-lg transform hover:scale-105 font-medium">3</button>
                    <button class="px-5 py-3 text-gray-500 hover:text-gray-900 transition-all duration-300 rounded-xl hover:bg-gray-100 hover:shadow-lg transform hover:scale-105 font-medium">Next</button>
                </nav>
            </div>
        </div>
    </section>

    <!-- Footer -->
   <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="footer-grid grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-2xl font-bold mb-4">MarketPlace</h3>
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

    <style>
        /* Font Classes */
        .font-playfair { 
            font-family: 'Playfair Display', serif; 
        }
        
        /* Animation Keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-25px);
            }
        }
        
        @keyframes floatDelayed {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Animation Classes */
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
            opacity: 0;
        }
        
        .animate-fade-in-up-delay-1 {
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }
        
        .animate-fade-in-up-delay-2 {
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }
        
        .animate-fade-in-up-delay-3 {
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.6s;
            opacity: 0;
        }
        
        .animate-fade-in-up-delay-4 {
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.8s;
            opacity: 0;
        }
        
        .animate-fade-in-up-delay-5 {
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 1s;
            opacity: 0;
        }
        
        .animate-float {
            animation: float 8s ease-in-out infinite;
        }
        
        .animate-float-delayed {
            animation: floatDelayed 10s ease-in-out infinite;
            animation-delay: 2s;
        }
        
        .animate-slide-left {
            animation: slideInLeft 0.6s ease-out forwards;
        }
        
        .animate-slide-right {
            animation: slideInRight 0.6s ease-out forwards;
        }
        
        .animate-scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }
        
        /* Smooth Transitions */
        * {
            transition-property: transform, box-shadow, background-color, border-color, color;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Glass Effect */
        .glass-effect {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }
        
        /* Hover Effects for Cards */
        .product-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .product-card:hover {
            transform: translateY(-12px) scale(1.02);
        }
        
        /* Focus States */
        button:focus,
        select:focus,
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        
        /* Loading Animation */
        .loading-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Enhanced Box Shadows */
        .shadow-smooth {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .shadow-smooth-lg {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Product Grid Animation */
        .product-grid > * {
            animation: fadeInUp 0.6s ease-out forwards;
            animation-delay: calc(var(--index, 0) * 0.1s);
            opacity: 0;
        }
        
        /* Responsive Improvements */
        @media (max-width: 768px) {
            .animate-fade-in-up-delay-1,
            .animate-fade-in-up-delay-2,
            .animate-fade-in-up-delay-3,
            .animate-fade-in-up-delay-4,
            .animate-fade-in-up-delay-5 {
                animation-delay: 0.1s;
            }
        }
    </style>

    <script>
        // Animated Counters
        function animateCounter(elementId, targetValue, duration = 2000) {
            const element = document.getElementById(elementId);
            if (!element) return;
            
            const startValue = 0;
            const increment = targetValue / (duration / 16);
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
        
        // Scroll to products section
        function scrollToProducts() {
            const productsSection = document.querySelector('.grid');
            if (productsSection) {
                productsSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
        
        // Initialize animations when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Start counter animations after a delay
            setTimeout(() => {
                animateCounter('total-products-counter', 150, 2000);
                animateCounter('categories-counter', 12, 1500);
                animateCounter('daily-views-counter', 2500, 2500);
            }, 1000);
            
            // Initialize image sliders
            initializeImageSliders();
        });
        
        // Image Slider functionality
        function initializeImageSliders() {
            const sliders = document.querySelectorAll('.image-slider');
            
            sliders.forEach(slider => {
                const productId = slider.dataset.productId;
                const images = slider.querySelectorAll('.slider-image');
                const prevBtn = slider.querySelector('.slider-prev');
                const nextBtn = slider.querySelector('.slider-next');
                const indicators = slider.querySelectorAll('.indicator');
                
                if (images.length <= 1) return; // Skip if only one image
                
                let currentIndex = 0;
                
                function showImage(index) {
                    // Hide all images
                    images.forEach(img => img.classList.add('hidden'));
                    indicators.forEach(ind => {
                        ind.classList.remove('bg-white');
                        ind.classList.add('bg-white', 'bg-opacity-50');
                    });
                    
                    // Show current image
                    images[index].classList.remove('hidden');
                    if (indicators[index]) {
                        indicators[index].classList.remove('bg-opacity-50');
                        indicators[index].classList.add('bg-white');
                    }
                }
                
                function nextImage() {
                    currentIndex = (currentIndex + 1) % images.length;
                    showImage(currentIndex);
                }
                
                function prevImage() {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    showImage(currentIndex);
                }
                
                // Event listeners
                if (nextBtn) nextBtn.addEventListener('click', nextImage);
                if (prevBtn) prevBtn.addEventListener('click', prevImage);
                
                // Indicator clicks
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        currentIndex = index;
                        showImage(currentIndex);
                    });
                });
                
                // Auto-slide (optional - uncomment to enable)
                // setInterval(nextImage, 5000);
            });
        }
        
        // Simple cart and wishlist functions using localStorage
        function addToCart(productId) {
            console.log('addToCart called with productId:', productId);
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Check if product already in cart
            const existingItem = cart.find(item => item.id == productId);
            if (existingItem) {
                existingItem.quantity += 1;
                console.log('Updating cart quantity');
                showNotification('Quantité mise à jour dans le panier!', 'success', '🛒');
            } else {
                cart.push({
                    id: productId,
                    quantity: 1,
                    added_at: new Date().toISOString()
                });
                console.log('Adding new product to cart');
                showNotification('Produit ajouté au panier!', 'success', '🛒');
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }

        // Stylish notification function (simplified version)
        function showNotification(message, type = 'success', icon = '❤️') {
            console.log('showNotification called:', message, type, icon);
            
            // Remove any existing notification
            const existingNotification = document.querySelector('.custom-notification');
            if (existingNotification) {
                existingNotification.remove();
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'custom-notification';
            
            // Use inline styles to ensure it works
            const bgColor = type === 'success' ? '#10b981' : 
                           type === 'removed' ? '#ef4444' : '#3b82f6';
            
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                background: linear-gradient(135deg, ${bgColor}, ${bgColor}dd);
                color: white;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                display: flex;
                align-items: center;
                gap: 12px;
                min-width: 320px;
                transform: translateX(100%);
                transition: all 0.3s ease-in-out;
                font-family: system-ui, -apple-system, sans-serif;
                font-weight: 600;
                font-size: 14px;
            `;
            
            notification.innerHTML = `
                <span style="font-size: 24px;">${icon}</span>
                <span>${message}</span>
            `;
            
            document.body.appendChild(notification);
            console.log('Notification added to DOM');
            
            // Slide in animation
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
                console.log('Slide in animation triggered');
            }, 100);
            
            // Auto remove after 3 seconds with slide out animation
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                        console.log('Notification removed');
                    }
                }, 300);
            }, 3000);
        }

        function addToWishlist(productId) {
            console.log('addToWishlist called with productId:', productId);
            let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            
            // Check if product already in wishlist
            const existingIndex = wishlist.findIndex(item => item.id == productId);
            if (existingIndex > -1) {
                wishlist.splice(existingIndex, 1);
                console.log('Removing from wishlist');
                showNotification('Produit retiré des favoris!', 'removed', '💔');
            } else {
                wishlist.push({
                    id: productId,
                    added_at: new Date().toISOString()
                });
                console.log('Adding to wishlist');
                showNotification('Produit ajouté aux favoris!', 'success', '❤️');
            }
            
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
        }

        function updateCartCount(count = null) {
            if (count === null) {
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                count = cart.reduce((sum, item) => sum + item.quantity, 0);
            }
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

        function updateWishlistCount(count = null) {
            if (count === null) {
                const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
                count = wishlist.length;
            }
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
        
        // Test function for debugging
        function testNotification() {
            showNotification('Test notification!', 'success', '🧪');
        }
        
        // Image navigation functions
        
        function prevImage(productId) {
            // Handle previous image for specific product
            console.log('Previous image for product ' + productId);
        }
        
        function nextImage(productId) {
            // Handle next image for specific product
            console.log('Next image for product ' + productId);
        }
        
        // Initialize cart and wishlist counts on page load (only show if there are items)
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            updateWishlistCount();
            
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

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    if (mobileMenu.classList.contains('active')) {
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

        // Cart Modal Functions
        function openCartModal() {
            const modal = document.getElementById('cartModal');
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            loadCartModal();
        }

        function closeCartModal() {
            const modal = document.getElementById('cartModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function loadCartModal() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const emptyCart = document.getElementById('modal-empty-cart');
            const cartItems = document.getElementById('modal-cart-items');
            const cartFooter = document.getElementById('modal-cart-footer');
            const itemsList = document.getElementById('modal-items-list');
            const itemsCount = document.getElementById('modal-items-count');

            if (cart.length === 0) {
                emptyCart.classList.remove('hidden');
                cartItems.classList.add('hidden');
                cartFooter.classList.add('hidden');
                itemsCount.textContent = '0 article(s)';
            } else {
                emptyCart.classList.add('hidden');
                cartItems.classList.remove('hidden');
                cartFooter.classList.remove('hidden');
                
                let totalPrice = 0;
                itemsList.innerHTML = '';

                cart.forEach(item => {
                    const product = @json($products).find(p => p.id == item.id);
                    if (product) {
                        const itemTotal = product.price * item.quantity;
                        totalPrice += itemTotal;

                        const cartItemHTML = `
                            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-4 border border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <!-- Product Image -->
                                    <div class="relative flex-shrink-0">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-50 border border-gray-200">
                                            <img src="${product.image ? '/storage/' + product.image : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=64&h=64&fit=crop'}" 
                                                 alt="${product.name}" 
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=64&h=64&fit=crop'">
                                        </div>
                                        <div class="absolute -top-2 -right-2 bg-gray-900 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">
                                            ${item.quantity}
                                        </div>
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-gray-900 mb-1">${product.name}</h4>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2 py-1 rounded border">${product.price} DH</span>
                                            <span class="text-gray-500 text-xs">× ${item.quantity}</span>
                                        </div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-2">
                                            <button type="button" onclick="updateQuantityModal(${item.id}, ${item.quantity - 1})" 
                                                    class="w-6 h-6 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-900 text-xs font-semibold rounded min-w-[24px] text-center">${item.quantity}</span>
                                            <button type="button" onclick="updateQuantityModal(${item.id}, ${item.quantity + 1})" 
                                                    class="w-6 h-6 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Price and Remove -->
                                    <div class="flex flex-col items-end space-y-2">
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-gray-900">${itemTotal} DH</p>
                                            <p class="text-xs text-gray-500">${product.price} DH each</p>
                                        </div>
                                        <button type="button" onclick="removeFromCartModal(${item.id})" 
                                                class="bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 rounded-lg p-2 transition-colors duration-200 border border-red-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        itemsList.innerHTML += cartItemHTML;
                    }
                });

                // Update counts and totals
                itemsCount.textContent = `${cart.length} article(s)`;
                document.getElementById('modal-subtotal').textContent = totalPrice + ' DH';
                document.getElementById('modal-total').textContent = totalPrice + ' DH';
            }
        }

        function updateQuantityModal(productId, newQuantity) {
            if (newQuantity <= 0) {
                removeFromCartModal(productId);
                return;
            }

            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const item = cart.find(item => item.id == productId);
            if (item) {
                item.quantity = newQuantity;
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCartModal();
                updateCartCount();
            }
        }

        function removeFromCartModal(productId) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const product = @json($products).find(p => p.id == productId);
            cart = cart.filter(item => item.id != productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCartModal();
            updateCartCount();
            showNotification(`${product ? product.name : 'Produit'} retiré du panier!`, 'removed', '🗑️');
        }

        function clearCartModal() {
            if (confirm('Êtes-vous sûr de vouloir vider votre panier?')) {
                localStorage.removeItem('cart');
                loadCartModal();
                updateCartCount();
                showNotification('Panier vidé avec succès!', 'removed', '🧹');
            }
        }

        function processCheckout() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                showNotification('Votre panier est vide!', 'removed', '⚠️');
                return;
            }
            
            showNotification('Redirection vers le paiement...', 'success', '💳');
            setTimeout(() => {
                alert('Fonctionnalité de paiement en cours de développement!');
            }, 1000);
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('cartModal');
            if (e.target === modal) {
                closeCartModal();
            }
        });
    </script>

    <!-- Cart Modal -->
    <div id="cartModal" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.5); z-index: 99999; display: none; justify-content: center; align-items: center;">
        <div style="background: white; border-radius: 16px; width: 90%; max-width: 700px; max-height: 90%; overflow-y: auto; box-shadow: 0 25px 50px rgba(0,0,0,0.25); margin: 20px; font-family: 'Playfair Display', serif;">
            <!-- Modal Header -->
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 24px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="font-size: 28px; font-weight: 700; margin: 0; font-family: 'Playfair Display', serif;">Mon Panier</h2>
                <button type="button" onclick="closeCartModal();" style="background: rgba(255,255,255,0.2); border: none; color: white; font-size: 24px; cursor: pointer; padding: 8px; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: background-color 0.3s;">&times;</button>
            </div>
            
            <!-- Modal Content -->
            <div style="padding: 32px;">
                <div id="modal-empty-cart">
                    <div style="text-align: center; padding: 60px 20px;">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto;">
                            <svg style="width: 40px; height: 40px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 style="margin: 0 0 12px 0; font-size: 24px; color: #1f2937; font-weight: 600; font-family: 'Playfair Display', serif;">Votre panier est vide</h3>
                        <p style="margin: 0 0 32px 0; color: #6b7280; font-size: 16px; line-height: 1.5;">Découvrez nos produits exceptionnels et ajoutez-les à votre panier</p>
                        <button onclick="closeCartModal();" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 14px 32px; border-radius: 12px; cursor: pointer; font-size: 16px; font-weight: 600; transition: transform 0.2s, box-shadow 0.2s; font-family: 'Playfair Display', serif;">Continuer le Shopping</button>
                    </div>
                </div>
                
                <div id="modal-cart-items" style="display: none;">
                    <div id="modal-items-list" style="margin-bottom: 24px;"></div>
                    <div style="border-top: 2px solid #f3f4f6; padding-top: 24px; background: #f8fafc; margin: 0 -32px -32px -32px; padding: 24px 32px 32px 32px; border-radius: 0 0 16px 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                            <span style="font-size: 20px; font-weight: 600; color: #1f2937; font-family: 'Playfair Display', serif;">Total: </span>
                            <span id="modal-total" style="font-size: 24px; font-weight: 700; color: #1f2937; font-family: 'Playfair Display', serif;">0 DH</span>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <button onclick="processCheckout()" style="flex: 1; background: #3b82f6; color: white; border: none; padding: 12px 20px; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 500; transition: background-color 0.3s;">Passer Commande</button>
                            <button onclick="clearCart()" style="background: #ef4444; color: white; border: none; padding: 12px 20px; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 500; transition: background-color 0.3s;">Vider Panier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
