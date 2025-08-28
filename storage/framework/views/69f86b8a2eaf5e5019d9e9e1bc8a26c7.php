<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - l3ochaq Store</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logos/faicon.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('images/logos/faicon.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/logos/faicon.png')); ?>">
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
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
    <?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => ['activePage' => 'cart']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active-page' => 'cart']); ?>
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
    <div class="bg-blue-600 text-white py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl lg:text-4xl font-bold text-center">Finaliser votre commande</h1>
            <p class="text-blue-100 text-center mt-2 text-sm lg:text-base">Saisissez vos informations de livraison et de paiement</p>
        </div>
    </div>

    <!-- Checkout Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2 space-y-6 lg:space-y-8 order-1 lg:order-1">
                
                <!-- Billing Information -->
                <div class="checkout-section bg-white rounded-xl shadow-lg p-4 lg:p-6 border border-gray-200">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-900 mb-4 lg:mb-6 flex items-center">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 mr-2 lg:mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informations de facturation
                    </h2>
                    <form id="checkout-form" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">Prénom *</label>
                                <input type="text" id="first_name" name="first_name" required 
                                       class="w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-sm lg:text-base">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                                <input type="text" id="last_name" name="last_name" required 
                                       class="w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-sm lg:text-base">
                            </div>
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Téléphone *</label>
                            <input type="tel" id="phone" name="phone" required 
                                   class="w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-sm lg:text-base">
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Adresse *</label>
                            <input type="text" id="address" name="address" required 
                                   class="w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-sm lg:text-base">
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">Ville *</label>
                            <input type="text" id="city" name="city" required 
                                   class="w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-sm lg:text-base">
                        </div>
                        
                        <div>
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes (optionnel)</label>
                            <textarea id="notes" name="notes" rows="3" 
                                      placeholder="Ajoutez des instructions spéciales pour votre commande..."
                                      class="w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-sm lg:text-base resize-none"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1 order-2 lg:order-2">
                <div class="checkout-section bg-white rounded-xl shadow-lg p-4 lg:p-6 border border-gray-200 lg:sticky lg:top-24">
                    <h3 class="text-lg lg:text-xl font-bold text-gray-900 mb-4 lg:mb-6 flex items-center">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 mr-2 lg:mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Résumé de votre commande
                    </h3>
                    
                    <!-- Items List -->
                    <div id="checkout-items" class="space-y-3 mb-4 lg:mb-6 max-h-48 lg:max-h-60 overflow-y-auto">
                        <!-- Items will be loaded here -->
                    </div>
                    
                    <!-- Order Totals -->
                    <div class="space-y-3 lg:space-y-4 mb-4 lg:mb-6">
                        <div class="flex justify-between items-center py-2 lg:py-3 border-b border-gray-200">
                            <span class="text-gray-700 font-medium text-sm lg:text-base">Sous-total:</span>
                            <span id="checkout-subtotal" class="font-bold text-gray-900 text-sm lg:text-base">0 DH</span>
                        </div>
                        <div class="flex justify-between items-center py-2 lg:py-3 border-b border-gray-200">
                            <span class="text-gray-700 font-medium text-sm lg:text-base">Livraison:</span>
                            <span id="checkout-shipping" class="font-bold text-green-600 text-sm lg:text-base">Gratuite</span>
                        </div>
                        <div class="flex justify-between items-center py-3 lg:py-4 bg-blue-50 rounded-xl px-3 lg:px-4 border-2 border-blue-200">
                            <span class="text-base lg:text-lg font-bold text-gray-900">Total:</span>
                            <span id="checkout-total" class="text-lg lg:text-2xl font-bold text-blue-600">0 DH</span>
                        </div>
                    </div>
                    
                    <!-- Order Button -->
                    <div class="space-y-3">
                        <button type="button" onclick="processOrder()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 lg:py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-sm lg:text-sm">
                            
                            Confirmer la commande
                        </button>
                        <a href="/cart" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 lg:py-3 px-4 rounded-xl transition-all duration-300 hover:shadow-lg text-center block text-sm lg:text-sm">
                            
                            Retour au panier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let products = <?php echo json_encode($products ?? [], 15, 512) ?>; // Pass products data from controller
        let directItem = <?php echo json_encode($directItem ?? null, 15, 512) ?>; // Direct buy now item if available

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
            
            // Use simple solid colors instead of gradients
            const bgColor = type === 'success' ? '#10b981' : 
                           type === 'error' ? '#ef4444' : '#3b82f6';
            
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%) translateY(-100%) scale(0.8);
                z-index: 9999;
                background: ${bgColor};
                color: white;
                padding: 12px 20px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
                display: flex;
                align-items: center;
                gap: 12px;
                max-width: calc(100vw - 40px);
                width: auto;
                min-width: 280px;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                font-family: system-ui, -apple-system, sans-serif;
                font-weight: 600;
                font-size: 14px;
                border: 2px solid rgba(255,255,255,0.2);
                
                @media (min-width: 768px) {
                    top: 20px;
                    right: 20px;
                    left: auto;
                    transform: translateX(100%) scale(0.8);
                    min-width: 320px;
                }
            `;
            
            notification.innerHTML = `
                <span style="font-size: 24px; animation: heartbeat 1s ease-in-out infinite;">•</span>
                <span>${message}</span>
            `;
            
            document.body.appendChild(notification);
            
            // Slide in animation with bounce
            setTimeout(() => {
                if (window.innerWidth >= 768) {
                    notification.style.transform = 'translateX(0) scale(1)';
                } else {
                    notification.style.transform = 'translateX(-50%) translateY(0) scale(1)';
                }
            }, 100);
            
            // Auto remove after 4 seconds with slide out animation
            setTimeout(() => {
                if (window.innerWidth >= 768) {
                    notification.style.transform = 'translateX(100%) scale(0.8)';
                } else {
                    notification.style.transform = 'translateX(-50%) translateY(-100%) scale(0.8)';
                }
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 400);
            }, 4000);
        }

        function loadCheckoutItems() {
            const checkoutItems = document.getElementById('checkout-items');
            let totalPrice = 0;
            checkoutItems.innerHTML = '';

            // Check if we have a direct item (Buy Now)
            if (directItem) {
                // Load single direct item
                const itemHTML = `
                    <div class="flex items-center space-x-2 lg:space-x-3 p-2 lg:p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-lg overflow-hidden bg-white border border-gray-200 flex-shrink-0">
                            <img src="/${directItem.image}" 
                                 alt="${directItem.name}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQ4IiBoZWlnaHQ9IjQ4IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAyMEwyNCAxMkwzMiAyMFYzMkgxNlYyMFoiIGZpbGw9IiM5Q0EzQUYiLz4KPGNpcmNsZSBjeD0iMjAiIGN5PSIxOCIgcj0iMiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'; this.onerror=null;">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 text-xs lg:text-sm truncate">${directItem.name}</h4>
                            ${directItem.custom_name ? `<p class="text-xs text-blue-600 mb-1">✏️ Custom: "${directItem.custom_name}"</p>` : ''}
                            <p class="text-xs text-gray-600">${directItem.price} DH × ${directItem.quantity}</p>
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Achat direct</span>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="font-bold text-blue-600 text-xs lg:text-sm">${directItem.total} DH</span>
                        </div>
                    </div>
                `;
                checkoutItems.innerHTML = itemHTML;
                totalPrice = directItem.total;
            } else {
                // Load from localStorage cart (regular checkout)
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                
                if (cart.length === 0) {
                    // Redirect to cart if empty
                    window.location.href = '/cart';
                    return;
                }

                cart.forEach(item => {
                    const product = products.find(p => p.id == item.id);
                    if (product) {
                        const itemTotal = product.price * item.quantity;
                        totalPrice += itemTotal;

                        const itemHTML = `
                            <div class="flex items-center space-x-2 lg:space-x-3 p-2 lg:p-3 bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-lg overflow-hidden bg-white border border-gray-200 flex-shrink-0">
                                    <img src="/${product.image}" 
                                         alt="${product.name}" 
                                         class="w-full h-full object-cover"
                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQ4IiBoZWlnaHQ9IjQ4IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAyMEwyNCAxMkwzMiAyMFYzMkgxNlYyMFoiIGZpbGw9IiM5Q0EzQUYiLz4KPGNpcmNsZSBjeD0iMjAiIGN5PSIxOCIgcj0iMiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'; this.onerror=null;">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 text-xs lg:text-sm truncate">${product.name}</h4>
                                    <p class="text-xs text-gray-600">${product.price} DH × ${item.quantity}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <span class="font-bold text-blue-600 text-xs lg:text-sm">${itemTotal} DH</span>
                                </div>
                            </div>
                        `;
                        checkoutItems.innerHTML += itemHTML;
                    }
                });
            }

            document.getElementById('checkout-subtotal').textContent = totalPrice + ' DH';
            document.getElementById('checkout-total').textContent = totalPrice + ' DH';
        }

        function validateForm() {
            const form = document.getElementById('checkout-form');
            const inputs = form.querySelectorAll('input[required]');
            
            for (let input of inputs) {
                if (!input.value.trim()) {
                    input.focus();
                    showNotification(`Veuillez remplir le champ: ${input.previousElementSibling.textContent}`, 'error');
                    return false;
                }
            }
            return true;
        }

        function processOrder() {
            if (!validateForm()) {
                return;
            }

            let cartItems = [];
            
            // Check if we have a direct item (Buy Now) or regular cart
            if (directItem) {
                cartItems = [{
                    id: directItem.id,
                    quantity: directItem.quantity,
                    custom_name: directItem.custom_name || null
                }];
            } else {
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                if (cart.length === 0) {
                    showNotification('Votre panier est vide!', 'error');
                    return;
                }
                cartItems = cart.map(item => ({
                    id: item.id,
                    quantity: item.quantity,
                    custom_name: item.custom_name || null
                }));
            }

            // Collect form data
            const formData = new FormData(document.getElementById('checkout-form'));
            const orderData = {
                first_name: formData.get('first_name'),
                last_name: formData.get('last_name'),
                phone: formData.get('phone'),
                address: formData.get('address'),
                city: formData.get('city'),
                notes: formData.get('notes') || '', // Optional notes field
                payment_method: 'cod', // Default payment method
                cart_items: cartItems
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
                    // Clear cart only if it was a regular cart checkout
                    if (!directItem) {
                        localStorage.removeItem('cart');
                    }
                    
                    // Show success message
                    showNotification('Commande confirmée avec succès!', 'success');
                    
                    // Redirect to success page after a delay
                    setTimeout(() => {
                        window.location.href = `/order-success/${data.order_id}`;
                    }, 1500);
                } else {
                    showNotification(data.message || 'Erreur lors du traitement de la commande', 'error');
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Erreur de connexion. Veuillez réessayer.', 'error');
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
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views/checkout.blade.php ENDPATH**/ ?>