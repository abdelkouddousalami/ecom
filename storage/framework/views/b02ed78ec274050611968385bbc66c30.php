<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - l3ochaq Store</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50" style="font-family: 'Playfair Display', serif;">
    
    <!-- Navigation -->
    <?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => ['activePage' => 'orders']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active-page' => 'orders']); ?>
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
    <div class="bg-blue-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center">Mes Commandes</h1>
            <p class="text-blue-100 text-center mt-2">Suivez l'état de vos commandes</p>
        </div>
    </div>

    <!-- Orders Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php if($orders->isEmpty()): ?>
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Aucune commande</h3>
                <p class="text-gray-600 mb-6">Vous n'avez pas encore passé de commandes</p>
                <a href="/products" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    Commencer à acheter
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900"><?php echo e($order->order_number); ?></h3>
                                <p class="text-gray-600">Commande passée le <?php echo e($order->created_at->format('d/m/Y à H:i')); ?></p>
                            </div>
                            <div class="flex items-center space-x-4 mt-4 lg:mt-0">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    <?php if($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                    <?php elseif($order->status === 'confirmed'): ?> bg-blue-100 text-blue-800
                                    <?php elseif($order->status === 'processing'): ?> bg-purple-100 text-purple-800
                                    <?php elseif($order->status === 'shipped'): ?> bg-indigo-100 text-indigo-800
                                    <?php elseif($order->status === 'delivered'): ?> bg-green-100 text-green-800
                                    <?php else: ?> bg-red-100 text-red-800
                                    <?php endif; ?>">
                                    <?php echo e($order->getStatusLabel()); ?>

                                </span>
                                <span class="text-xl font-bold text-blue-600"><?php echo e(number_format($order->total, 2)); ?> DH</span>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Livraison à:</p>
                                    <p class="text-gray-600"><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></p>
                                    <p class="text-gray-600"><?php echo e($order->address); ?></p>
                                    <p class="text-gray-600"><?php echo e($order->city); ?> <?php echo e($order->postal_code); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Contact:</p>
                                    <p class="text-gray-600"><?php echo e($order->email); ?></p>
                                    <p class="text-gray-600"><?php echo e($order->phone); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Mode de paiement:</p>
                                    <p class="text-gray-600"><?php echo e($order->getPaymentMethodLabel()); ?></p>
                                </div>
                            </div>
                            
                            <div class="border-t pt-4">
                                <h4 class="font-semibold text-gray-900 mb-3">Articles commandés:</h4>
                                <div class="space-y-2">
                                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-white border">
                                                    <img src="<?php echo e(Storage::url($item->product->image)); ?>" 
                                                         alt="<?php echo e($item->product->name); ?>" 
                                                         class="w-full h-full object-cover"
                                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0yMS4zMzMzIDIxLjMzMzNIMjMuOTk5OUMyNC4zNjgzIDIxLjMzMzMgMjQuNzIxIDIxLjMzMzMgMjUuMDU3NiAyMS4zNTU5QzI1LjcxMTUgMjEuMzk5OSAyNi4zMjI1IDIxLjY0NTIgMjYuNzkwMiAyMi4wNzEzTDQyLjY2NjYgMzcuOTk5OVY0OEMzMS40NjY2IDQ4IDE5LjMzMzMgNDggMTYgNDhWMjYuNjY2NkMxNiAyNC45MjI5IDE2IDI0LjA1MTMgMTYuMzk4MSAyMy4zNTE5QzE2LjUwMTEgMjMuMTUxNyAxNi42Mjg0IDIyLjk2MyAxNi43Nzc4IDIyLjc4ODlMMTYuODg4OSAyMi42NjY2QzE3LjU4NDcgMjEuOTcwNyAxOC42OTAzIDIxLjMzMzMgMjEuMzMzMyAyMS4zMzMzWiIgZmlsbD0iIzlDQTNBRiIvPgo8Y2lyY2xlIGN4PSIyNiIgY3k9IjI5LjMzMzMiIHI9IjMuOTk5OSIgZmlsbD0iI0Q5RDlEOSIvPgo8L3N2Zz4K'">
                                                </div>
                                                <div>
                                                    <h5 class="font-semibold text-gray-900"><?php echo e($item->product->name); ?></h5>
                                                    <p class="text-gray-600"><?php echo e(number_format($item->price, 2)); ?> DH × <?php echo e($item->quantity); ?></p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-green-600"><?php echo e(number_format($item->total, 2)); ?> DH</p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <!-- Pagination -->
            <?php if($orders->hasPages()): ?>
                <div class="mt-8">
                    <?php echo e($orders->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

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
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\orders-test.blade.php ENDPATH**/ ?>