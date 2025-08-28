<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => $seoMeta['title'],'description' => $seoMeta['description'],'keywords' => $seoMeta['keywords'],'canonical' => $seoMeta['canonical'],'ogTitle' => $seoMeta['title'],'ogDescription' => $seoMeta['description'],'ogImage' => $seoMeta['og_image'] ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['title']),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['description']),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['keywords']),'canonical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['canonical']),'ogTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['title']),'ogDescription' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['description']),'ogImage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoMeta['og_image'] ?? null)]); ?>
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
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        /* Mobile hero section full height */
        @media (max-width: 768px) {
            .hero-section {
                height: calc(100vh - 4rem) !important;
                min-height: calc(100vh - 4rem) !important;
            }
        }
        
        /* Advanced Filter Animations */
        @keyframes slideInFromTop {
            0% {
                transform: translateY(-30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes slideInFromBottom {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeInScale {
            0% {
                transform: scale(0.9);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        @keyframes bounceIn {
            0% {
                transform: scale(0.3) translateY(-50px);
                opacity: 0;
            }
            50% {
                transform: scale(1.05) translateY(-10px);
                opacity: 0.8;
            }
            100% {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
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
        
        /* Filter section custom transitions */
        #filters-section {
            transition: max-height 0.7s cubic-bezier(0.4, 0, 0.2, 1), 
                        opacity 0.5s ease-out;
        }
        
        .filter-animate-title {
            animation: slideInFromTop 0.6s ease-out forwards;
        }
        
        .filter-animate-container {
            animation: fadeInScale 0.7s ease-out forwards;
        }
        
        .filter-animate-active {
            animation: slideInFromBottom 0.5s ease-out forwards;
        }
        
        /* Button hover effects */
        .btn-hover-effect {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
        }
        
        .btn-hover-effect:active {
            transform: translateY(0);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.2);
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
         #heroo {
                    margin-top: -50px !important;
                }
    </style>
</head>
<body class="bg-gray-50 h-full m-0 p-0" style="font-family: 'Playfair Display', serif;">

    <!-- Navigation -->
    <?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => ['activePage' => 'products']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active-page' => 'products']); ?>
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

    <!-- Page Header -->
    <section class="hero-section relative text-white w-full overflow-hidden" style="height: 80vh; background-image: url('<?php echo e(asset('images/banners/prosucts.jpg')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" >
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2" style="background-size: 60px 60px;"></div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full animate-float"></div>
        <div class="absolute top-20 right-20 w-16 h-16 bg-white bg-opacity-10 rounded-full animate-float-delayed"></div>
        <div class="absolute bottom-10 left-1/4 w-12 h-12 bg-white bg-opacity-10 rounded-full animate-float"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center h-full flex flex-col justify-center items-center pt-12 lg:pt-20" id="heroo">
           
            <!-- Main Title -->
            <div class="animate-fade-in-up-delay-2" style="margin-top: -20px;">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 lg:mb-6 leading-tight font-playfair">
                    <span class="block text-white">L3OCHAQ - Meilleurs Cadeaux</span>
                    <span class="block text-gray-200 italic">Pour Couples & Bijoux</span>
                </h1>
            </div>

            <!-- Subtitle -->
            <div class="animate-fade-in-up-delay-3">
                <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-100 mb-6 lg:mb-8 max-w-3xl mx-auto leading-relaxed font-playfair px-4">
                    Découvrez les meilleurs cadeaux pour couples au Maroc. Bijoux, bracelets assortis, montres duo et accessoires romantiques. L3OCHAQ - Votre destination cadeaux
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
                        Voir Nos Cadeaux
                    </button>
                    <button class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-playfair">
                        Cadeaux Couples
                    </button>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-16 left-1/2 transform -translate-x-1/2 animate-bounce z-20" style="left: 50%; bottom: 16px; transform: translateX(-50%);">
            <button onclick="scrollToProducts()" class="w-12 h-12 flex items-center justify-center text-white border-2 border-white rounded-full hover:bg-white hover:text-gray-900 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-110" title="Scroll to products">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </button>
        </div>
    </section>

    <!-- Search/Filter Toggle Button -->
    <section class="py-8 bg-white" style="font-family: 'Playfair Display', serif;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center">
                <button id="toggle-filters-btn" onclick="toggleFilters()" class="group btn-hover-effect bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 sm:px-8 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95 w-full sm:w-auto">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                        </svg>
                        <span class="transition-all duration-300">Search & Filter Products</span>
                        <span id="active-filters-badge" class="hidden bg-white text-red-600 px-2 py-1 rounded-full text-xs font-bold ml-2">0</span>
                    </span>
                </button>
            </div>
        </div>
    </section>

    <!-- Quick Mobile Filters Bar -->
    <section id="mobile-quick-filters" class="bg-gray-50 py-3 px-4 border-b border-gray-200 lg:hidden">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center space-x-3 overflow-x-auto scrollbar-hide">
                <span class="text-sm font-medium text-gray-600 whitespace-nowrap">Quick:</span>
                <button onclick="filterByCategory('')" class="quick-filter-btn whitespace-nowrap px-3 py-1 bg-white rounded-full text-sm font-medium text-gray-700 border border-gray-300 hover:border-red-400 hover:text-red-600 transition-all duration-200">
                    All
                </button>
                <?php $__currentLoopData = $categories->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button onclick="filterByCategory('<?php echo e($category->slug); ?>')" class="quick-filter-btn whitespace-nowrap px-3 py-1 bg-white rounded-full text-sm font-medium text-gray-700 border border-gray-300 hover:border-red-400 hover:text-red-600 transition-all duration-200">
                    <?php echo e($category->name); ?>

                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <button onclick="toggleFilters()" class="whitespace-nowrap px-3 py-1 bg-red-600 text-white rounded-full text-sm font-medium hover:bg-red-700 transition-all duration-200">
                    More Filters
                </button>
            </div>
        </div>
    </section>

    <!-- Enhanced Filters Section (Hidden by default) -->
    <section id="filters-section" class="overflow-hidden transition-all duration-700 ease-in-out opacity-0" style="font-family: 'Playfair Display', serif; max-height: 0; padding: 0;">
        <div class="py-8 bg-white transform translate-y-8 transition-transform duration-700 ease-out">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
                <!-- Section Title -->
                <div class="text-center mb-4 lg:mb-6 transform translate-y-4 opacity-0 transition-all duration-500 delay-200" id="filters-title">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2" style="font-family: 'Playfair Display', serif;">
                        Find Your Perfect <span class="text-red-600">Style</span>
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto text-sm sm:text-base">
                        Discover our curated collection with smart filters
                    </p>
                </div>

                <!-- Main Filters Container -->
                <div id="filters-container" class="bg-gray-50 rounded-lg border border-gray-200 p-4 lg:p-6 transform translate-y-6 opacity-0 transition-all duration-600 delay-300 shadow-lg">
                <!-- Top Row - Category Cards -->
                <div class="mb-4 lg:mb-6">
                    <h3 class="text-base lg:text-lg font-semibold text-gray-800 mb-3 lg:mb-4">Categories</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2 lg:gap-3">
                        <!-- All Categories -->
                        <button onclick="filterByCategory('')" class="category-filter-btn active bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 lg:px-4 rounded-lg transition-all duration-300 border-2 border-transparent" data-category="">
                            <span class="text-xs sm:text-sm font-semibold">All Items</span>
                        </button>
                        
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button onclick="filterByCategory('<?php echo e($category->slug); ?>')" class="category-filter-btn bg-white hover:bg-gray-100 text-gray-700 hover:text-red-600 font-medium py-2 px-3 lg:px-4 rounded-lg transition-all duration-300 border-2 border-gray-200 hover:border-red-300" data-category="<?php echo e($category->slug); ?>">
                            <span class="text-xs sm:text-sm font-semibold"><?php echo e($category->name); ?></span>
                        </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-300 my-3 lg:my-4"></div>

                <!-- Bottom Row - Advanced Filters -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
                    <!-- Sort By -->
                    <div class="space-y-2">
                        <label class="text-xs sm:text-sm font-semibold text-gray-700">Sort By</label>
                        <select id="sort-filter" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 text-gray-700 text-sm">
                            <option value="newest">Newest First</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="rating">Highest Rated</option>
                            <option value="popular">Most Popular</option>
                            <option value="name">Name: A-Z</option>
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Price Range</label>
                        <select id="price-filter" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 text-gray-700">
                            <option value="">All Prices</option>
                            <option value="0-100">Under 100 DH</option>
                            <option value="100-300">100 - 300 DH</option>
                            <option value="300-500">300 - 500 DH</option>
                            <option value="500-1000">500 - 1000 DH</option>
                            <option value="1000+">Over 1000 DH</option>
                        </select>
                    </div>

                    <!-- Availability -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Availability</label>
                        <select id="stock-filter" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 text-gray-700">
                            <option value="">All Items</option>
                            <option value="in-stock">In Stock</option>
                            <option value="low-stock">Low Stock</option>
                            <option value="out-of-stock">Out of Stock</option>
                        </select>
                    </div>

                    <!-- Search Box -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Search Products</label>
                        <div class="relative">
                            <input type="text" id="search-filter" placeholder="Search by name, description..." class="w-full px-3 py-2 pl-10 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 text-gray-700">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 mt-6 pt-4 border-t border-gray-300">
                    <button onclick="clearAllFilters()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 hover:text-gray-900 font-semibold py-2 px-6 rounded-lg transition-all duration-300 border border-gray-300 transform hover:scale-105 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        <span class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Reset All
                        </span>
                    </button>
                    <div class="flex-1 text-center py-2 px-6">
                        <span class="text-sm text-gray-600">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Filters apply automatically
                        </span>
                    </div>
                </div>

                <!-- Active Filters Display -->
                <div id="active-filters" class="hidden mt-4 pt-4 border-t border-gray-300 transform translate-y-4 opacity-0 transition-all duration-500 delay-500">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-semibold text-gray-700">Active Filters:</h4>
                        <span id="results-count" class="text-sm text-gray-500 bg-gray-200 px-2 py-1 rounded">0 products found</span>
                    </div>
                    <div id="filter-tags" class="flex flex-wrap gap-2"></div>
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section id="products-section" class="py-12 lg:py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card group bg-white rounded-xl border border-gray-200 hover:border-blue-300 transition-all duration-300 overflow-hidden cursor-pointer" 
                     onclick="window.location.href='<?php echo e(route('product.show', $product->slug)); ?>'"
                     data-category="<?php echo e($product->category ? $product->category->slug : ''); ?>"
                     data-price="<?php echo e($product->price); ?>"
                     data-stock="<?php echo e($product->stock); ?>"
                     data-name="<?php echo e(strtolower($product->name)); ?>"
                     data-rating="<?php echo e($product->rating ?? 0); ?>">
                    <!-- Image Carousel -->
                    <div class="relative h-48 sm:h-56 lg:h-72 overflow-hidden">
                        <?php if($product->images && $product->images->count() > 0): ?>
                            <div class="carousel-container-<?php echo e($index); ?> flex transition-transform duration-300 ease-in-out h-full">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageIndex => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="w-full h-full flex-shrink-0">
                                    <img src="<?php echo e(\Illuminate\Support\Facades\Storage::url($image->image_path)); ?>" alt="<?php echo e($product->name); ?> - Image <?php echo e($imageIndex + 1); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                            <!-- Navigation Buttons (only show if multiple images) -->
                            <?php if($product->images->count() > 1): ?>
                                <button onclick="event.stopPropagation(); previousImage(<?php echo e($index); ?>)" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center transition-all duration-300 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button onclick="event.stopPropagation(); nextImage(<?php echo e($index); ?>)" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center transition-all duration-300 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
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
                                <img src="<?php echo e($product->image ? \Illuminate\Support\Facades\Storage::url($product->image) : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+CiAgPHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzljYTNhZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'); ?>" 
                                     alt="<?php echo e($product->name); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgdmlld0JveD0iMCAwIDQwMCA0MDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iNDAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNzUgMTc1SDE1MEMxNDQuNDc3IDE3NSAxNDAgMTcwLjUyMyAxNDAgMTY1VjE0MEMxNDAgMTM0LjQ3NyAxNDQuNDc3IDEzMCAxNTAgMTMwSDE3NUMxODAuNTIzIDEzMCAxODUgMTM0LjQ3NyAxODUgMTQwVjE2NUMxODUgMTcwLjUyMyAxODAuNTIzIDE3NSAxNzUgMTc1WiIgZmlsbD0iIzlDQTNBRiIvPgo8cGF0aCBkPSJNMjUwIDI3MEgyMDBDMTg0LjUzNiAyNzAgMTcyIDI1Ny40NjQgMTcyIDI0MlYxOTJDMTcyIDE3Ni41MzYgMTg0LjUzNiAxNjQgMjAwIDE2NEgyNTBDMjY1LjQ2NCAxNjQgMjc4IDE3Ni41MzYgMjc4IDE5MlYyNDJDMjc4IDI1Ny40NjQgMjY1LjQ2NCAyNzAgMjUwIDI7MFoiIGZpbGw9IiNEMUQ1REIiLz4KPHRleHQgeD0iMjAwIiB5PSIzMjAiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzZCNzI4MCIgdGV4dC1hbmNob3I9Im1pZGRsZSI+Tm8gSW1hZ2U8L3RleHQ+Cjwvc3ZnPgo='">
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
                    <div class="p-3 sm:p-4 lg:p-6">
                        <div class="flex items-start justify-between mb-2 lg:mb-3">
                            <h3 class="font-bold text-sm sm:text-base lg:text-lg text-gray-900 group-hover:text-blue-600 transition-colors duration-300 flex-1 leading-tight" style="font-family: 'Playfair Display', serif;">
                                <?php echo e($product->name); ?>

                            </h3>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-xs sm:text-sm mb-2 lg:mb-4 leading-relaxed"><?php echo e(Str::limit($product->description, 70)); ?></p>
                        
                        <!-- Rating & Reviews -->
                        <div class="flex items-center justify-between mb-3 lg:mb-4">
                            <div class="flex items-center">
                                <?php if($product->rating): ?>
                                    <div class="flex items-center">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 <?php echo e($i <= floor($product->rating) ? 'text-yellow-400' : 'text-gray-300'); ?>" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        <?php endfor; ?>
                                        <span class="text-gray-600 text-xs sm:text-sm ml-1 sm:ml-2">(<?php echo e($product->rating); ?>)</span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-500 text-xs sm:text-sm">No reviews yet</span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Current Viewers -->
                            <div class="flex items-center text-xs text-green-600">
                                <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse mr-1"></div>
                                <span><?php echo e(rand(3, 15)); ?> viewing</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                            <div class="flex items-center flex-wrap">
                                <span class="text-lg sm:text-xl lg:text-2xl font-bold text-blue-600" style="font-family: 'Playfair Display', serif;"><?php echo e(number_format($product->price)); ?> DH</span>
                                <?php if($product->original_price && $product->original_price > $product->price): ?>
                                    <span class="text-gray-500 line-through ml-1 sm:ml-2 text-xs sm:text-sm"><?php echo e(number_format($product->original_price)); ?> DH</span>
                                    <span class="bg-red-100 text-red-600 text-xs font-bold px-1 sm:px-2 py-1 rounded-full ml-1 sm:ml-2">
                                        -<?php echo e(round(100 - ($product->price / $product->original_price) * 100)); ?>%
                                    </span>
                                <?php else: ?>
                                    <!-- For testing purposes, show a sample discount if no original_price is set -->
                                    <?php
                                        $sampleOriginalPrice = $product->price * 1.3; // 30% discount for demo
                                    ?>
                                    <span class="text-gray-500 line-through ml-1 sm:ml-2 text-xs sm:text-sm"><?php echo e(number_format($sampleOriginalPrice)); ?> DH</span>
                                    <span class="bg-red-100 text-red-600 text-xs font-bold px-1 sm:px-2 py-1 rounded-full ml-1 sm:ml-2">
                                        -30%
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2 lg:space-y-3">
                            <div class="flex gap-2 lg:gap-3">
                                <?php if($product->stock > 0): ?>
                                    <button onclick="event.stopPropagation(); this.classList.add('button-clicked'); addToCart(<?php echo e($product->id); ?>); setTimeout(() => this.classList.remove('button-clicked'), 200);" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 lg:py-3 px-3 lg:px-4 rounded-lg transition-all duration-200 cursor-pointer add-to-cart-btn text-xs sm:text-sm lg:text-base" style="font-family: 'Playfair Display', serif;">
                                        <span class="button-text">Add to Cart</span>
                                    </button>
                                <?php else: ?>
                                    <button class="flex-1 bg-gray-400 text-white font-semibold py-2 lg:py-3 px-3 lg:px-4 rounded-lg cursor-not-allowed text-xs sm:text-sm lg:text-base" style="font-family: 'Playfair Display', serif;" disabled>
                                        Out of Stock
                                    </button>
                                <?php endif; ?>
                                
                                <!-- Wishlist Button - Always visible -->
                                <button onclick="event.stopPropagation(); addToWishlist(<?php echo e($product->id); ?>)" class="wishlist-btn-main bg-white border-2 border-gray-300 hover:border-red-400 text-gray-600 hover:text-red-500 font-medium py-2 lg:py-3 px-3 lg:px-4 rounded-lg transition-all duration-300 group cursor-pointer" data-product-id="<?php echo e($product->id); ?>" title="Add to Favorites" style="font-family: 'Playfair Display', serif;">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="mt-8 lg:mt-16 flex justify-center">
                <?php if($products->hasPages()): ?>
                    <nav class="flex items-center space-x-1 sm:space-x-2">
                        
                        <?php if($products->onFirstPage()): ?>
                            <span class="px-2 sm:px-4 py-2 text-gray-400 rounded-lg cursor-not-allowed text-xs sm:text-sm">Previous</span>
                        <?php else: ?>
                            <a href="<?php echo e($products->previousPageUrl()); ?>" class="px-2 sm:px-4 py-2 text-gray-600 hover:text-gray-900 transition-all duration-300 rounded-lg hover:bg-gray-100 font-medium text-xs sm:text-sm">Previous</a>
                        <?php endif; ?>

                        
                        <?php $__currentLoopData = $products->getUrlRange(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $products->currentPage()): ?>
                                <span class="px-2 sm:px-4 py-2 bg-red-600 text-white rounded-lg shadow-lg font-semibold text-xs sm:text-sm"><?php echo e($page); ?></span>
                            <?php else: ?>
                                <a href="<?php echo e($url); ?>" class="px-2 sm:px-4 py-2 text-gray-700 hover:text-gray-900 transition-all duration-300 rounded-lg hover:bg-gray-100 font-medium text-xs sm:text-sm"><?php echo e($page); ?></a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php if($products->hasMorePages()): ?>
                            <a href="<?php echo e($products->nextPageUrl()); ?>" class="px-2 sm:px-4 py-2 text-gray-600 hover:text-gray-900 transition-all duration-300 rounded-lg hover:bg-gray-100 font-medium text-xs sm:text-sm">Next</a>
                        <?php else: ?>
                            <span class="px-2 sm:px-4 py-2 text-gray-400 rounded-lg cursor-not-allowed text-xs sm:text-sm">Next</span>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>
                
                
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
        
        /* Filter Enhancement Styles */
        .filter-animate-in {
            animation: filterSlideIn 0.6s ease-out forwards;
        }
        
        @keyframes filterSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Active filter tag animations */
        .filter-tag-enter {
            animation: tagSlideIn 0.4s ease-out forwards;
        }
        
        @keyframes tagSlideIn {
            0% {
                opacity: 0;
                transform: translateX(-20px) scale(0.8);
            }
            100% {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }
        
        /* Enhanced Search Input */
        #search-filter:focus + div svg {
            color: #dc2626 !important;
        }
        
        /* Category button hover effects */
        .category-filter-btn {
            position: relative;
            overflow: hidden;
        }
        
        .category-filter-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .category-filter-btn:hover::before {
            left: 100%;
        }
        
        /* Filter dropdown custom styling */
        select option {
            padding: 8px 12px;
        }
        
        select:focus option:checked {
            background: #dc2626;
            color: white;
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
            
            .filter-tag-enter {
                animation-duration: 0.2s;
            }
            
            /* Mobile-specific filter improvements */
            #filters-container {
                padding: 1rem !important;
            }
            
            .category-filter-btn {
                font-size: 0.75rem !important;
                padding: 0.5rem 0.75rem !important;
            }
            
            /* Mobile filter dropdown styling */
            select, input {
                font-size: 0.875rem !important;
                padding: 0.625rem 0.75rem !important;
            }
            
            /* Better mobile category grid */
            .grid.grid-cols-2.sm\\:grid-cols-3.md\\:grid-cols-4.lg\\:grid-cols-6 {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.5rem !important;
            }
        }
        
        @media (max-width: 640px) {
            /* Extra small devices */
            .grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-4 {
                grid-template-columns: 1fr !important;
                gap: 0.75rem !important;
            }
            
            /* Stack filter buttons vertically on very small screens */
            .category-filter-btn span {
                font-size: 0.7rem !important;
            }
            
            /* Improve search input on mobile */
            #search-filter {
                padding-left: 2.5rem !important;
            }
        }
        
        /* Filter responsiveness animations */
        .filter-responsive-animation {
            transition: all 0.3s ease-in-out;
        }
        
        /* Loading state for filters */
        .filter-loading {
            opacity: 0.7;
            pointer-events: none;
            position: relative;
        }
        
        .filter-loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #dc2626;
            border-radius: 50%;
            border-top: 2px solid transparent;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Scrollbar hiding for mobile quick filters */
        .scrollbar-hide {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        
        .scrollbar-hide::-webkit-scrollbar {
            display: none;  /* Chrome, Safari and Opera */
        }
        
        /* Quick filter button active state */
        .quick-filter-btn.active {
            background-color: #dc2626 !important;
            color: white !important;
            border-color: #dc2626 !important;
        }
        
        /* Mobile search input improvements */
        @media (max-width: 640px) {
            #search-filter::placeholder {
                font-size: 0.8rem;
            }
        }
    </style>

    <script>
        // Toggle filters section functionality with advanced animations
        function toggleFilters() {
            const filtersSection = document.getElementById('filters-section');
            const toggleBtn = document.getElementById('toggle-filters-btn');
            const filtersTitle = document.getElementById('filters-title');
            const filtersContainer = document.getElementById('filters-container');
            const activeFilters = document.getElementById('active-filters');
            
            if (filtersSection.style.maxHeight === '' || filtersSection.style.maxHeight === '0px') {
                // Show filters with advanced height animation
                filtersSection.style.padding = ''; // Remove padding override
                const scrollHeight = filtersSection.scrollHeight;
                filtersSection.style.maxHeight = scrollHeight + 'px';
                filtersSection.classList.remove('opacity-0');
                filtersSection.classList.add('opacity-100');
                
                // Animate the main container
                setTimeout(() => {
                    filtersSection.querySelector('.py-8').classList.remove('translate-y-8');
                    filtersSection.querySelector('.py-8').classList.add('translate-y-0');
                }, 100);
                
                // Animate title with staggered effect
                setTimeout(() => {
                    filtersTitle.classList.remove('translate-y-4', 'opacity-0');
                    filtersTitle.classList.add('translate-y-0', 'opacity-100');
                }, 300);
                
                // Animate filters container
                setTimeout(() => {
                    filtersContainer.classList.remove('translate-y-6', 'opacity-0');
                    filtersContainer.classList.add('translate-y-0', 'opacity-100');
                }, 500);
                
                // Animate active filters if visible
                if (!activeFilters.classList.contains('hidden')) {
                    setTimeout(() => {
                        activeFilters.classList.remove('translate-y-4', 'opacity-0');
                        activeFilters.classList.add('translate-y-0', 'opacity-100');
                    }, 700);
                }
                
                // Update button with animation
                toggleBtn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    toggleBtn.style.transform = 'scale(1)';
                    toggleBtn.innerHTML = `
                        <span class="flex items-center space-x-2">
                            <svg class="w-5 h-5 transform rotate-45 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Hide Filters</span>
                        </span>
                    `;
                }, 100);
                
            } else {
                // Hide filters with reverse animation
                // Reset all animated elements
                filtersTitle.classList.remove('translate-y-0', 'opacity-100');
                filtersTitle.classList.add('translate-y-4', 'opacity-0');
                
                filtersContainer.classList.remove('translate-y-0', 'opacity-100');
                filtersContainer.classList.add('translate-y-6', 'opacity-0');
                
                activeFilters.classList.remove('translate-y-0', 'opacity-100');
                activeFilters.classList.add('translate-y-4', 'opacity-0');
                
                setTimeout(() => {
                    filtersSection.querySelector('.py-8').classList.remove('translate-y-0');
                    filtersSection.querySelector('.py-8').classList.add('translate-y-8');
                }, 200);
                
                setTimeout(() => {
                    filtersSection.classList.remove('opacity-100');
                    filtersSection.classList.add('opacity-0');
                    filtersSection.style.maxHeight = '0px';
                    filtersSection.style.padding = '0'; // Remove padding completely when hidden
                }, 400);
                
                // Update button with animation
                toggleBtn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    toggleBtn.style.transform = 'scale(1)';
                    toggleBtn.innerHTML = `
                        <span class="flex items-center space-x-2">
                            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Search & Filter Products</span>
                        </span>
                    `;
                }, 100);
            }
        }

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
                        indicator.classList.remove('bg-white/60');
                        indicator.classList.add('bg-white');
                    } else {
                        indicator.classList.remove('bg-white');
                        indicator.classList.add('bg-white/60');
                    }
                }
            }
        }

        // Stylish notification function
        function showNotification(message, type = 'success') {
            //('showNotification called:', message, type);
            
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
                font-family: 'Playfair Display', serif;
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
            //('addToWishlist called with productId:', productId);
            
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
            
            // Check if product already in wishlist
            const existingIndex = wishlist.findIndex(item => item.id == productId);
            if (existingIndex > -1) {
                wishlist.splice(existingIndex, 1);
                //('Removing from wishlist');
                showNotification('Produit retiré des favoris!', 'removed');
            } else {
                wishlist.push({
                    id: productId,
                    added_at: new Date().toISOString()
                });
                //('Adding to wishlist');
                showNotification('Produit ajouté aux favoris!', 'success');
            }
            
            // Update wishlist button styles
            const wishlistBtns = document.querySelectorAll('.wishlist-btn, .wishlist-btn-main');
            wishlistBtns.forEach(btn => {
                const btnProductId = parseInt(btn.getAttribute('data-product-id'));
                if (btnProductId === productId) {
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
                }
            });
            
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
        
        // Initialize cart and wishlist counts on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            updateWishlistCount();
            updateWishlistButtons();
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
                    const product = <?php echo json_encode($allProducts, 15, 512) ?>.find(p => p.id == item.id);
                    if (product) {
                        const itemTotal = product.price * item.quantity;
                        totalPrice += itemTotal;

                        const cartItemHTML = `
                            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-4 border border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <!-- Product Image -->
                                    <div class="relative flex-shrink-0">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-50 border border-gray-200">
                                            <img src="${product.image ? '/' + product.image : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=64&h=64&fit=crop'}" 
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
            const product = <?php echo json_encode($allProducts, 15, 512) ?>.find(p => p.id == productId);
            cart = cart.filter(item => item.id != productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCartModal();
            updateCartCount();
            showNotification(`${product ? product.name : 'Produit'} retiré du panier!`, 'removed');
        }

        function clearCartModal() {
            if (confirm('Êtes-vous sûr de vouloir vider votre panier?')) {
                localStorage.removeItem('cart');
                loadCartModal();
                updateCartCount();
                showNotification('Panier vidé avec succès!', 'removed');
            }
        }

        function processCheckout() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                showNotification('Votre panier est vide!', 'removed');
                return;
            }
            
            showNotification('Redirection vers le paiement...', 'success');
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

        // Enhanced Filter Functionality
        let currentFilters = {
            category: '',
            sort: 'newest',
            price: '',
            stock: '',
            search: ''
        };

        let allProducts = []; // Store all products for filtering
        let originalProductsOrder = []; // Store original order

        function initializeFilters() {
            // Store all products in their original order
            const productCards = document.querySelectorAll('.product-card');
            allProducts = Array.from(productCards);
            originalProductsOrder = Array.from(productCards);
            
            // Update initial counts
            updateActiveFiltersDisplay(allProducts.length);
        }

        function filterByCategory(categorySlug) {
            // Add visual feedback to the clicked button
            const clickedBtn = event.target.closest('.category-filter-btn, .quick-filter-btn');
            if (clickedBtn) {
                clickedBtn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    clickedBtn.style.transform = 'scale(1)';
                }, 150);
            }
            
            currentFilters.category = categorySlug;
            updateCategoryButtons(categorySlug);
            updateQuickFilterButtons(categorySlug);
            
            // Apply filters with visual feedback
            applyFiltersWithFeedback();
        }
        
        function updateQuickFilterButtons(activeCategory) {
            document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                const btnOnclick = btn.getAttribute('onclick');
                if (btnOnclick && btnOnclick.includes(`'${activeCategory}'`)) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        function updateCategoryButtons(activeCategory) {
            document.querySelectorAll('.category-filter-btn').forEach(btn => {
                const category = btn.getAttribute('data-category');
                if (category === activeCategory) {
                    btn.classList.remove('bg-white', 'hover:bg-gray-100', 'text-gray-700', 'hover:text-red-600', 'border-gray-200', 'hover:border-red-300');
                    btn.classList.add('bg-red-600', 'hover:bg-red-700', 'text-white', 'active');
                } else {
                    btn.classList.remove('bg-red-600', 'hover:bg-red-700', 'text-white', 'active');
                    btn.classList.add('bg-white', 'hover:bg-gray-100', 'text-gray-700', 'hover:text-red-600', 'border-gray-200', 'hover:border-red-300');
                }
            });
        }

        function applyFilters() {
            // Get current filter values
            currentFilters.sort = document.getElementById('sort-filter')?.value || 'newest';
            currentFilters.price = document.getElementById('price-filter')?.value || '';
            currentFilters.stock = document.getElementById('stock-filter')?.value || '';
            currentFilters.search = document.getElementById('search-filter')?.value.toLowerCase() || '';

            // Filter products
            let filteredProducts = allProducts.filter(card => {
                let show = true;

                // Category filter
                if (currentFilters.category) {
                    const productCategory = card.getAttribute('data-category') || '';
                    if (productCategory !== currentFilters.category) {
                        show = false;
                    }
                }

                // Search filter
                if (currentFilters.search) {
                    const productName = (card.getAttribute('data-name') || '').toLowerCase();
                    const productDesc = card.querySelector('p')?.textContent.toLowerCase() || '';
                    const productPrice = card.getAttribute('data-price') || '';
                    const searchTerms = currentFilters.search.split(' ').filter(term => term.length > 0);
                    
                    const hasSearchMatch = searchTerms.some(term => 
                        productName.includes(term) || 
                        productDesc.includes(term) || 
                        productPrice.includes(term)
                    );
                    
                    if (!hasSearchMatch) {
                        show = false;
                    }
                }

                // Price filter
                if (currentFilters.price) {
                    const price = parseInt(card.getAttribute('data-price') || '0');
                    
                    switch(currentFilters.price) {
                        case '0-100':
                            if (price > 100) show = false;
                            break;
                        case '100-300':
                            if (price < 100 || price > 300) show = false;
                            break;
                        case '300-500':
                            if (price < 300 || price > 500) show = false;
                            break;
                        case '500-1000':
                            if (price < 500 || price > 1000) show = false;
                            break;
                        case '1000+':
                            if (price < 1000) show = false;
                            break;
                    }
                }

                // Stock filter
                if (currentFilters.stock) {
                    const stock = parseInt(card.getAttribute('data-stock') || '0');
                    
                    switch(currentFilters.stock) {
                        case 'in-stock':
                            if (stock <= 0) show = false;
                            break;
                        case 'low-stock':
                            if (stock <= 0 || stock > 5) show = false;
                            break;
                        case 'out-of-stock':
                            if (stock > 0) show = false;
                            break;
                    }
                }

                return show;
            });

            // Sort filtered products
            if (currentFilters.sort && currentFilters.sort !== 'newest') {
                filteredProducts = sortProductsArray(filteredProducts, currentFilters.sort);
            }

            // Update display
            updateProductsDisplay(filteredProducts);
            updateActiveFiltersDisplay(filteredProducts.length);
            
            // Show notification
            showNotification(`Found ${filteredProducts.length} products matching your filters`, 'success');
        }

        function sortProductsArray(products, sortType) {
            return [...products].sort((a, b) => {
                switch(sortType) {
                    case 'price-low':
                        return parseInt(a.getAttribute('data-price') || '0') - parseInt(b.getAttribute('data-price') || '0');
                    case 'price-high':
                        return parseInt(b.getAttribute('data-price') || '0') - parseInt(a.getAttribute('data-price') || '0');
                    case 'rating':
                        return parseFloat(b.getAttribute('data-rating') || '0') - parseFloat(a.getAttribute('data-rating') || '0');
                    case 'popular':
                        // Sort by rating + random factor for popularity simulation
                        const ratingA = parseFloat(a.getAttribute('data-rating') || '0');
                        const ratingB = parseFloat(b.getAttribute('data-rating') || '0');
                        const popularityA = ratingA + (Math.random() * 0.5);
                        const popularityB = ratingB + (Math.random() * 0.5);
                        return popularityB - popularityA;
                    case 'name':
                        const nameA = (a.getAttribute('data-name') || '').toLowerCase();
                        const nameB = (b.getAttribute('data-name') || '').toLowerCase();
                        return nameA.localeCompare(nameB);
                    default:
                        return 0;
                }
            });
        }

        function updateProductsDisplay(visibleProducts) {
            const container = document.querySelector('.grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-3');
            if (!container) return;

            // Hide all products first
            allProducts.forEach(card => {
                card.style.display = 'none';
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
            });

            // Show and animate visible products
            visibleProducts.forEach((card, index) => {
                // Re-append to container to maintain order
                container.appendChild(card);
                
                // Show with animation delay
                setTimeout(() => {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                    card.style.transition = 'all 0.4s ease-out';
                }, index * 50);
            });

            // Handle empty state
            if (visibleProducts.length === 0) {
                showEmptyState(container);
            } else {
                removeEmptyState();
            }
        }

        function showEmptyState(container) {
            removeEmptyState(); // Remove existing empty state first
            
            const emptyState = document.createElement('div');
            emptyState.id = 'empty-state';
            emptyState.className = 'col-span-full text-center py-16';
            emptyState.innerHTML = `
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0118 12c0-4.418-3.582-8-8-8s-8 3.582-8 8c0 1.042.199 2.04.559 2.958.184.467.283.98.283 1.518v.001c0 .317-.066.633-.195.928A1.5 1.5 0 004.5 18.75h15a1.5 1.5 0 00-1.353-2.273 2.983 2.983 0 01-.195-.928v-.001c0-.538.099-1.051.283-1.518z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2" style="font-family: 'Playfair Display', serif;">No products found</h3>
                    <p class="text-gray-600 mb-6">Try adjusting your filters or search terms to find what you're looking for.</p>
                    <button onclick="clearAllFilters()" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-300">
                        Clear All Filters
                    </button>
                </div>
            `;
            container.appendChild(emptyState);
        }

        function removeEmptyState() {
            const emptyState = document.getElementById('empty-state');
            if (emptyState) {
                emptyState.remove();
            }
        }

        function updateActiveFiltersDisplay(count) {
            const activeFiltersDiv = document.getElementById('active-filters');
            const filterTagsDiv = document.getElementById('filter-tags');
            const resultsCount = document.getElementById('results-count');
            const activeFiltersBadge = document.getElementById('active-filters-badge');
            
            if (resultsCount) {
                resultsCount.textContent = `${count} products found`;
            }
            
            if (!filterTagsDiv) return;
            
            // Clear existing tags
            filterTagsDiv.innerHTML = '';
            
            let hasActiveFilters = false;
            let activeFiltersCount = 0;
            
            // Add filter tags with better labeling
            if (currentFilters.category) {
                const categoryName = currentFilters.category.charAt(0).toUpperCase() + currentFilters.category.slice(1);
                addFilterTag('Category', categoryName, 'category');
                hasActiveFilters = true;
                activeFiltersCount++;
            }
            
            if (currentFilters.price) {
                const priceLabels = {
                    '0-100': 'Under 100 DH',
                    '100-300': '100-300 DH',
                    '300-500': '300-500 DH',
                    '500-1000': '500-1000 DH',
                    '1000+': 'Over 1000 DH'
                };
                addFilterTag('Price', priceLabels[currentFilters.price] || currentFilters.price, 'price');
                hasActiveFilters = true;
                activeFiltersCount++;
            }
            
            if (currentFilters.stock) {
                const stockLabels = {
                    'in-stock': 'In Stock',
                    'low-stock': 'Low Stock',
                    'out-of-stock': 'Out of Stock'
                };
                addFilterTag('Stock', stockLabels[currentFilters.stock] || currentFilters.stock, 'stock');
                hasActiveFilters = true;
                activeFiltersCount++;
            }
            
            if (currentFilters.search) {
                addFilterTag('Search', `"${currentFilters.search}"`, 'search');
                hasActiveFilters = true;
                activeFiltersCount++;
            }
            
            if (currentFilters.sort !== 'newest') {
                const sortLabels = {
                    'price-low': 'Price: Low to High',
                    'price-high': 'Price: High to Low',
                    'rating': 'Highest Rated',
                    'popular': 'Most Popular',
                    'name': 'Name A-Z'
                };
                addFilterTag('Sort', sortLabels[currentFilters.sort] || currentFilters.sort, 'sort');
                hasActiveFilters = true;
                activeFiltersCount++;
            }
            
            // Update active filters badge on toggle button
            if (activeFiltersBadge) {
                if (activeFiltersCount > 0) {
                    activeFiltersBadge.textContent = activeFiltersCount;
                    activeFiltersBadge.classList.remove('hidden');
                    activeFiltersBadge.style.animation = 'pulse 0.5s ease-in-out';
                } else {
                    activeFiltersBadge.classList.add('hidden');
                }
            }
            
            // Show/hide active filters section
            if (activeFiltersDiv) {
                if (hasActiveFilters) {
                    activeFiltersDiv.classList.remove('hidden', 'translate-y-4', 'opacity-0');
                    activeFiltersDiv.classList.add('translate-y-0', 'opacity-100');
                } else {
                    activeFiltersDiv.classList.add('hidden');
                }
            }
        }

        function addFilterTag(label, value, type) {
            const filterTagsDiv = document.getElementById('filter-tags');
            if (!filterTagsDiv) return;
            
            const tag = document.createElement('span');
            tag.className = 'inline-flex items-center bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium hover:bg-red-200 transition-colors duration-200';
            tag.innerHTML = `
                <span class="mr-2">${label}: ${value}</span>
                <button onclick="removeFilter('${type}')" class="text-red-500 hover:text-red-700 transition-colors duration-200" title="Remove filter">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            filterTagsDiv.appendChild(tag);
        }

        function removeFilter(type) {
            switch(type) {
                case 'category':
                    currentFilters.category = '';
                    updateCategoryButtons('');
                    break;
                case 'price':
                    currentFilters.price = '';
                    document.getElementById('price-filter').value = '';
                    break;
                case 'stock':
                    currentFilters.stock = '';
                    document.getElementById('stock-filter').value = '';
                    break;
                case 'search':
                    currentFilters.search = '';
                    document.getElementById('search-filter').value = '';
                    break;
                case 'sort':
                    currentFilters.sort = 'newest';
                    document.getElementById('sort-filter').value = 'newest';
                    break;
            }
            applyFilters();
        }

        function clearAllFilters() {
            currentFilters = {
                category: '',
                sort: 'newest',
                price: '',
                stock: '',
                search: ''
            };
            
            // Reset form elements
            document.getElementById('sort-filter').value = 'newest';
            document.getElementById('price-filter').value = '';
            document.getElementById('stock-filter').value = '';
            document.getElementById('search-filter').value = '';
            
            // Reset category buttons
            updateCategoryButtons('');
            
            // Reset quick filter buttons
            document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            // Make 'All' button active
            const allBtn = document.querySelector('.quick-filter-btn[onclick="filterByCategory(\'\')"]');
            if (allBtn) allBtn.classList.add('active');
            
            // Hide active filters badge
            const badge = document.getElementById('active-filters-badge');
            if (badge) badge.classList.add('hidden');
            
            // Show all products in original order
            updateProductsDisplay(originalProductsOrder);
            
            // Hide active filters
            const activeFiltersDiv = document.getElementById('active-filters');
            if (activeFiltersDiv) {
                activeFiltersDiv.classList.add('hidden');
            }
            
            showNotification('All filters cleared! Showing all products.', 'success');
        }

        // Visual feedback functions for responsive filters
        function addFilterLoadingState(element) {
            element.classList.add('filter-loading');
            element.style.transition = 'all 0.2s ease-in-out';
        }
        
        function removeFilterLoadingState(element) {
            element.classList.remove('filter-loading');
        }
        
        // Enhanced filter responsiveness with visual feedback
        function applyFiltersWithFeedback() {
            // Add loading state to products container
            const productsContainer = document.querySelector('.grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-3');
            if (productsContainer) {
                productsContainer.style.opacity = '0.8';
                productsContainer.style.transition = 'opacity 0.2s ease-in-out';
            }
            
            // Apply filters
            applyFilters();
            
            // Remove loading state
            setTimeout(() => {
                if (productsContainer) {
                    productsContainer.style.opacity = '1';
                }
            }, 300);
        }

        // Add event listeners for filter inputs
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize filters
            initializeFilters();
            
            // Auto-apply filters when inputs change with visual feedback
            const sortFilter = document.getElementById('sort-filter');
            const priceFilter = document.getElementById('price-filter');
            const stockFilter = document.getElementById('stock-filter');
            const searchFilter = document.getElementById('search-filter');
            
            // Add responsive filter change handlers
            if (sortFilter) {
                sortFilter.addEventListener('change', function() {
                    addFilterLoadingState(this);
                    setTimeout(() => {
                        applyFilters();
                        removeFilterLoadingState(this);
                    }, 150);
                });
            }
            
            if (priceFilter) {
                priceFilter.addEventListener('change', function() {
                    addFilterLoadingState(this);
                    setTimeout(() => {
                        applyFilters();
                        removeFilterLoadingState(this);
                    }, 150);
                });
            }
            
            if (stockFilter) {
                stockFilter.addEventListener('change', function() {
                    addFilterLoadingState(this);
                    setTimeout(() => {
                        applyFilters();
                        removeFilterLoadingState(this);
                    }, 150);
                });
            }
            
            // Search filter with debounce for better performance and visual feedback
            let searchTimeout;
            if (searchFilter) {
                searchFilter.addEventListener('input', function() {
                    const input = this;
                    clearTimeout(searchTimeout);
                    addFilterLoadingState(input);
                    
                    searchTimeout = setTimeout(() => {
                        applyFilters();
                        removeFilterLoadingState(input);
                    }, 300); // Wait 300ms after user stops typing
                });
                
                // Add search icon and clear button functionality
                searchFilter.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        clearTimeout(searchTimeout);
                        addFilterLoadingState(this);
                        setTimeout(() => {
                            applyFilters();
                            removeFilterLoadingState(this);
                        }, 100);
                    }
                    if (e.key === 'Escape') {
                        this.value = '';
                        addFilterLoadingState(this);
                        setTimeout(() => {
                            applyFilters();
                            removeFilterLoadingState(this);
                        }, 100);
                    }
                });
            }

            // Add keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + K to focus search
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    if (searchFilter) {
                        searchFilter.focus();
                        searchFilter.select();
                    }
                }
                
                // Escape to clear all filters
                if (e.key === 'Escape' && !e.target.matches('input, textarea, select')) {
                    clearAllFilters();
                }
            });

            // Animate counters after a delay
            setTimeout(() => {
                const totalProductsCounter = document.getElementById('total-products-counter');
                const categoriesCounter = document.getElementById('categories-counter');
                const dailyViewsCounter = document.getElementById('daily-views-counter');
                
                if (totalProductsCounter) animateCounter(totalProductsCounter, 50);
                if (categoriesCounter) animateCounter(categoriesCounter, 5);
                if (dailyViewsCounter) animateCounter(dailyViewsCounter, 4900);
            }, 1000);

            // Initialize cart and wishlist functionality
            updateCartCount();
            updateWishlistCount();
            updateWishlistButtons();
            
            // Add intersection observer for lazy loading animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '50px'
            };
            
            const productObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        productObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            // Observe all product cards for scroll animations
            document.querySelectorAll('.product-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                productObserver.observe(card);
            });
        });

        // Scroll to products function
        function scrollToProducts() {
            const productsSection = document.getElementById('products-section');
            if (productsSection) {
                productsSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            } else {
                // Fallback: scroll to first product card
                const firstProductCard = document.querySelector('.product-card');
                if (firstProductCard) {
                    firstProductCard.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        }

        // Animated counters for hero section
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            
            function updateCounter() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            }
            
            updateCounter();
        }
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
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views/products.blade.php ENDPATH**/ ?>