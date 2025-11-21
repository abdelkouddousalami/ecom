<!DOCTYPE html>
<html lang="fr">
<head>
    <?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => $seoMeta['title'],'description' => $seoMeta['description'],'keywords' => $seoMeta['keywords'],'canonical' => $seoMeta['canonical'],'ogTitle' => $seoMeta['title'],'ogDescription' => $seoMeta['description'],'ogImage' => $seoMeta['ogImage']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['title']),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['description']),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['keywords']),'canonical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['canonical']),'ogTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['title']),'ogDescription' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['description']),'ogImage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['ogImage'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84f9df3f620371229981225e7ba608d7)): ?>
<?php $attributes = $__attributesOriginal84f9df3f620371229981225e7ba608d7; ?>
<?php unset($__attributesOriginal84f9df3f620371229981225e7ba608d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84f9df3f620371229981225e7ba608d7)): ?>
<?php $component = $__componentOriginal84f9df3f620371229981225e7ba608d7; ?>
<?php unset($__componentOriginal84f9df3f620371229981225e7ba608d7); ?>
<?php endif; ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logos/faicon.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('images/logos/faicon.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/logos/faicon.png')); ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- Alpine.js for interactive components -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <style>
        /* Wishlist button styles */
        .wishlist-btn, .wishlist-btn-main {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .wishlist-btn.in-wishlist, .wishlist-btn-main.in-wishlist {
            background-color: #fef2f2 !important;
            border-color: #f87171 !important;
            color: #dc2626 !important;
        }
        
        .wishlist-btn.in-wishlist .heart-icon, .wishlist-btn-main.in-wishlist svg {
            color: #dc2626 !important;
            fill: #dc2626 !important;
        }
        
        .wishlist-btn .heart-icon, .wishlist-btn-main svg {
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        /* Heart fill animation for wishlist */
        .wishlist-btn-main.in-wishlist svg,
        .wishlist-btn.in-wishlist svg {
            fill: #dc2626 !important;
            stroke: #dc2626 !important;
        }
        
        /* Wishlist button hover effects */
        .wishlist-btn-main:hover, .wishlist-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
            cursor: pointer;
        }
        
        /* Heart beat animation when added */
        @keyframes heartBeat {
            0% { transform: scale(1); }
            25% { transform: scale(1.2); }
            50% { transform: scale(1); }
            75% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .wishlist-btn.heart-beat svg,
        .wishlist-btn-main.heart-beat svg {
            animation: heartBeat 0.6s ease-in-out;
        }
        
        /* Smooth button click animations */
        .add-to-cart-btn {
            position: relative;
            overflow: hidden;
            transform: translateZ(0);
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .add-to-cart-btn:active {
            transform: scale(0.98);
        }
        
        .add-to-cart-btn.button-clicked {
            transform: scale(0.95);
            background-color: #1d4ed8 !important;
        }
        
        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .add-to-cart-btn.success {
            animation: successPulse 0.3s ease-out;
            background-color: #10b981 !important;
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
                flex-direction: row !important;
                gap: 8px !important;
                flex-wrap: nowrap !important;
            }
            
            .stat-item {
                text-align: center;
                min-width: 0;
                flex: 1;
            }
            
            .stat-item .text-4xl {
                font-size: 1.5rem !important;
                margin-bottom: 0.25rem !important;
            }
            
            .stat-item .text-lg {
                font-size: 0.75rem !important;
                line-height: 1 !important;
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
        
        /* Category Section Enhancements */
        .category-card {
            border: 1px solid #e5e7eb;
        }
        
        .category-card:hover {
            border-color: #d1d5db;
        }
        
        /* Mobile responsive for category cards */
        @media (max-width: 768px) {
            .category-card {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => ['activePage' => 'home']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active-page' => 'home']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $attributes = $__attributesOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__attributesOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $component = $__componentOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__componentOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>

    <!-- Hero Section -->
    <section class="hero-section relative text-white overflow-hidden" style="height: calc(100vh - 4rem);">
        <!-- Background Image with Better Overlay -->
        <div class="hero-background-container">
            <img src="<?php echo e(asset('images/banners/hero.webp')); ?>" alt="Hero Background" class="hero-background-image">
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
        <div class="absolute z-20 hidden md:block" style="position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); z-index: 30;">
            <div class="animate-bounce">
                <button onclick="scrollToNextSection()" class="w-12 h-12 flex items-center justify-center text-white border-2 border-white rounded-full hover:bg-white hover:text-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-110" title="Scroll to next section">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </button>
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
                                margin-top: 10px !important;
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
                        <div class="stats-container mt-8 flex flex-row justify-center items-center gap-4 sm:gap-8 md:gap-12 max-w-4xl mx-auto">
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
                            <a href="<?php echo e(url('/products')); ?>" class="hero-button bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 cursor-pointer text-center" style="font-family: 'Playfair Display', serif;">
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
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">
                    Shop by Category
                </h2>
                <p class="text-gray-600 text-lg max-w-xl mx-auto">Discover our collection of premium jewelry and accessories</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Bracelets Category -->
                <a href="<?php echo e(route('products')); ?>" class="block">
                    <div class="category-card group bg-white border border-gray-200 rounded-lg hover:border-blue-300 transition-all duration-300 cursor-pointer transform hover:scale-105 hover:shadow-xl" data-category="bracelets">
                        <div class="p-6">
                            <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-lg mb-4 group-hover:bg-blue-200 transition-colors duration-300">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300" style="font-family: 'Playfair Display', serif;">
                                Elegant Bracelets
                            </h3>
                            <p class="text-gray-600 mb-4 text-sm">Premium collection of gold, silver, and diamond bracelets</p>
                        
                        <!-- Subcategories -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full mr-2"></span>
                                Gold Bracelets
                            </div>
                            <div class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full mr-2"></span>
                                Silver Bracelets
                            </div>
                            <div class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full mr-2"></span>
                                Diamond Bracelets
                            </div>
                        </div>
                        
                        <div class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
                            Explore Collection
                        </div>
                    </div>
                </div>
                </a>

                <!-- Watches Category -->
                <a href="<?php echo e(route('products')); ?>" class="block">
                    <div class="category-card group bg-white border border-gray-200 rounded-lg hover:border-purple-300 transition-all duration-300 cursor-pointer transform hover:scale-105 hover:shadow-xl" data-category="watches">
                        <div class="p-6">
                            <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-lg mb-4 group-hover:bg-purple-200 transition-colors duration-300">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors duration-300" style="font-family: 'Playfair Display', serif;">
                                Luxury Watches
                            </h3>
                            <p class="text-gray-600 mb-4 text-sm">Exquisite timepieces from classic to modern designs</p>
                        
                        <!-- Subcategories -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-xs text-gray-600 hover:text-purple-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-purple-400 rounded-full mr-2"></span>
                                Luxury Watches
                            </div>
                            <div class="flex items-center text-xs text-gray-600 hover:text-purple-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-purple-400 rounded-full mr-2"></span>
                                Sport Watches
                            </div>
                            <div class="flex items-center text-xs text-gray-600 hover:text-purple-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-purple-400 rounded-full mr-2"></span>
                                Classic Watches
                            </div>
                        </div>
                        
                        <div class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
                            Explore Collection
                        </div>
                    </div>
                </div>
                </a>

                <!-- Gift Packs Category -->
                <a href="<?php echo e(route('products')); ?>" class="block">
                    <div class="category-card group bg-white border border-gray-200 rounded-lg hover:border-emerald-300 transition-all duration-300 cursor-pointer transform hover:scale-105 hover:shadow-xl" data-category="gift-packs">
                        <div class="p-6">
                            <div class="flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-lg mb-4 group-hover:bg-emerald-200 transition-colors duration-300">
                                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors duration-300" style="font-family: 'Playfair Display', serif;">
                                Special Packs
                            </h3>
                            <p class="text-gray-600 mb-4 text-sm">Curated gift sets and jewelry collections for special occasions</p>
                        
                        <!-- Subcategories -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-xs text-gray-600 hover:text-emerald-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-2"></span>
                                Jewelry Sets
                            </div>
                            <div class="flex items-center text-xs text-gray-600 hover:text-emerald-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-2"></span>
                                Gift Packages
                            </div>
                            <div class="flex items-center text-xs text-gray-600 hover:text-emerald-600 cursor-pointer transition-colors duration-200">
                                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-2"></span>
                                Wedding Packs
                            </div>
                        </div>
                        
                        <div class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
                            Explore Collection
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </section>
        

    <!-- Featured Products -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6" style="font-family: 'Playfair Display', serif;">
                    Featured <span class="text-blue-600">Products</span>
                </h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto leading-relaxed">Discover our premium jewelry collection crafted with excellence and designed for elegance</p>
                <div class="w-24 h-1 bg-blue-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card group bg-white rounded-xl border border-gray-200 hover:border-blue-300 transition-all duration-300 overflow-hidden cursor-pointer" onclick="window.location.href='<?php echo e(route('product.show', $product->slug)); ?>'">
                    <!-- Image Carousel -->
                    <div class="relative h-72 overflow-hidden">
                        <?php if($product->images && $product->images->count() > 0): ?>
                            <div class="carousel-container-<?php echo e($index); ?> flex transition-transform duration-300 ease-in-out h-full">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageIndex => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="w-full h-full flex-shrink-0">
                                    <img src="<?php echo e(Storage::url($image->image_path)); ?>" alt="<?php echo e($product->name); ?> - Image <?php echo e($imageIndex + 1); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                            <!-- Navigation Buttons (only show if multiple images) -->
                            <?php if($product->images->count() > 1): ?>
                                <button onclick="event.stopPropagation(); previousImage(<?php echo e($index); ?>)" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center transition-all duration-300 cursor-pointer">
                                    <span class="text-gray-700 font-bold">‹</span>
                                </button>
                                <button onclick="event.stopPropagation(); nextImage(<?php echo e($index); ?>)" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center transition-all duration-300 cursor-pointer">
                                    <span class="text-gray-700 font-bold">›</span>
                                </button>
                                
                                <!-- Image Indicators -->
                                <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-2">
                                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageIndex => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button onclick="event.stopPropagation(); goToImage(<?php echo e($index); ?>, <?php echo e($imageIndex); ?>)" class="indicator-<?php echo e($index); ?>-<?php echo e($imageIndex); ?> w-2 h-2 rounded-full bg-white/60 hover:bg-white transition-all duration-300 cursor-pointer <?php echo e($imageIndex == 0 ? 'bg-white' : ''); ?>"></button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- Fallback for products without images -->
                            <div class="w-full h-full">
                                <img src="<?php echo e($product->image ? Storage::url($product->image) : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+CiAgPHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzljYTNhZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'); ?>" 
                                     alt="<?php echo e($product->name); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgdmlld0JveD0iMCAwIDQwMCA0MDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iNDAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNzUgMTc1SDE1MEMxNDQuNDc3IDE3NSAxNDAgMTcwLjUyMyAxNDAgMTY1VjE0MEMxNDAgMTM0LjQ3NyAxNDQuNDc3IDEzMCAxNTAgMTMwSDE3NUMxODAuNTIzIDEzMCAxODUgMTM0LjQ3NyAxODUgMTQwVjE2NUMxODUgMTcwLjUyMyAxODAuNTIzIDE3NSAxNzUgMTc1WiIgZmlsbD0iIzlDQTNBRiIvPgo8cGF0aCBkPSJNMjUwIDI3MEgyMDBDMTg0LjUzNiAyNzAgMTcyIDI1Ny40NjQgMTcyIDI0MlYxOTJDMTcyIDE3Ni41MzYgMTg0LjUzNiAxNjQgMjAwIDE2NEgyNTBDMjY1LjQ2NCAxNjQgMjc4IDE3Ni41MzYgMjc4IDE5MlYyNDJDMjc4IDI1Ny40NjQgMjY1LjQ2NCAyNzAgMjUwIDI3MFoiIGZpbGw9IiNEMUQ1REIiLz4KPHRleHQgeD0iMjAwIiB5PSIzMjAiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzZCNzI4MCIgdGV4dC1hbmNob3I9Im1pZGRsZSI+Tm8gSW1hZ2U8L3RleHQ+Cjwvc3ZnPgo='">
                            </div>
                        <?php endif; ?>
                        

                        
                        <!-- Stock Badge -->
                        <?php if($product->stock <= 5 && $product->stock > 0): ?>
                            <div class="absolute top-3 left-3">
                                <span class="bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    Only <?php echo e($product->stock); ?> left!
                                </span>
                            </div>
                        <?php elseif($product->stock == 0): ?>
                            <div class="absolute top-3 left-3">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    Out of Stock
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors duration-300 flex-1 leading-tight" style="font-family: 'Playfair Display', serif;">
                                <?php echo e($product->name); ?>

                            </h3>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed"><?php echo e(Str::limit($product->description, 70)); ?></p>
                        
                        <!-- Rating & Reviews -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <?php if($product->rating): ?>
                                    <div class="flex items-center">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <span class="w-4 h-4 <?php echo e($i <= floor($product->rating) ? 'text-yellow-400' : 'text-gray-300'); ?>">★</span>
                                        <?php endfor; ?>
                                        <span class="text-gray-600 text-sm ml-2">(<?php echo e($product->rating); ?>)</span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-500 text-sm">No reviews yet</span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Current Viewers -->
                            <div class="flex items-center text-xs text-green-600">
                                <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse mr-1"></div>
                                <span><?php echo e(rand(3, 15)); ?> viewing</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center flex-wrap">
                                <span class="text-2xl font-bold text-blue-600" style="font-family: 'Playfair Display', serif;"><?php echo e(number_format($product->price)); ?> DH</span>
                                <?php if($product->original_price && $product->original_price > $product->price): ?>
                                    <span class="text-gray-500 line-through ml-2 text-sm"><?php echo e(number_format($product->original_price)); ?> DH</span>
                                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full ml-2">
                                        -<?php echo e(round(100 - ($product->price / $product->original_price) * 100)); ?>%
                                    </span>
                                <?php else: ?>
                                    <!-- For testing purposes, show a sample discount if no original_price is set -->
                                    <?php
                                        $sampleOriginalPrice = $product->price * 1.3; // 30% discount for demo
                                    ?>
                                    <span class="text-gray-500 line-through ml-2 text-sm"><?php echo e(number_format($sampleOriginalPrice)); ?> DH</span>
                                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full ml-2">
                                        -30%
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            <div class="flex gap-3">
                                <?php if($product->stock > 0): ?>
                                    <button onclick="event.stopPropagation(); this.classList.add('button-clicked'); addToCart(<?php echo e($product->id); ?>); setTimeout(() => this.classList.remove('button-clicked'), 200);" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 cursor-pointer add-to-cart-btn" style="font-family: 'Playfair Display', serif;">
                                        <span class="button-text">Add to Cart</span>
                                        <span class="button-loading hidden">Adding...</span>
                                    </button>
                                <?php else: ?>
                                    <button class="flex-1 bg-gray-400 text-white font-semibold py-3 px-4 rounded-lg cursor-not-allowed" style="font-family: 'Playfair Display', serif;" disabled>
                                        Out of Stock
                                    </button>
                                <?php endif; ?>
                                
                                <!-- Wishlist Button - Always visible -->
                                <button onclick="event.stopPropagation(); addToWishlist(<?php echo e($product->id); ?>)" class="wishlist-btn-main bg-white border-2 border-gray-300 hover:border-red-400 text-gray-600 hover:text-red-500 font-medium py-3 px-4 rounded-lg transition-all duration-300 group cursor-pointer" data-product-id="<?php echo e($product->id); ?>" title="Add to Favorites" style="font-family: 'Playfair Display', serif;">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <!-- View All Products Button -->
            <div class="text-center mt-12">
                <a href="<?php echo e(url('/products')); ?>" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300" style="font-family: 'Playfair Display', serif;">
                    View All Products →
                </a>
            </div>
        </div>
    </section>

    <!-- Special Offers -->
    <section class="py-6 bg-red-50">
    <div class="mx-auto px-2 sm:px-4 lg:px-6" style="width:80% !important;">
            <!-- Section Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2" style="font-family: 'Playfair Display', serif;">
                    Special Offers
                </h2>
                <p class="text-gray-600 text-base max-w-lg mx-auto">
                    Don't miss out on our limited-time deals! Save up to 50% on selected premium jewelry pieces.
                </p>
                <div class="w-16 h-1 bg-red-500 mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="grid lg:grid-cols-2 gap-6 items-center">
                <!-- Left Column - Main Offer Content -->
                <div class="space-y-4">
                    <!-- Offer Features -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900" style="font-family: 'Playfair Display', serif;">Free Shipping</h4>
                                <p class="text-gray-600 text-sm">On all orders</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900" style="font-family: 'Playfair Display', serif;">Best Price Guarantee</h4>
                                <p class="text-gray-600 text-sm">We match any competitor's price</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900" style="font-family: 'Playfair Display', serif;">Quality Certified</h4>
                                <p class="text-gray-600 text-sm">Premium materials & craftsmanship</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-2">
                        <button class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-semibold transition-colors duration-300 cursor-pointer text-sm" style="font-family: 'Playfair Display', serif;">
                            Shop Deals Now
                        </button>
                        <button class="flex-1 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white px-4 py-2 rounded-md font-semibold transition-colors duration-300 cursor-pointer text-sm" style="font-family: 'Playfair Display', serif;">
                            Contact Us
                        </button>
                    </div>
                </div>

                <!-- Right Column - Featured Product -->
                <div class="relative">
                    <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                        <div class="absolute -top-2 -right-2 bg-red-600 text-white px-2 py-0.5 rounded-full text-xs font-bold">
                            HOT DEAL
                        </div>
                        <h3 class="text-lg font-bold mb-3 text-center text-gray-900" style="font-family: 'Playfair Display', serif;">
                            Today's Best Deal
                        </h3>
                        <?php $firstProduct = $products->first(); ?>
                        <div class="text-center space-y-3">
                            <!-- Product Image -->
                            <div class="w-20 h-20 mx-auto mb-3 bg-gray-100 rounded-lg overflow-hidden">
                                <?php if($firstProduct && $firstProduct->images && $firstProduct->images->count() > 0): ?>
                                    <img src="<?php echo e(Storage::url($firstProduct->images->first()->image_path)); ?>" 
                                         alt="<?php echo e($firstProduct->name); ?>" 
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <img src="<?php echo e($firstProduct && $firstProduct->image ? Storage::url($firstProduct->image) : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+CiAgPHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzljYTNhZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'); ?>" 
                                         alt="<?php echo e($firstProduct ? $firstProduct->name : 'Special Offer'); ?>" 
                                         class="w-full h-full object-cover">
                                <?php endif; ?>
                            </div>
                            <!-- Product Info -->
                            <div>
                                <h4 class="text-base font-bold mb-1 text-gray-900" style="font-family: 'Playfair Display', serif;">
                                    <?php echo e($firstProduct ? $firstProduct->name : 'Premium Gold Bracelet'); ?>

                                </h4>
                                <!-- Price -->
                                <div class="space-y-1">
                                    <div class="flex items-center justify-center gap-2">
                                        <span class="text-xl font-bold text-red-600" style="font-family: 'Playfair Display', serif;">
                                            <?php if($firstProduct): ?>
                                                <?php echo e(number_format($firstProduct->price)); ?> DH
                                            <?php else: ?>
                                                299 DH
                                            <?php endif; ?>
                                        </span>
                                        <span class="bg-red-100 text-red-600 px-1.5 py-0.5 rounded text-xs font-bold">
                                            -50% OFF
                                        </span>
                                    </div>
                                    <?php if($firstProduct && $firstProduct->original_price && $firstProduct->original_price > $firstProduct->price): ?>
                                        <div class="text-sm text-gray-500 line-through">
                                            <?php echo e(number_format($firstProduct->original_price)); ?> DH
                                        </div>
                                    <?php else: ?>
                                        <div class="text-sm text-gray-500 line-through">
                                            <?php if($firstProduct): ?>
                                                <?php echo e(number_format($firstProduct->price * 2)); ?> DH
                                            <?php else: ?>
                                                598 DH
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- Rating -->
                                <div class="flex items-center justify-center mt-2">
                                    <div class="flex text-red-500">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="ml-1 text-gray-600 text-xs">5.0 (127 reviews)</span>
                                </div>
                            </div>
                            <!-- Quick Action -->
                            <?php if($firstProduct): ?>
                                <button onclick="window.location.href='<?php echo e(route('product.show', $firstProduct->slug)); ?>'" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-md transition-colors duration-300 cursor-pointer text-sm" style="font-family: 'Playfair Display', serif;">
                                    View This Deal
                                </button>
                            <?php else: ?>
                                <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-md transition-colors duration-300 cursor-pointer text-sm" style="font-family: 'Playfair Display', serif;">
                                    View This Deal
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>

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
                animateCounter('clients-counter', 5700, 2000);
                animateCounter('satisfaction-counter', 97, 2000);
                animateCounter('products-counter', 2890, 2000);
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
            //('addToCart called with productId:', productId, 'quantity:', quantity);
            
            // Find the button that was clicked for visual feedback
            const button = event?.target?.closest('.add-to-cart-btn');
            if (button) {
                button.classList.add('success');
                setTimeout(() => button.classList.remove('success'), 600);
            }
            
            // Immediate UI feedback - update localStorage first for smooth experience
            const wasAdded = updateLocalStorageCart(productId, quantity);
            
            // Background server request for tracking (non-blocking)
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    product_id: productId,
                    quantity: quantity 
                })
            })
            .then(response => {
                //('Background server response status:', response.status);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    //('Server cart tracking successful');
                } else {
                    console.error('Server cart error:', data.message);
                    // Only show error if it's a critical issue (like stock shortage)
                    if (data.message.includes('stock') || data.message.includes('limit')) {
                        showNotification(data.message, 'error');
                        // Revert localStorage change if there's a stock issue
                        revertLocalStorageCart(productId, quantity);
                    }
                }
            })
            .catch(error => {
                console.error('Background server request failed:', error);
                // Silent background failure - user already got positive feedback
            });
        }

        function updateLocalStorageCart(productId, quantity) {
            // Handle localStorage for immediate frontend feedback
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Check if product already in cart
            const existingItem = cart.find(item => item.id == productId);
            if (existingItem) {
                existingItem.quantity += quantity;
                //('Updating cart quantity');
                showNotification('Quantité mise à jour dans le panier! ✨', 'success');
            } else {
                cart.push({
                    id: productId,
                    quantity: quantity,
                    added_at: new Date().toISOString()
                });
                //('Adding new product to cart');
                showNotification('Produit ajouté au panier! 🛒', 'success');
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            return true;
        }

        function revertLocalStorageCart(productId, quantity) {
            // Revert cart changes if server validation fails
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const existingItem = cart.find(item => item.id == productId);
            
            if (existingItem) {
                existingItem.quantity -= quantity;
                if (existingItem.quantity <= 0) {
                    cart = cart.filter(item => item.id != productId);
                }
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }
        
        function addToWishlist(productId) {
            // First, make server request for tracking
            fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    //('Server tracking successful:', data.message);
                }
            })
            .catch(error => {
                console.error('Server tracking error:', error);
            });

            // Then handle localStorage for frontend functionality
            let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            const wishlistBtns = document.querySelectorAll(`[data-product-id="${productId}"]`);
            
            // Check if product already in wishlist
            const existingIndex = wishlist.findIndex(item => item.id == productId);
            if (existingIndex > -1) {
                wishlist.splice(existingIndex, 1);
                showNotification('Produit retiré des favoris!', 'removed');
                // Update button appearance - remove from wishlist
                wishlistBtns.forEach(btn => {
                    btn.classList.remove('in-wishlist');
                    btn.style.backgroundColor = '';
                    btn.style.borderColor = '';
                    btn.style.color = '';
                    const svg = btn.querySelector('svg');
                    if (svg) {
                        svg.style.fill = 'none';
                        svg.style.stroke = 'currentColor';
                    }
                });
            } else {
                wishlist.push({
                    id: productId,
                    added_at: new Date().toISOString()
                });
                showNotification('Produit ajouté aux favoris!', 'success');
                // Update button appearance - add to wishlist
                wishlistBtns.forEach(btn => {
                    btn.classList.add('in-wishlist');
                    // Add heart beat animation
                    btn.classList.add('heart-beat');
                    setTimeout(() => btn.classList.remove('heart-beat'), 600);
                    
                    if (btn.classList.contains('wishlist-btn-main')) {
                        // Style for main wishlist button (in action buttons)
                        btn.style.backgroundColor = '#fee2e2';
                        btn.style.borderColor = '#f87171';
                        btn.style.color = '#dc2626';
                        const svg = btn.querySelector('svg');
                        if (svg) {
                            svg.style.fill = '#dc2626';
                            svg.style.stroke = '#dc2626';
                        }
                    } else {
                        // Style for hover wishlist button (in overlay)
                        btn.style.backgroundColor = '#fee2e2';
                        btn.style.color = '#dc2626';
                        const svg = btn.querySelector('svg');
                        if (svg) {
                            svg.style.fill = '#dc2626';
                            svg.style.stroke = '#dc2626';
                        }
                    }
                });
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
            const wishlistBtns = document.querySelectorAll('.wishlist-btn, .wishlist-btn-main');
            wishlistBtns.forEach(btn => {
                const productId = parseInt(btn.getAttribute('data-product-id'));
                const isInWishlist = wishlist.some(item => item.id == productId);
                if (isInWishlist) {
                    btn.classList.add('in-wishlist');
                    if (btn.classList.contains('wishlist-btn-main')) {
                        // Style for main wishlist button (in action buttons)
                        btn.style.backgroundColor = '#fee2e2';
                        btn.style.borderColor = '#f87171';
                        btn.style.color = '#dc2626';
                        const svg = btn.querySelector('svg');
                        if (svg) {
                            svg.style.fill = '#dc2626';
                            svg.style.stroke = '#dc2626';
                        }
                    } else {
                        // Style for hover wishlist button (in overlay)
                        btn.style.backgroundColor = '#fee2e2';
                        btn.style.color = '#dc2626';
                        const svg = btn.querySelector('svg');
                        if (svg) {
                            svg.style.fill = '#dc2626';
                            svg.style.stroke = '#dc2626';
                        }
                    }
                } else {
                    btn.classList.remove('in-wishlist');
                    btn.style.backgroundColor = '';
                    btn.style.borderColor = '';
                    btn.style.color = '';
                    const svg = btn.querySelector('svg');
                    if (svg) {
                        svg.style.fill = 'none';
                        svg.style.stroke = 'currentColor';
                    }
                }
            });
        }
        
        // Category navigation functions
        function navigateToCategory(categorySlug) {
            //('Navigating to category:', categorySlug);
            const baseUrl = '<?php echo e(route("products")); ?>';
            const fullUrl = baseUrl + '?category=' + categorySlug;
            //('Full URL:', fullUrl);
            window.location.href = fullUrl;
        }
        
        // Initialize cart and wishlist counts on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            updateWishlistCount();
            updateWishlistButtons();
        });
    </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\welcome.blade.php ENDPATH**/ ?>