<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Profile - <?php echo e(config('app.name')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Alpine.js for interactive components -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="<?php echo e(url('/')); ?>" class="text-xl font-bold text-gray-900">
                        <i class="fas fa-store mr-2"></i>
                        Your Store
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, <?php echo e(Auth::user()->name); ?>!</span>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg">
            <!-- Profile Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-user-circle mr-2"></i>
                    My Profile
                </h1>
            </div>

            <!-- Profile Content -->
            <div class="p-6">
                <!-- Success/Error Messages -->
                <?php if(session('success')): ?>
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Profile Information -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-info-circle mr-2"></i>
                            Profile Information
                        </h2>
                        
                        <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            
                            <div class="space-y-4">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Full Name
                                    </label>
                                    <input type="text" name="name" id="name" value="<?php echo e(old('name', Auth::user()->name)); ?>" required
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email Address
                                    </label>
                                    <input type="email" name="email" id="email" value="<?php echo e(old('email', Auth::user()->email)); ?>" required
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Member Since -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Member Since
                                    </label>
                                    <p class="mt-1 text-sm text-gray-600">
                                        <?php echo e(Auth::user()->created_at->format('F j, Y')); ?>

                                    </p>
                                </div>

                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    <i class="fas fa-save mr-2"></i>
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-lock mr-2"></i>
                            Change Password
                        </h2>
                        
                        <form method="POST" action="<?php echo e(route('profile.password')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            
                            <div class="space-y-4">
                                <!-- Current Password -->
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">
                                        Current Password
                                    </label>
                                    <input type="password" name="current_password" id="current_password" required
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        New Password
                                    </label>
                                    <input type="password" name="password" id="password" required
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Confirm New Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                        Confirm New Password
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    <i class="fas fa-key mr-2"></i>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Account Statistics -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Account Statistics
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Total Orders -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-shopping-bag text-blue-600 text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-blue-600">Total Orders</p>
                                    <p class="text-2xl font-bold text-blue-900">
                                        <?php echo e(\App\Models\Order::where('user_id', Auth::id())->count()); ?>

                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Spent -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-dollar-sign text-green-600 text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-green-600">Total Spent</p>
                                    <p class="text-2xl font-bold text-green-900">
                                        $<?php echo e(number_format(\App\Models\Order::where('user_id', Auth::id())->sum('total'), 2)); ?>

                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist Items -->
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-heart text-purple-600 text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-purple-600">Wishlist Items</p>
                                    <p class="text-2xl font-bold text-purple-900">
                                        <?php echo e(\App\Models\Wishlist::where('user_id', Auth::id())->count()); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-bolt mr-2"></i>
                        Quick Actions
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="<?php echo e(route('orders.index')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200">
                            <i class="fas fa-list-ul mr-2"></i>
                            View Orders
                        </a>
                        
                        <a href="<?php echo e(route('wishlist.view')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200">
                            <i class="fas fa-heart mr-2"></i>
                            View Wishlist
                        </a>
                        
                        <a href="<?php echo e(route('cart.view')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            View Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\auth\profile.blade.php ENDPATH**/ ?>