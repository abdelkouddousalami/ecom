<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - l3ochaq Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logos/faicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/faicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logos/faicon.png') }}">
    
    <!-- Load Tailwind CSS directly -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .cart-item {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .cart-item:nth-child(2) { animation-delay: 0.1s; }
        .cart-item:nth-child(3) { animation-delay: 0.2s; }
        .cart-item:nth-child(4) { animation-delay: 0.3s; }
        
        .full-width-section {
            width: 100vw;
            margin-left: calc(-50vw + 50%);
        }
        
        /* Updated button styles with modern blue color scheme */
        .btn-primary {
            background-color: #3b82f6;
            border: none;
            color: white;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }
        
        .btn-secondary {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            color: #374151;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-secondary:hover {
            background-color: #e5e7eb;
            border-color: #d1d5db;
            transform: translateY(-1px);
        }
        
        /* Enhanced card shadows and hover effects */
        .card-shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .card-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }
        
        /* Added gradient background for header */
        .header-gradient {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        /* Enhanced quantity controls */
        .quantity-btn {
            transition: all 0.2s ease;
        }
        
        .quantity-btn:hover {
            background-color: #3b82f6;
            color: white;
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            /* Mobile header adjustments */
            .full-width-section .w-full {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            
            .header-gradient .w-full {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
            
            .header-gradient h1 {
                font-size: 2rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            .header-gradient p {
                font-size: 1rem !important;
                padding: 0 1rem;
            }
            
            /* Mobile cart content */
            .full-width-section.bg-gray-50 .w-full {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            
            /* Mobile grid layout - stack vertically */
            .grid.xl\\:grid-cols-\\[2fr_1fr\\] {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }
            
            /* Mobile card adjustments */
            .bg-white.rounded-2xl.card-shadow {
                padding: 1rem !important;
                border-radius: 1rem !important;
            }
            
            /* Mobile cart item layout */
            .cart-item .flex.flex-col.lg\\:flex-row {
                flex-direction: column !important;
                align-items: flex-start !important;
                space-y: 1rem;
            }
            
            .cart-item .lg\\:space-x-8 {
                margin-left: 0 !important;
            }
            
            .cart-item .lg\\:space-y-0 {
                row-gap: 1rem !important;
            }
            
            /* Mobile product image */
            .cart-item .w-24.h-24 {
                width: 4rem !important;
                height: 4rem !important;
            }
            
            /* Mobile product details */
            .cart-item h4 {
                font-size: 1.125rem !important;
                margin-bottom: 0.75rem !important;
            }
            
            .cart-item .flex.items-center.space-x-4.mb-6 {
                flex-wrap: wrap !important;
                gap: 0.5rem !important;
                margin-bottom: 1rem !important;
            }
            
            /* Mobile quantity controls */
            .cart-item .flex.items-center.space-x-4:last-of-type {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.75rem !important;
            }
            
            .cart-item .flex.items-center.bg-gray-50 {
                order: 1;
            }
            
            /* Mobile price and actions */
            .cart-item .flex.flex-col.items-end {
                flex-direction: row !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
                margin-top: 1rem !important;
            }
            
            .cart-item .text-right {
                text-align: left !important;
            }
            
            .cart-item .text-2xl.font-bold.text-blue-600 {
                font-size: 1.25rem !important;
            }
            
            /* Mobile order summary */
            .bg-white.rounded-2xl.card-shadow.sticky {
                position: relative !important;
                top: auto !important;
            }
            
            .bg-white.rounded-2xl.card-shadow h3 {
                font-size: 1.25rem !important;
                margin-bottom: 1.5rem !important;
            }
            
            .bg-white.rounded-2xl.card-shadow .text-2xl.font-bold {
                font-size: 1.125rem !important;
            }
            
            .bg-white.rounded-2xl.card-shadow .text-3xl.font-bold {
                font-size: 1.5rem !important;
            }
            
            /* Mobile buttons */
            .btn-primary, .btn-secondary {
                padding-top: 0.75rem !important;
                padding-bottom: 0.75rem !important;
                font-size: 0.875rem !important;
            }
            
            /* Mobile empty cart */
            #empty-cart .bg-white.rounded-2xl {
                padding: 2rem !important;
                margin: 0 1rem !important;
            }
            
            #empty-cart .w-32.h-32 {
                width: 4rem !important;
                height: 4rem !important;
                margin-bottom: 1rem !important;
            }
            
            #empty-cart h3 {
                font-size: 1.5rem !important;
                margin-bottom: 0.75rem !important;
            }
            
            #empty-cart p {
                font-size: 0.875rem !important;
                margin-bottom: 1.5rem !important;
                line-height: 1.4 !important;
            }
            
            /* Mobile spacing adjustments */
            .space-y-6 > * + * {
                margin-top: 1rem !important;
            }
            
            .space-y-4 > * + * {
                margin-top: 0.75rem !important;
            }
            
            /* Mobile notification adjustments */
            .custom-notification {
                right: 10px !important;
                left: 10px !important;
                min-width: auto !important;
                margin: 0 !important;
            }
        }
        
        @media (max-width: 480px) {
            /* Extra small mobile adjustments */
            .full-width-section .w-full {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }
            
            .header-gradient h1 {
                font-size: 1.75rem !important;
            }
            
            .cart-item .bg-white.rounded-xl {
                padding: 0.75rem !important;
            }
            
            .cart-item h4 {
                font-size: 1rem !important;
            }
            
            .bg-white.rounded-2xl.card-shadow {
                padding: 0.75rem !important;
            }
            
            .btn-primary, .btn-secondary {
                padding: 0.625rem !important;
                font-size: 0.8rem !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Navigation -->
    <x-navbar active-page="cart" />

    <!-- Enhanced page header with gradient background -->
    <div class="full-width-section header-gradient border-b border-gray-200">
        <div class="w-full px-6 lg:px-12 py-16">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-gray-900 mb-4">Mon Panier</h1>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">Gérez vos articles sélectionnés et finalisez votre commande</p>
            </div>
        </div>
    </div>

    <!-- Cart Content -->
    <div class="full-width-section bg-gray-50 min-h-screen">
        <div class="w-full px-6 lg:px-12 py-12">
            <div id="cart-container">
                <!-- Empty Cart State -->
                <div id="empty-cart" class="text-center py-20">
                    <div class="bg-white rounded-2xl card-shadow p-16 max-w-2xl mx-auto border border-gray-100">
                        <div class="w-32 h-32 mx-auto mb-8 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Votre panier est vide</h3>
                        <p class="text-gray-600 mb-10 text-lg leading-relaxed">Découvrez notre collection de produits exceptionnels et ajoutez vos favoris à votre panier</p>
                        <button type="button" onclick="window.location.href='/'" class="btn-primary font-bold py-4 px-10 rounded-xl transition duration-300 text-lg">
                            Découvrir nos produits
                        </button>
                    </div>
                </div>

                <!-- Cart Items -->
                <div id="cart-items" class="hidden">
                    <!-- Mobile-first responsive grid layout -->
                    <div class="flex flex-col xl:grid xl:grid-cols-[2fr_1fr] gap-4 xl:gap-8 max-w-7xl mx-auto">
                        <!-- Items List (Left Side - 2/3 width) -->
                        <div class="w-full order-2 xl:order-1">
                            <div class="bg-white rounded-xl xl:rounded-2xl card-shadow p-4 xl:p-8 border border-gray-100">
                                <div class="flex items-center justify-between mb-6 xl:mb-10">
                                    <h2 class="text-xl xl:text-3xl font-bold text-gray-900">Articles sélectionnés</h2>
                                    <div class="bg-blue-50 text-blue-600 px-3 xl:px-6 py-2 xl:py-3 rounded-full text-xs xl:text-sm font-bold border border-blue-100">
                                        <span id="items-count">0</span> article(s)
                                    </div>
                                </div>
                                <div id="items-list" class="space-y-4 xl:space-y-6">
                                    <!-- Dynamic cart items will be inserted here -->
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced order summary with better mobile styling -->
                        <div class="w-full order-1 xl:order-2">
                            <div class="bg-white rounded-xl xl:rounded-2xl card-shadow p-4 xl:p-8 xl:sticky xl:top-24 border border-gray-100">
                                <h3 class="text-lg xl:text-2xl font-bold text-gray-900 mb-4 xl:mb-8 flex items-center">
                                    <div class="w-8 h-8 xl:w-10 xl:h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 xl:mr-4">
                                        <svg class="w-4 h-4 xl:w-5 xl:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    Résumé
                                </h3>
                                <div class="space-y-4 xl:space-y-6 mb-6 xl:mb-10">
                                    <div class="flex justify-between items-center py-3 xl:py-4 border-b border-gray-100">
                                        <span class="text-gray-600 font-medium text-sm xl:text-lg">Sous-total:</span>
                                        <span id="subtotal" class="font-bold text-gray-900 text-lg xl:text-xl">0 DH</span>
                                    </div>
                                    <div class="flex justify-between items-center py-3 xl:py-4 border-b border-gray-100">
                                        <span class="text-gray-600 font-medium text-sm xl:text-lg">Livraison:</span>
                                        <span id="shipping" class="font-bold text-green-600 text-sm xl:text-lg">Gratuite</span>
                                    </div>
                                    <div class="flex justify-between items-center py-4 xl:py-6 bg-gray-50 rounded-xl px-4 xl:px-6 border border-gray-100">
                                        <span class="text-lg xl:text-2xl font-bold text-gray-900">Total:</span>
                                        <span id="total" class="text-xl xl:text-3xl font-bold text-blue-600">0 DH</span>
                                    </div>
                                </div>
                                <div class="space-y-3 xl:space-y-4">
                                    <button type="button" id="checkout-btn" class="w-full btn-primary font-bold py-3 xl:py-5 px-4 xl:px-6 rounded-xl transition-all duration-300 text-sm xl:text-lg">
                                        <svg class="w-5 h-5 xl:w-6 xl:h-6 inline mr-2 xl:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        Procéder au paiement
                                    </button>
                                    <button type="button" id="clear-cart-btn" class="w-full btn-secondary font-semibold py-3 xl:py-4 px-4 rounded-xl transition-all duration-300 text-sm xl:text-lg">
                                        <svg class="w-4 h-4 xl:w-5 xl:h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Vider le panier
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <script>
        let products = @json($products ?? []); // Pass products data from controller

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
                display: flex;
                align-items: center;
                gap: 12px;
                min-width: 320px;
                transform: translateX(100%) scale(0.8);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                font-family: system-ui, -apple-system, sans-serif;
                font-weight: 600;
                font-size: 14px;
                border: 2px solid rgba(255,255,255,0.2);
            `;
            
            notification.innerHTML = `
                <span style="font-size: 24px; animation: heartbeat 1s ease-in-out infinite;">•</span>
                <span>${message}</span>
            `;
            
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

        function loadCart() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const cartContainer = document.getElementById('cart-container');
            const emptyCart = document.getElementById('empty-cart');
            const cartItems = document.getElementById('cart-items');
            const itemsList = document.getElementById('items-list');

            if (cart.length === 0) {
                emptyCart.classList.remove('hidden');
                cartItems.classList.add('hidden');
            } else {
                emptyCart.classList.add('hidden');
                cartItems.classList.remove('hidden');
                
                let totalPrice = 0;
                itemsList.innerHTML = '';

                cart.forEach(item => {
                    const product = products.find(p => p.id == item.id);
                    if (product) {
                        const itemTotal = product.price * item.quantity;
                        totalPrice += itemTotal;

                        const cartItemHTML = `
                            <div class="cart-item bg-white rounded-xl card-shadow p-4 md:p-6 border border-gray-100 transition-all duration-300">
                                <div class="flex flex-col space-y-4 md:flex-row md:items-center md:space-y-0 md:space-x-8">
                                    <!-- Product Image and Basic Info -->
                                    <div class="flex items-center space-x-4 md:flex-col md:space-x-0 md:space-y-2 md:flex-shrink-0">
                                        <div class="relative">
                                            <div class="w-16 h-16 md:w-24 md:h-24 rounded-xl overflow-hidden bg-gray-50 border border-gray-200">
                                                <img src="/storage/${product.image}" 
                                                     alt="${product.name}" 
                                                     class="w-full h-full object-cover"
                                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iOTYiIGhlaWdodD0iOTYiIHZpZXdCb3g9IjAgMCA5NiA5NiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9Ijk2IiBoZWlnaHQ9Ijk2IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0zMiA0MEw0OCAyNEw2NCA0MFY2NEgzMlY0MFoiIGZpbGw9IiM5Q0EzQUYiLz4KPGNpcmNsZSBjeD0iNDAiIGN5PSIzNiIgcj0iNCIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'; this.onerror=null;">
                                            </div>
                                            <div class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full w-6 h-6 md:w-7 md:h-7 flex items-center justify-center text-xs md:text-sm font-bold shadow-lg">
                                                ${item.quantity}
                                            </div>
                                        </div>
                                        
                                        <!-- Mobile Product Name -->
                                        <div class="md:hidden flex-1">
                                            <h4 class="text-lg font-bold text-gray-900 leading-tight">${product.name}</h4>
                                            <p class="text-blue-600 font-bold text-sm">${product.price} DH each</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Desktop Product Details -->
                                    <div class="hidden md:block flex-1 min-w-0">
                                        <h4 class="text-xl font-bold text-gray-900 mb-3">${product.name}</h4>
                                        <div class="flex items-center space-x-4 mb-6">
                                            <span class="bg-blue-50 text-blue-600 text-sm font-bold px-4 py-2 rounded-lg border border-blue-100">${product.price} DH</span>
                                            <span class="text-gray-600 text-base">× ${item.quantity} = <strong class="text-gray-900 text-lg">${product.price * item.quantity} DH</strong></span>
                                        </div>
                                        
                                        <!-- Desktop Quantity Controls -->
                                        <div class="flex items-center space-x-4">
                                            <span class="text-base font-semibold text-gray-700">Quantité:</span>
                                            <div class="flex items-center bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                                                <button type="button" class="decrease-btn quantity-btn w-10 h-10 flex items-center justify-center hover:bg-blue-600 text-gray-600 hover:text-white transition-all duration-200" data-id="${item.id}" data-quantity="${item.quantity}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                                <span class="px-6 py-2 bg-white font-bold text-gray-900 text-base min-w-[4rem] text-center border-x border-gray-200">${item.quantity}</span>
                                                <button type="button" class="increase-btn quantity-btn w-10 h-10 flex items-center justify-center hover:bg-blue-600 text-gray-600 hover:text-white transition-all duration-200" data-id="${item.id}" data-quantity="${item.quantity}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Mobile Bottom Section -->
                                    <div class="md:hidden space-y-3">
                                        <!-- Mobile Quantity Controls -->
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-semibold text-gray-700">Quantité:</span>
                                            <div class="flex items-center bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                                                <button type="button" class="decrease-btn quantity-btn w-8 h-8 flex items-center justify-center hover:bg-blue-600 text-gray-600 hover:text-white transition-all duration-200" data-id="${item.id}" data-quantity="${item.quantity}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                                <span class="px-3 py-1 bg-white font-bold text-gray-900 text-sm min-w-[2.5rem] text-center border-x border-gray-200">${item.quantity}</span>
                                                <button type="button" class="increase-btn quantity-btn w-8 h-8 flex items-center justify-center hover:bg-blue-600 text-gray-600 hover:text-white transition-all duration-200" data-id="${item.id}" data-quantity="${item.quantity}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Mobile Price and Remove -->
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs text-gray-500">Total</p>
                                                <p class="text-lg font-bold text-blue-600">${itemTotal} DH</p>
                                            </div>
                                            <button type="button" class="remove-btn flex items-center space-x-1 bg-gray-50 hover:bg-red-50 text-gray-600 hover:text-red-600 px-3 py-2 rounded-lg border border-gray-200 hover:border-red-200 transition-all duration-300 text-xs font-semibold" data-id="${item.id}">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span>Retirer</span>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Desktop Price and Actions -->
                                    <div class="hidden md:flex flex-col items-end space-y-6">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500 mb-2">Total article</p>
                                            <p class="text-2xl font-bold text-blue-600">${itemTotal} DH</p>
                                        </div>
                                        
                                        <!-- Desktop Remove Button -->
                                        <button type="button" class="remove-btn flex items-center space-x-2 bg-gray-50 hover:bg-red-50 text-gray-600 hover:text-red-600 px-4 py-3 rounded-lg border border-gray-200 hover:border-red-200 transition-all duration-300 text-sm font-semibold" data-id="${item.id}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            <span>Retirer</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        itemsList.innerHTML += cartItemHTML;
                    }
                });

                // Update item count
                document.getElementById('items-count').textContent = cart.length;

                document.getElementById('subtotal').textContent = totalPrice + ' DH';
                document.getElementById('total').textContent = totalPrice + ' DH';
            }
            
            updateCartCount();
            updateWishlistCount();
        }

        function updateQuantity(productId, newQuantity) {
            if (newQuantity <= 0) {
                removeFromCart(productId);
                return false;
            }

            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const item = cart.find(item => item.id == productId);
            if (item) {
                item.quantity = newQuantity;
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCart();
            }
            return false;
        }

        function removeFromCart(productId) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const product = products.find(p => p.id == productId);
            cart = cart.filter(item => item.id != productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
            showNotification(`${product ? product.name : 'Produit'} retiré du panier!`, 'removed');
            return false;
        }

        function clearCart() {
            if (confirm('Êtes-vous sûr de vouloir vider votre panier?')) {
                localStorage.removeItem('cart');
                loadCart();
                showNotification('Panier vidé avec succès!', 'removed');
            }
            return false;
        }

        function processCheckout() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                showNotification('Votre panier est vide!', 'removed');
                return false;
            }
            
            // Redirect to checkout page
            window.location.href = '/checkout';
            return false;
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

        // Load cart on page load with controlled event prevention
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();
            
            // Handle clicks only for cart-specific elements
            document.body.addEventListener('click', function(e) {
                // Allow burger menu and navigation clicks to work normally
                if (e.target.closest('#mobileMenuToggle') || 
                    e.target.closest('#closeMobileMenu') || 
                    e.target.closest('#mobileMenuOverlay') ||
                    e.target.closest('.hamburger') ||
                    e.target.closest('#mobileMenu') ||
                    e.target.closest('nav')) {
                    return; // Let these clicks work normally
                }
                
                // Only prevent default for cart-specific buttons
                const isCartButton = e.target.closest('.decrease-btn') || 
                                   e.target.closest('.increase-btn') || 
                                   e.target.closest('.remove-btn') || 
                                   e.target.closest('#checkout-btn') || 
                                   e.target.closest('#clear-cart-btn');
                
                if (isCartButton) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    
                    // Decrease quantity button
                    if (e.target.closest('.decrease-btn')) {
                        const btn = e.target.closest('.decrease-btn');
                        const productId = parseInt(btn.dataset.id);
                        const currentQuantity = parseInt(btn.dataset.quantity);
                        updateQuantity(productId, currentQuantity - 1);
                    }
                    
                    // Increase quantity button
                    else if (e.target.closest('.increase-btn')) {
                        const btn = e.target.closest('.increase-btn');
                        const productId = parseInt(btn.dataset.id);
                        const currentQuantity = parseInt(btn.dataset.quantity);
                        updateQuantity(productId, currentQuantity + 1);
                    }
                    
                    // Remove item button
                    else if (e.target.closest('.remove-btn')) {
                        const btn = e.target.closest('.remove-btn');
                        const productId = parseInt(btn.dataset.id);
                        removeFromCart(productId);
                    }
                    
                    // Checkout button
                    else if (e.target.closest('#checkout-btn')) {
                        processCheckout();
                    }
                    
                    // Clear cart button
                    else if (e.target.closest('#clear-cart-btn')) {
                        clearCart();
                    }
                    
                    return false;
                }
                
                // Allow other navigation links to work normally
                if (e.target.closest('a')) {
                    const link = e.target.closest('a');
                    const href = link.getAttribute('href');
                    if (href && href !== '#') {
                        // Let the browser handle navigation normally
                        return;
                    }
                }
            }, true); // Capture phase
            
            // Prevent form submissions only for cart-related forms
            document.addEventListener('submit', function(e) {
                // Allow logout and other navbar forms to work
                if (e.target.closest('nav') || e.target.method === 'POST') {
                    return; // Let these forms work normally
                }
                
                e.preventDefault();
                e.stopImmediatePropagation();
                return false;
            }, true);
        });
    </script>
</body>
</html>
</html>
