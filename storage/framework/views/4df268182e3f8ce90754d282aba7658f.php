

<?php $__env->startSection('title', 'Users Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2 font-playfair">
                        Users Management
                    </h1>
                    <p class="text-gray-600 text-lg">Manage user accounts and roles</p>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <?php if(session('success')): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?php echo e(session('error')); ?>

                </div>
            </div>
        <?php endif; ?>

        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">All Users</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-gray-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?php echo e($user->name); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo e($user->email); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                        $roleClasses = [
                                            'user' => 'bg-blue-100 text-blue-800',
                                            'admin' => 'bg-red-100 text-red-800',
                                            'super_admin' => 'bg-purple-100 text-purple-800'
                                        ];
                                    ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo e($roleClasses[$user->role] ?? 'bg-gray-100 text-gray-800'); ?>">
                                        <?php if($user->role === 'super_admin'): ?>
                                            <i class="fas fa-crown mr-1"></i>
                                        <?php endif; ?>
                                        <?php echo e($user->role === 'super_admin' ? 'Super Admin' : ucfirst($user->role)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo e($user->created_at->format('M d, Y')); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <?php if($user->role !== 'super_admin'): ?>
                                            <!-- Role Update Form - Available for both admins and super admins (except for super admin accounts) -->
                                            <form method="POST" action="<?php echo e(route('admin.users.update-role', $user)); ?>" class="inline-block">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <select name="role" onchange="this.form.submit()" class="text-xs border border-gray-300 rounded px-2 py-1 <?php echo e($user->id === Auth::id() ? 'opacity-50 cursor-not-allowed' : ''); ?>" <?php echo e($user->id === Auth::id() ? 'disabled' : ''); ?>>
                                                    <option value="user" <?php echo e($user->role === 'user' ? 'selected' : ''); ?>>User</option>
                                                    <option value="admin" <?php echo e($user->role === 'admin' ? 'selected' : ''); ?>>Admin</option>
                                                </select>
                                            </form>

                                            <!-- Delete Button - Available for both admins and super admins -->
                                            <?php if($user->id !== Auth::id()): ?>
                                                <form method="POST" action="<?php echo e(route('admin.users.delete', $user)); ?>" 
                                                      onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')" 
                                                      class="inline-block">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-red-600 hover:text-red-900 transition duration-200">
                                                        <i class="fas fa-trash text-sm"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-gray-400" title="Cannot delete your own account">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <!-- Super Admin accounts are protected and only visible to other super admins -->
                                            <span class="text-gray-400 text-xs">
                                                <i class="fas fa-ghost mr-1"></i>
                                                Ghost Mode
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No users found
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($users->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200">
                    <?php echo e($users->links()); ?>

                </div>
            <?php endif; ?>
        </div>

        <!-- User Statistics -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo e($stats['total_users']); ?></p>
                    </div>
                </div>
            </div>

            <?php if(Auth::user()->canSeeSuperAdmins()): ?>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-full">
                            <i class="fas fa-crown text-purple-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Super Admins</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo e($stats['super_admin_users']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-full">
                        <i class="fas fa-user-shield text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Admins</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo e($stats['admin_users']); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-user text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Regular Users</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo e($stats['regular_users']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views/admin/users.blade.php ENDPATH**/ ?>