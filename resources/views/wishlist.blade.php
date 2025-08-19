<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris - l3ochaq Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Removed custom mobile navigation styles; navbar component handles all navigation -->
</head>
<body class="bg-gray-50" style="font-family: 'Playfair Display', serif;">
    
    <!-- Navigation -->
    <x-navbar active-page="wishlist" />

    <!-- Page Header -->
    <div class="bg-red-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center">Mes Favoris</h1>
            <p class="text-red-100 text-center mt-2">Vos produits préférés en un seul endroit</p>
        </div>
    </div>

    <!-- Wishlist Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div id="wishlist-container">
            <!-- Wishlist items will be loaded here -->
            <div id="empty-wishlist" class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Aucun produit dans vos favoris</h3>
                <p class="text-gray-600 mb-6">Explorez nos produits et ajoutez ceux que vous aimez à vos favoris</p>
                <a href="/" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    Découvrir les produits
                </a>
            </div>

            <!-- Wishlist Items -->
            <div id="wishlist-items" class="hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Vos produits favoris</h2>
                    <button onclick="clearWishlist()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                        Vider les favoris
                    </button>
                </div>
                
                <div id="items-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Dynamic wishlist items will be inserted here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <script>
        let products = @json($products ?? []);
        console.log(products);
         // Pass products data from controller

        function loadWishlist() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            const wishlistContainer = document.getElementById('wishlist-container');
            const emptyWishlist = document.getElementById('empty-wishlist');
            const wishlistItems = document.getElementById('wishlist-items');
            const itemsGrid = document.getElementById('items-grid');

            if (wishlist.length === 0) {
                emptyWishlist.classList.remove('hidden');
                wishlistItems.classList.add('hidden');
            } else {
                emptyWishlist.classList.add('hidden');
                wishlistItems.classList.remove('hidden');
                
                itemsGrid.innerHTML = '';

                wishlist.forEach(item => {
                    const product = products.find(p => p.id == item.id);
                    if (product) {
                        let imageUrl = 'https://via.placeholder.com/300';
                        if (product.images && product.images.length > 0 && product.images[0].image_path) {
                            imageUrl = '/' + product.images[0].image_path;
                        } else if (product.image) {
                            imageUrl = '/' + product.image;
                        }
                        const wishlistItemHTML = `
                            <div class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="${imageUrl}" alt="${product.name}" class="w-full h-48 object-cover">
                                    <button onclick="removeFromWishlist(${item.id})" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-2">${product.name}</h3>
                                    <p class="text-gray-600 text-sm mb-3">${product.description ? product.description.substring(0, 80) + '...' : ''}</p>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-xl font-bold text-green-600">${product.price} DH</span>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        <button onclick="addToCartFromWishlist(${item.id})" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg transition duration-300">
                                            Ajouter au Panier
                                        </button>
                                        <button onclick="viewProduct(${item.id})" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-3 rounded-lg transition duration-300">
                                            Voir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        itemsGrid.innerHTML += wishlistItemHTML;
                    }
                });
            }
            
            updateCartCount();
                <!-- Removed custom mobile menu script; navbar component handles all navigation -->
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            showNotification('Produit ajouté au panier!', 'success');
        }

        function viewProduct(productId) {
            const product = products.find(p => p.id == productId);
            if (product && product.slug) {
                window.location.href = `/product/${product.slug}`;
            } else {
                window.location.href = `/`;
            }
        }

        // Custom confirmation dialog
        function showConfirmation(message, onConfirm, onCancel = null) {
            // Remove any existing confirmation
            const existingConfirmation = document.querySelector('.custom-confirmation');
            if (existingConfirmation) {
                existingConfirmation.remove();
            }

            // Create overlay
            const overlay = document.createElement('div');
            overlay.className = 'custom-confirmation';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 10000;
                opacity: 0;
                transition: opacity 0.3s ease;
            `;

            // Create confirmation dialog
            const dialog = document.createElement('div');
            dialog.style.cssText = `
                background: white;
                padding: 24px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
                max-width: 400px;
                width: 90%;
                text-align: center;
                transform: scale(0.8);
                transition: transform 0.3s ease;
            `;

            dialog.innerHTML = `
                <div style="margin-bottom: 20px;">
                    <h3 style="margin: 0 0 12px 0; font-size: 18px; font-weight: 600; color: #1f2937;">Confirmation</h3>
                    <p style="margin: 0; color: #6b7280; font-size: 14px;">${message}</p>
                </div>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button class="confirm-btn" style="
                        background: #ef4444;
                        color: white;
                        border: none;
                        padding: 10px 20px;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        font-size: 14px;
                        transition: background 0.2s ease;
                    ">Oui, supprimer</button>
                    <button class="cancel-btn" style="
                        background: #f3f4f6;
                        color: #374151;
                        border: none;
                        padding: 10px 20px;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        font-size: 14px;
                        transition: background 0.2s ease;
                    ">Annuler</button>
                </div>
            `;

            overlay.appendChild(dialog);
            document.body.appendChild(overlay);

            // Add hover effects
            const confirmBtn = dialog.querySelector('.confirm-btn');
            const cancelBtn = dialog.querySelector('.cancel-btn');
            
            confirmBtn.addEventListener('mouseenter', () => confirmBtn.style.background = '#dc2626');
            confirmBtn.addEventListener('mouseleave', () => confirmBtn.style.background = '#ef4444');
            
            cancelBtn.addEventListener('mouseenter', () => cancelBtn.style.background = '#e5e7eb');
            cancelBtn.addEventListener('mouseleave', () => cancelBtn.style.background = '#f3f4f6');

            // Show animation
            setTimeout(() => {
                overlay.style.opacity = '1';
                dialog.style.transform = 'scale(1)';
            }, 10);

            // Add event listeners
            confirmBtn.addEventListener('click', () => {
                overlay.remove();
                if (onConfirm) onConfirm();
            });

            cancelBtn.addEventListener('click', () => {
                overlay.remove();
                if (onCancel) onCancel();
            });

            // Close on overlay click
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    overlay.remove();
                    if (onCancel) onCancel();
                }
            });
        }

        function clearWishlist() {
            showConfirmation(
                'Êtes-vous sûr de vouloir vider vos favoris? Cette action est irréversible.',
                () => {
                    localStorage.removeItem('wishlist');
                    loadWishlist();
                    showNotification('Favoris vidés!', 'warning');
                }
            );
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

        // Load wishlist on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadWishlist();
        });
    </script>
</body>
</html>
</body>
</html>
