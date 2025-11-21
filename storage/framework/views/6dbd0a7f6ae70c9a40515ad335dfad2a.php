<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - l3ochaq Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    
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
                                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
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

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\orders-simple.blade.php ENDPATH**/ ?>