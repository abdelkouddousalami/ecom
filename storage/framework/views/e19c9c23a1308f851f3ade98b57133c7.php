

<?php $__env->startSection('title', 'Product Details'); ?>
<?php $__env->startSection('header', 'Product Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="px-4 py-6 sm:px-0">
    <!-- Back Button -->
    <div class="mb-6 flex items-center justify-between">
        <a href="<?php echo e(route('admin.products')); ?>" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Products
        </a>
        
        <div class="flex space-x-3">
            <a href="<?php echo e(route('admin.edit-product', $product)); ?>" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Product
            </a>
            
            <a href="<?php echo e(route('product.show', $product->slug)); ?>" target="_blank"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                View on Store
            </a>
        </div>
    </div>

    <!-- Product Details -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900"><?php echo e($product->name); ?></h1>
                    <p class="mt-1 text-sm text-gray-500">Product ID: #<?php echo e($product->id); ?></p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Stock Status -->
                    <?php if($product->stock > 0): ?>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            In Stock (<?php echo e($product->stock); ?> units)
                        </span>
                    <?php else: ?>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            Out of Stock
                        </span>
                    <?php endif; ?>
                    
                    <!-- Featured Badge -->
                    <?php if($product->is_featured): ?>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Featured
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Product Images -->
        <?php if($product->images && $product->images->count() > 0): ?>
        <div class="px-6 py-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Product Images</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <?php $__currentLoopData = $product->images->sortBy('sort_order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative group">
                        <img src="<?php echo e(Storage::url($image->image_path)); ?>" 
                             alt="<?php echo e($product->name); ?>" 
                             class="w-full h-32 object-cover rounded-lg border border-gray-300 cursor-pointer hover:opacity-80 transition-opacity"
                             onclick="openImageModal('<?php echo e(Storage::url($image->image_path)); ?>')">
                        <?php if($image->is_primary): ?>
                            <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Primary</span>
                        <?php endif; ?>
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                            <?php echo e($loop->iteration); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Product Information -->
        <div class="px-6 py-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Category -->
                <div>
                    <dt class="text-sm font-medium text-gray-500">Category</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <?php if($product->category): ?>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                <?php echo e($product->category->name); ?>

                            </span>
                        <?php else: ?>
                            <span class="text-gray-400">No category assigned</span>
                        <?php endif; ?>
                    </dd>
                </div>

                <!-- Price -->
                <div>
                    <dt class="text-sm font-medium text-gray-500">Price</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900">
                        <?php echo e(number_format($product->price)); ?> DH
                        <?php if($product->original_price && $product->original_price > $product->price): ?>
                            <span class="ml-2 text-sm text-gray-500 line-through"><?php echo e(number_format($product->original_price)); ?> DH</span>
                            <span class="ml-1 text-xs bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full">
                                -<?php echo e(round((($product->original_price - $product->price) / $product->original_price) * 100)); ?>%
                            </span>
                        <?php endif; ?>
                    </dd>
                </div>

                <!-- Rating -->
                <div>
                    <dt class="text-sm font-medium text-gray-500">Rating</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <?php if($product->rating): ?>
                            <div class="flex items-center">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <svg class="w-4 h-4 <?php echo e($i <= floor($product->rating) ? 'text-yellow-400' : 'text-gray-300'); ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                <?php endfor; ?>
                                <span class="ml-2 font-medium"><?php echo e($product->rating); ?></span>
                                <span class="ml-1 text-gray-500">(<?php echo e($product->review_count); ?> <?php echo e($product->review_count == 1 ? 'review' : 'reviews'); ?>)</span>
                            </div>
                        <?php else: ?>
                            <span class="text-gray-400">No rating yet</span>
                        <?php endif; ?>
                    </dd>
                </div>

                <!-- Stock -->
                <div>
                    <dt class="text-sm font-medium text-gray-500">Stock Quantity</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo e($product->stock); ?> units</dd>
                </div>

                <!-- Created Date -->
                <div>
                    <dt class="text-sm font-medium text-gray-500">Created</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo e($product->created_at->format('M d, Y \a\t h:i A')); ?></dd>
                </div>

                <!-- Last Updated -->
                <div>
                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo e($product->updated_at->format('M d, Y \a\t h:i A')); ?></dd>
                </div>
            </dl>

            <!-- Description -->
            <div class="mt-8">
                <dt class="text-sm font-medium text-gray-500">Description</dt>
                <dd class="mt-2 text-sm text-gray-900 bg-gray-50 p-4 rounded-lg"><?php echo e($product->description); ?></dd>
            </div>

            <!-- Tags -->
            <?php if($product->tags): ?>
            <div class="mt-6">
                <dt class="text-sm font-medium text-gray-500">Tags</dt>
                <dd class="mt-2">
                    <?php $__currentLoopData = explode(',', $product->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="inline-block mr-2 mb-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            <?php echo e(trim($tag)); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </dd>
            </div>
            <?php endif; ?>

            <!-- Specifications -->
            <?php if($product->specifications): ?>
            <div class="mt-6">
                <dt class="text-sm font-medium text-gray-500">Specifications</dt>
                <dd class="mt-2 text-sm text-gray-900 bg-gray-50 p-4 rounded-lg whitespace-pre-line"><?php echo e($product->specifications); ?></dd>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 items-center justify-center p-4" onclick="closeImageModal()">
    <div class="max-w-4xl max-h-full">
        <img id="modalImage" src="" alt="Product Image" class="max-w-full max-h-full object-contain rounded-lg">
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    document.getElementById('modalImage').src = imageSrc;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\show-product.blade.php ENDPATH**/ ?>