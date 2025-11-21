

<?php $__env->startSection('title', 'Edit Category'); ?>
<?php $__env->startSection('header', 'Edit Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="<?php echo e(route('admin.categories')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-900 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Categories
            </a>
        </div>

        <!-- Edit Category Form -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-blue-100 border border-blue-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 font-playfair">Edit Category</h3>
                <p class="text-gray-600 text-sm mt-1">Update category information</p>
            </div>
            
            <form action="<?php echo e(route('admin.update-category', $category)); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Category Name *</label>
                    <input type="text" name="name" id="name" required 
                        value="<?php echo e(old('name', $category->name)); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors duration-200 font-medium" 
                        placeholder="e.g. Electronics, Fashion, Home & Garden">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors duration-200" 
                        placeholder="Describe what products belong to this category..."><?php echo e(old('description', $category->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                        <?php echo e(old('is_active', $category->is_active) ? 'checked' : ''); ?>

                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                        Active Category (visible to customers)
                    </label>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Category
                        </button>
                        <a href="<?php echo e(route('admin.categories')); ?>" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 hover:text-gray-900 font-semibold py-3 px-6 rounded-lg transition-colors duration-200 text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Category Information -->
        <div class="mt-6 bg-white shadow-sm rounded-lg border border-gray-200 p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Category Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="font-medium text-gray-500">Current Slug:</span>
                    <span class="ml-2 text-gray-900"><?php echo e($category->slug); ?></span>
                </div>
                <div>
                    <span class="font-medium text-gray-500">Status:</span>
                    <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?php echo e($category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                        <?php echo e($category->is_active ? 'Active' : 'Inactive'); ?>

                    </span>
                </div>
                <div>
                    <span class="font-medium text-gray-500">Products Count:</span>
                    <span class="ml-2 text-gray-900"><?php echo e($category->products->count() ?? 0); ?></span>
                </div>
                <div>
                    <span class="font-medium text-gray-500">Created:</span>
                    <span class="ml-2 text-gray-900"><?php echo e($category->created_at->format('M d, Y')); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\edit-category.blade.php ENDPATH**/ ?>