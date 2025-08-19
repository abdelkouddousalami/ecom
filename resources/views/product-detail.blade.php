<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - l3ochaq Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Cinzel:wght@400;500;600;700;800;900&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Instrument Sans', 'Inter', sans-serif; 
        }
        
        .font-playfair { 
            font-family: 'Playfair Display', serif; 
        }
        
        .image-gallery {
            display: grid;
            grid-template-columns: 1fr 4fr;
            gap: 1rem;
        }
        
        .thumbnail-grid {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .thumbnail.active {
            border-color: #3B82F6;
        }
        
        .thumbnail:hover {
            border-color: #93C5FD;
        }
        
        .main-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 12px;
        }
        
        @media (max-width: 768px) {
            .image-gallery {
                grid-template-columns: 1fr;
            }
            
            .thumbnail-grid {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 10px;
            }
            
            .thumbnail {
                min-width: 80px;
            }
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-green {
            background-color: #DCFCE7;
            color: #166534;
        }
        
        .badge-red {
            background-color: #FEE2E2;
            color: #DC2626;
        }
        
        .badge-yellow {
            background-color: #FEF3C7;
            color: #D97706;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            border: 2px solid #E5E7EB;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .quantity-btn {
            padding: 0.75rem 1rem;
            background: #F9FAFB;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .quantity-btn:hover {
            background: #E5E7EB;
        }
        
        .quantity-input {
            border: none;
            padding: 0.75rem;
            text-align: center;
            width: 60px;
            background: white;
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <x-navbar active-page="products" />

    <!-- Breadcrumb -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-100 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="/" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Home</a></li>
                    <li><span class="text-gray-400 mx-2">/</span></li>
                    <li><a href="/products" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">Products</a></li>
                    <li><span class="text-gray-400 mx-2">/</span></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition duration-300 font-medium">{{ $product->category->name ?? 'Category' }}</a></li>
                    <li><span class="text-gray-400 mx-2">/</span></li>
                    <li class="text-gray-900 font-semibold">{{ $product->name }}</li>
                </ol>
            </nav>
            
            <!-- Page Title -->
            <div class="mb-2">
                <h1 class="text-3xl font-bold text-gray-900 font-playfair">{{ $product->name }}</h1>
                <p class="text-gray-600 mt-2">{{ $product->category->name ?? 'Product' }} • SKU: {{ $product->sku ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 p-8">
            <!-- Product Images -->
            <div class="space-y-6">
                <div class="image-gallery">
                    <!-- Thumbnails -->
                    <div class="thumbnail-grid">
                        @if($product->images && $product->images->count() > 0)
                            @foreach($product->images as $index => $image)
                                <img src="{{ Storage::url($image->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                     onclick="changeMainImage('{{ Storage::url($image->image_path) }}', {{ $index }})">
                            @endforeach
                        @else
                            <img src="{{ $product->image ? Storage::url($product->image) : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&h=400&fit=crop' }}" 
                                 alt="{{ $product->name }}" 
                                 class="thumbnail active"
                                 onclick="changeMainImage('{{ $product->image ? Storage::url($product->image) : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&h=400&fit=crop' }}', 0)">
                        @endif
                    </div>
                    
                    <!-- Main Image -->
                    <div class="relative">
                        @if($product->images && $product->images->count() > 0)
                            <img id="main-image" src="{{ Storage::url($product->images->first()->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="main-image">
                        @else
                            <img id="main-image" src="{{ $product->image ? Storage::url($product->image) : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&h=400&fit=crop' }}" 
                                 alt="{{ $product->name }}" 
                                 class="main-image">
                        @endif
                        
                        <!-- Image Zoom -->
                        <div class="absolute top-4 right-4">
                            <button onclick="openImageModal()" class="bg-white p-2 rounded-full shadow-lg hover:shadow-xl transition-shadow">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Discount Badge -->
                        @if($product->original_price && $product->original_price > $product->price)
                            <div class="absolute top-4 left-4">
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                    -{{ $product->discount_percentage }}%
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="space-y-6">
                <!-- Product Category & Status -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="badge badge-green">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        @if($product->is_featured)
                            <span class="badge badge-yellow">Featured</span>
                        @endif
                    </div>
                    
                    <!-- Rating & Reviews -->
                    <div class="flex items-center space-x-4 mb-4">
                        @if($product->rating)
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= floor($product->rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                                <span class="ml-2 text-gray-600">{{ $product->rating }} ({{ $product->review_count }} {{ $product->review_count == 1 ? 'review' : 'reviews' }})</span>
                            </div>
                        @else
                            <span class="text-gray-500">No reviews yet</span>
                        @endif
                    </div>
                </div>

                <!-- Price -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                    <div class="flex items-baseline space-x-4">
                        <span class="text-4xl font-bold text-green-600 font-playfair">{{ number_format($product->price) }} DH</span>
                        @if($product->original_price && $product->original_price > $product->price)
                            <span class="text-xl text-gray-500 line-through">{{ number_format($product->original_price) }} DH</span>
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Save {{ number_format($product->original_price - $product->price) }} DH</span>
                        @endif
                    </div>
                    @if($product->original_price && $product->original_price > $product->price)
                        <p class="text-green-700 text-sm mt-2 font-medium">You save {{ $product->discount_percentage }}% on this item!</p>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="flex items-center space-x-2">
                    @if($product->stock > 0)
                        <span class="badge badge-green">✓ In Stock ({{ $product->stock }} available)</span>
                        @if($product->is_low_stock)
                            <span class="badge badge-yellow">⚠ Low Stock</span>
                        @endif
                    @else
                        <span class="badge badge-red">✗ Out of Stock</span>
                    @endif
                </div>

                <!-- Description -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 font-playfair">Description</h3>
                    <p class="text-gray-700 leading-relaxed text-base">{{ $product->description }}</p>
                </div>

                <!-- Specifications -->
                @if($product->specifications)
                    <div class="bg-blue-50 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-playfair">Specifications</h3>
                        <div class="bg-white rounded-lg p-4 border border-blue-200">
                            <pre class="text-gray-700 whitespace-pre-wrap text-sm leading-relaxed">{{ $product->specifications }}</pre>
                        </div>
                    </div>
                @endif

                <!-- Tags -->
                @if($product->tags)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $product->tags) as $tag)
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Quantity & Add to Cart -->
                @if($product->stock > 0)
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center space-x-6 mb-6">
                            <label class="text-lg font-bold text-gray-900 font-playfair">Quantity:</label>
                            <div class="quantity-control">
                                <button type="button" class="quantity-btn" onclick="decreaseQuantity()">−</button>
                                <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="quantity-input">
                                <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                            </div>
                            <span class="text-sm text-gray-600">{{ $product->stock }} available</span>
                        </div>
                        
                        <div class="flex space-x-4">
                            <button onclick="addToCart({{ $product->id }})" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-xl transition duration-300 flex items-center justify-center space-x-3 shadow-lg hover:shadow-xl transform hover:scale-105 font-playfair">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l1.68 3.36M7 13h10m-6 3a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"></path>
                                </svg>
                                <span>Add to Cart</span>
                            </button>
                            
                            <button onclick="addToWishlist({{ $product->id }})" class="bg-white border-2 border-red-300 text-red-600 hover:bg-red-50 hover:border-red-500 font-bold py-4 px-6 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4 font-playfair">You May Also Like</h2>
                    <p class="text-gray-600 text-lg">Discover more products from the same category</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 group overflow-hidden cursor-pointer transform hover:scale-105" onclick="window.location.href='{{ route('product.show', $relatedProduct->slug) }}'">
                            <div class="relative h-64 overflow-hidden">
                                @if($relatedProduct->images && $relatedProduct->images->count() > 0)
                                    <img src="{{ Storage::url($relatedProduct->images->first()->image_path) }}" 
                                         alt="{{ $relatedProduct->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <img src="{{ $relatedProduct->image ? Storage::url($relatedProduct->image) : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&h=400&fit=crop' }}" 
                                         alt="{{ $relatedProduct->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @endif
                                
                                <!-- Quick Add to Wishlist -->
                                <button onclick="event.stopPropagation(); addToWishlist({{ $relatedProduct->id }})" class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-lg hover:bg-red-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-3 text-gray-900 group-hover:text-blue-600 transition duration-300 font-playfair">
                                    {{ $relatedProduct->name }}
                                </h3>
                                
                                <!-- Category -->
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-3">
                                    {{ $relatedProduct->category->name ?? 'Category' }}
                                </span>
                                
                                <!-- Rating -->
                                @if($relatedProduct->rating)
                                    <div class="flex items-center mb-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= floor($relatedProduct->rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-600">({{ $relatedProduct->review_count }})</span>
                                    </div>
                                @endif
                                
                                <!-- Price -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-green-600 font-playfair">{{ number_format($relatedProduct->price) }} DH</span>
                                        @if($relatedProduct->original_price && $relatedProduct->original_price > $relatedProduct->price)
                                            <span class="text-gray-500 line-through text-sm ml-2">{{ number_format($relatedProduct->original_price) }} DH</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <img src="{{ asset('images/logos/logo.png') }}" alt="l3ochaq Logo" class="h-8 w-auto mb-4">
                    <p class="text-gray-400 mb-4">Premium jewelry and accessories for those who appreciate quality and elegance.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 font-playfair">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="/products" class="text-gray-400 hover:text-white transition duration-300">Products</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 font-playfair">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Bracelets</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Watches</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Gift Packs</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 font-playfair">Contact Us</h4>
                    <div class="space-y-2 text-gray-400">
                        <p>Email: contact@l3ochaq.com</p>
                        <p>Phone: +212 123 456 789</p>
                        <p>Address: Casablanca, Morocco</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 l3ochaq Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 p-4" style="display: none; align-items: center; justify-content: center;">
        <div class="relative max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain rounded-lg">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <script>
        // Image gallery functionality
        function changeMainImage(imageSrc, index) {
            document.getElementById('main-image').src = imageSrc;
            
            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
                thumb.classList.toggle('active', i === index);
            });
        }
        
        // Image modal functionality
        function openImageModal() {
            const mainImage = document.getElementById('main-image');
            const modalImage = document.getElementById('modalImage');
            const modal = document.getElementById('imageModal');
            
            modalImage.src = mainImage.src;
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Close modal on background click
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
        
        // Quantity controls
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.getAttribute('max'));
            const current = parseInt(input.value);
            
            if (current < max) {
                input.value = current + 1;
            }
        }
        
        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            
            if (current > 1) {
                input.value = current - 1;
            }
        }
        
        // Keyboard navigation for modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
        
        // Simple cart and wishlist functions using localStorage
        
        // Stylish notification function (simplified version)
        function showNotification(message, type = 'success') {
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
                <span style="font-size: 24px;">•</span>
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
        
        function addToCart(productId) {
            const quantity = document.getElementById('quantity').value;
            console.log('addToCart called with productId:', productId, 'quantity:', quantity);
            
            // First, make server request for tracking and cart management
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    product_id: productId,
                    quantity: parseInt(quantity)
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Server response:', data);
                if (data.success) {
                    console.log('Server cart tracking successful:', data.message);
                    showNotification(data.message, 'success');
                    
                    // Update localStorage only after successful server request
                    updateLocalStorageCart(productId, parseInt(quantity));
                } else {
                    console.error('Server cart error:', data.message);
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Server cart request error:', error);
                showNotification('Error connecting to server. Item added to local cart only.', 'warning');
                
                // Fallback: update localStorage even if server request failed
                updateLocalStorageCart(productId, parseInt(quantity));
            });
        }

        function updateLocalStorageCart(productId, quantity) {
            // Handle localStorage for frontend functionality
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Check if product already in cart
            const existingItem = cart.find(item => item.id == productId);
            if (existingItem) {
                existingItem.quantity += quantity;
                console.log('Updating cart quantity to:', existingItem.quantity);
                showNotification(`Quantité mise à jour (${existingItem.quantity}) dans le panier!`, 'success');
            } else {
                cart.push({
                    id: productId,
                    quantity: quantity,
                    added_at: new Date().toISOString()
                });
                console.log('Adding new product to cart with quantity:', quantity);
                showNotification(`${quantity} produit(s) ajouté(s) au panier!`, 'success');
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
                    console.log('Server tracking successful:', data.message);
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
                showNotification('Produit retiré des favoris!', 'removed');
            } else {
                wishlist.push({
                    id: productId,
                    added_at: new Date().toISOString()
                });
                showNotification('Produit ajouté aux favoris!', 'success');
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
        
        // Initialize cart and wishlist counts on page load (only show if there are items)
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality
            const mobileMenuBtn = document.getElementById('mobileMenuToggle');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

            if (mobileMenuBtn && mobileMenuOverlay) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenuBtn.classList.toggle('active');
                    mobileMenuOverlay.classList.toggle('active');
                });

                // Close menu when clicking outside
                mobileMenuOverlay.addEventListener('click', function() {
                    mobileMenuBtn.classList.remove('active');
                    mobileMenuOverlay.classList.remove('active');
                });
            }

            updateCartCount();
            updateWishlistCount();
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

                const allProducts = @json($allProducts ?? []);

                cart.forEach(item => {
                    const product = allProducts.find(p => p.id == item.id);
                    if (product) {
                        const itemTotal = product.price * item.quantity;
                        totalPrice += itemTotal;

                        const cartItemHTML = `
                            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-4 border border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <!-- Product Image -->
                                    <div class="relative flex-shrink-0">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-50 border">
                                            <img src="/${product.image}" 
                                                 alt="${product.name}" 
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='https://via.placeholder.com/64x64/f3f4f6/9ca3af?text=No+Image'">
                                        </div>
                                        <div class="absolute -top-2 -right-2 bg-blue-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">
                                            ${item.quantity}
                                        </div>
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-gray-900 mb-1">${product.name}</h4>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2 py-1 rounded">${product.price} DH</span>
                                            <span class="text-gray-500 text-xs">× ${item.quantity}</span>
                                        </div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-2">
                                            <button type="button" onclick="updateQuantityModal(${item.id}, ${item.quantity - 1})" 
                                                    class="w-6 h-6 flex items-center justify-center bg-red-100 hover:bg-red-200 text-red-600 rounded transition-colors">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-900 text-xs font-semibold rounded">${item.quantity}</span>
                                            <button type="button" onclick="updateQuantityModal(${item.id}, ${item.quantity + 1})" 
                                                    class="w-6 h-6 flex items-center justify-center bg-green-100 hover:bg-green-200 text-green-600 rounded transition-colors">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Price and Remove -->
                                    <div class="flex flex-col items-end space-y-2">
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-green-600">${itemTotal} DH</p>
                                        </div>
                                        <button type="button" onclick="removeFromCartModal(${item.id})" 
                                                class="text-red-500 hover:text-red-700 transition-colors">
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
            const allProducts = @json($allProducts ?? []);
            const product = allProducts.find(p => p.id == productId);
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
    </script>

    <!-- Cart Modal -->
    <div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="bg-blue-600 text-white p-6 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold">Mon Panier</h2>
                        <span id="modal-items-count" class="bg-blue-800 text-white px-3 py-1 rounded-full text-sm font-bold">0 article(s)</span>
                    </div>
                    <button type="button" onclick="closeCartModal()" class="text-white hover:text-gray-200 transition duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6 overflow-y-auto max-h-[60vh]">
                    <!-- Empty Cart -->
                    <div id="modal-empty-cart" class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Votre panier est vide</h3>
                        <p class="text-gray-600 mb-6">Découvrez nos produits et ajoutez vos favoris à votre panier</p>
                        <button type="button" onclick="closeCartModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                            Continuer le Shopping
                        </button>
                    </div>

                    <!-- Cart Items -->
                    <div id="modal-cart-items" class="hidden">
                        <div id="modal-items-list" class="space-y-4">
                            <!-- Dynamic cart items will be inserted here -->
                        </div>
                    </div>
                </div>

                <!-- Modal Footer with Summary -->
                <div id="modal-cart-footer" class="hidden bg-gray-50 p-6 border-t">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                        <!-- Summary -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-medium">Sous-total:</span>
                                <span id="modal-subtotal" class="font-bold text-gray-900">0 DH</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-medium">Livraison:</span>
                                <span class="font-bold text-green-600">Gratuite</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-t">
                                <span class="text-lg font-bold text-gray-900">Total:</span>
                                <span id="modal-total" class="text-xl font-bold text-blue-600">0 DH</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-3">
                            <button type="button" onclick="clearCartModal()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-300">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Vider le panier
                            </button>
                            <button type="button" onclick="processCheckout()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Procéder au paiement
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
