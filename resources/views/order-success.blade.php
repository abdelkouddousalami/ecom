<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande Confirmée - l3ochaq Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        @keyframes checkmark {
            0% {
                stroke-dashoffset: 50;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
        
        @keyframes scale-up {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
        
        .success-checkmark {
            animation: scale-up 0.5s ease-out forwards;
        }
        
        .success-checkmark svg path {
            stroke-dasharray: 50;
            stroke-dashoffset: 50;
            animation: checkmark 0.5s ease-in-out 0.5s forwards;
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

    <!-- Success Content -->
    <div class="min-h-screen flex items-center justify-center py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Success Icon -->
            <div class="success-checkmark mb-8">
                <div class="w-32 h-32 mx-auto bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Success Message -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Commande confirmée!</h1>
                <p class="text-xl text-gray-600 mb-6">
                    Merci pour votre confiance. Votre commande a été enregistrée avec succès.
                </p>
                
                @if(isset($order))
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                        <h2 class="text-lg font-bold text-blue-900 mb-2">Détails de votre commande</h2>
                        <p class="text-blue-800">
                            <strong>Numéro de commande:</strong> {{ $order->order_number }}<br>
                            <strong>Total:</strong> {{ number_format($order->total, 2) }} DH<br>
                            <strong>Mode de paiement:</strong> {{ $order->getPaymentMethodLabel() }}
                        </p>
                    </div>
                @endif
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-yellow-900 mb-2">Que se passe-t-il maintenant?</h3>
                    <ul class="text-left text-yellow-800 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                            </svg>
                            Un email de confirmation sera envoyé à votre adresse
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                            </svg>
                            Nous préparons votre commande dans les 24-48h
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                            </svg>
                            Vous recevrez un SMS avec les détails de livraison
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <a href="/orders" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg inline-block">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Voir mes commandes
                </a>
                <a href="/products" class="w-full sm:w-auto bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-8 rounded-xl transition-all duration-300 hover:shadow-lg inline-block">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Continuer mes achats
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add confetti or celebration animation here if desired
            console.log('Order success page loaded');
            
            // Optional: Clear any remaining cart data from localStorage
            localStorage.removeItem('cart');
        });
    </script>
</body>
</html>
