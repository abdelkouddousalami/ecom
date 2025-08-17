<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - l3ochaq Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .checkout-section {
            animation: slideInUp 0.4s ease-out forwards;
        }
        
        .checkout-section:nth-child(2) { animation-delay: 0.1s; }
        .checkout-section:nth-child(3) { animation-delay: 0.2s; }
        
        .payment-option {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .payment-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .payment-option.selected {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);
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

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center space-x-2">
                    <!-- Mobile Cart Icon -->
                    <a href="/cart" class="text-gray-700 hover:text-blue-600 relative transition duration-300 p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="cart-count absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 items-center justify-center text-xs font-bold shadow-lg hidden">0</span>
                    </a>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="/" class="text-gray-500 hover:text-blue-600 transition duration-300">Accueil</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="/cart" class="text-gray-500 hover:text-blue-600 transition duration-300">Panier</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600 font-medium">Paiement</span>
            </nav>
        </div>
    </div>

    <!-- Page Header -->
    <div class="bg-blue-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center">Finaliser votre commande</h1>
            <p class="text-blue-100 text-center mt-2">Saisissez vos informations de livraison et de paiement</p>
        </div>
    </div>

    <!-- Checkout Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 gap-8" style="grid-template-columns: 2fr 1fr;">
            <!-- Checkout Form -->
            <div class="space-y-8">
                
                <!-- Billing Information -->
                <div class="checkout-section bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informations de facturation
                    </h2>
                    <form id="checkout-form" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">Prénom *</label>
                                <input type="text" id="first_name" name="first_name" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                                <input type="text" id="last_name" name="last_name" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Téléphone *</label>
                            <input type="tel" id="phone" name="phone" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Adresse *</label>
                            <input type="text" id="address" name="address" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">Ville *</label>
                                <input type="text" id="city" name="city" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                            </div>
                            <div>
                                <label for="postal_code" class="block text-sm font-semibold text-gray-700 mb-2">Code postal *</label>
                                <input type="text" id="postal_code" name="postal_code" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="checkout-section bg-white rounded-xl shadow-lg p-6 border border-gray-200 sticky top-24" style="width: calc(100% + 100px); margin-left: auto;">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Résumé de votre commande
                    </h3>
                    
                    <!-- Items List -->
                    <div id="checkout-items" class="space-y-3 mb-6 max-h-60 overflow-y-auto">
                        <!-- Items will be loaded here -->
                    </div>
                    
                    <!-- Order Totals -->
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-700 font-medium">Sous-total:</span>
                            <span id="checkout-subtotal" class="font-bold text-gray-900">0 DH</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-700 font-medium">Livraison:</span>
                            <span id="checkout-shipping" class="font-bold text-green-600">Gratuite</span>
                        </div>
                        <div class="flex justify-between items-center py-4 bg-blue-50 rounded-xl px-4 border-2 border-blue-200">
                            <span class="text-lg font-bold text-gray-900">Total:</span>
                            <span id="checkout-total" class="text-2xl font-bold text-blue-600">0 DH</span>
                        </div>
                    </div>
                    
                    <!-- Order Button -->
                    <div class="space-y-3">
                        <button type="button" onclick="processOrder()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-sm">
                            
                            Confirmer la commande
                        </button>
                        <a href="/cart" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition-all duration-300 hover:shadow-lg text-center block">
                            
                            Retour au panier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let products = @json($products ?? []); // Pass products data from controller

        // Stylish notification function
        function showNotification(message, type = 'success', icon = '🛒') {
            // Remove any existing notification
            const existingNotification = document.querySelector('.custom-notification');
            if (existingNotification) {
                existingNotification.remove();
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'custom-notification';
            
            // Use simple solid colors instead of gradients
            const bgColor = type === 'success' ? '#10b981' : 
                           type === 'error' ? '#ef4444' : '#3b82f6';
            
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
                <span style="font-size: 24px; animation: heartbeat 1s ease-in-out infinite;">${icon}</span>
                <span>${message}</span>
            `;
            
            document.body.appendChild(notification);
            
            // Slide in animation with bounce
            setTimeout(() => {
                notification.style.transform = 'translateX(0) scale(1)';
            }, 100);
            
            // Auto remove after 4 seconds with slide out animation
            setTimeout(() => {
                notification.style.transform = 'translateX(100%) scale(0.8)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 400);
            }, 4000);
        }

        function loadCheckoutItems() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const checkoutItems = document.getElementById('checkout-items');

            if (cart.length === 0) {
                // Redirect to cart if empty
                window.location.href = '/cart';
                return;
            }

            let totalPrice = 0;
            checkoutItems.innerHTML = '';

            cart.forEach(item => {
                const product = products.find(p => p.id == item.id);
                if (product) {
                    const itemTotal = product.price * item.quantity;
                    totalPrice += itemTotal;

                    const itemHTML = `
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-white border border-gray-200">
                                <img src="/images/products/${product.image}" 
                                     alt="${product.name}" 
                                     class="w-full h-full object-cover"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQ4IiBoZWlnaHQ9IjQ4IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAyMEwyNCAxMkwzMiAyMFYzMkgxNlYyMFoiIGZpbGw9IiM5Q0EzQUYiLz4KPGNpcmNsZSBjeD0iMjAiIGN5PSIxOCIgcj0iMiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'; this.onerror=null;">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 text-sm">${product.name}</h4>
                                <p class="text-xs text-gray-600">${product.price} DH × ${item.quantity}</p>
                            </div>
                            <div class="text-right">
                                <span class="font-bold text-blue-600">${itemTotal} DH</span>
                            </div>
                        </div>
                    `;
                    checkoutItems.innerHTML += itemHTML;
                }
            });

            document.getElementById('checkout-subtotal').textContent = totalPrice + ' DH';
            document.getElementById('checkout-total').textContent = totalPrice + ' DH';
        }

        function validateForm() {
            const form = document.getElementById('checkout-form');
            const inputs = form.querySelectorAll('input[required]');
            
            for (let input of inputs) {
                if (!input.value.trim()) {
                    input.focus();
                    showNotification(`Veuillez remplir le champ: ${input.previousElementSibling.textContent}`, 'error', '⚠️');
                    return false;
                }
                
                if (input.type === 'email' && !input.value.includes('@')) {
                    input.focus();
                    showNotification('Veuillez entrer une adresse email valide', 'error', '⚠️');
                    return false;
                }
            }
            return true;
        }

        function processOrder() {
            if (!validateForm()) {
                return;
            }

            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                showNotification('Votre panier est vide!', 'error', '⚠️');
                return;
            }

            // Collect form data
            const formData = new FormData(document.getElementById('checkout-form'));
            const orderData = {
                first_name: formData.get('first_name'),
                last_name: formData.get('last_name'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                address: formData.get('address'),
                city: formData.get('city'),
                postal_code: formData.get('postal_code'),
                payment_method: 'cod', // Default payment method
                cart_items: cart
            };

            // Show loading state
            const button = event.target;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<svg class="animate-spin w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Traitement...';

            // Send order to server
            fetch('/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(orderData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Clear cart
                    localStorage.removeItem('cart');
                    
                    // Show success message
                    showNotification('🎉 Commande confirmée avec succès!', 'success', '✅');
                    
                    // Redirect to success page after a delay
                    setTimeout(() => {
                        window.location.href = `/order-success/${data.order_id}`;
                    }, 1500);
                } else {
                    showNotification(data.message || 'Erreur lors du traitement de la commande', 'error', '❌');
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Erreur de connexion. Veuillez réessayer.', 'error', '❌');
                button.disabled = false;
                button.innerHTML = originalText;
            });
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

        // Load checkout data on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadCheckoutItems();
            updateCartCount();
        });
    </script>
</body>
</html>
