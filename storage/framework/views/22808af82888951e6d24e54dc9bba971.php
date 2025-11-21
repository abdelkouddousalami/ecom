

<?php $__env->startSection('title', 'Edit Product'); ?>
<?php $__env->startSection('header', 'Edit Product'); ?>

<?php
use Illuminate\Support\Facades\Storage;
?>

<?php $__env->startSection('content'); ?>
<div class="px-4 py-6 sm:px-0">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="<?php echo e(route('admin.products')); ?>" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Products
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white shadow rounded-lg">
        <form action="<?php echo e(route('admin.update-product-form', $product)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6 p-6" id="product-update-form" data-no-ajax="true">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="form_submission" value="1">
            <input type="hidden" name="_no_ajax" value="true">
            
            <!-- Basic Information -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Basic Information</h3>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name *</label>
                        <input type="text" name="name" id="name" value="<?php echo e(old('name', $product->name)); ?>" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category *</label>
                        <select name="category_id" id="category_id" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Select a category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                    <textarea name="description" id="description" rows="4" 
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required><?php echo e(old('description', $product->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Pricing & Stock -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Pricing & Stock</h3>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price (DH) *</label>
                        <input type="number" step="0.01" name="price" id="price" value="<?php echo e(old('price', $product->price)); ?>" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Original Price -->
                    <div>
                        <label for="original_price" class="block text-sm font-medium text-gray-700">Original Price (DH)</label>
                        <input type="number" step="0.01" name="original_price" id="original_price" value="<?php echo e(old('original_price', $product->original_price)); ?>" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <?php $__errorArgs = ['original_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity *</label>
                        <input type="number" name="stock" id="stock" value="<?php echo e(old('stock', $product->stock)); ?>" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Current Images -->
            <div class="pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Product Images</h3>
                
                <?php if($product->images && $product->images->count() > 0): ?>
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-700 mb-4">Current Images (<?php echo e($product->images->count()); ?>)</h4>
                        
                        <!-- Styled image grid without backgrounds -->
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative border border-gray-300 rounded-lg overflow-hidden hover:shadow-md transition-shadow" style="background: white;">
                                    <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="w-full h-32 object-cover"
                                         style="background: white;"
                                         onload="//('✅ Image loaded:', this.src);"
                                         onerror="//('❌ Image failed:', this.src); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    
                                    <!-- Fallback for failed images - NO BLACK -->
                                    <div class="w-full h-32 flex items-center justify-center text-gray-500 text-sm border border-gray-300" style="display: none; background: white;">
                                        <div class="text-center">
                                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="text-xs text-gray-500">Image not found</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Always visible action buttons at bottom -->
                                    <div class="absolute bottom-2 left-2 right-2">
                                        <div class="flex space-x-2 justify-center">
                                            <?php
                                                $isPrimary = $image->is_primary || $product->image === $image->image_path;
                                            ?>
                                            <?php if($isPrimary): ?>
                                                <span class="text-green-600 text-xs px-3 py-1 rounded border border-green-600 font-medium" style="background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">✓ Primary</span>
                                            <?php else: ?>
                                                <button type="button" onclick="setPrimaryImage(<?php echo e($image->id); ?>)" 
                                                        class="text-blue-600 hover:text-blue-800 text-xs px-3 py-1 rounded border border-blue-600 hover:border-blue-800 transition-colors font-medium" 
                                                        style="background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    Set Primary
                                                </button>
                                            <?php endif; ?>
                                            <button type="button" onclick="removeImage(<?php echo e($image->id); ?>)" 
                                                    class="text-red-600 hover:text-red-800 text-xs px-3 py-1 rounded border border-red-600 hover:border-red-800 transition-colors font-medium" 
                                                    style="background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                ✕ Remove
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Image ID badge - WHITE BACKGROUND -->
                                    <div class="absolute top-2 right-2">
                                        <span class="text-gray-600 text-xs px-2 py-1 rounded border border-gray-400" style="background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">#<?php echo e($image->id); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">No images uploaded yet</p>
                            <p class="text-xs text-gray-500">Add some images below</p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Add New Images -->
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Images
                    </h4>
                    <div class="space-y-3">
                        <div>
                            <label for="new_images" class="block text-sm font-medium text-gray-700">Select Images to Add</label>
                            <input type="file" name="new_images[]" id="new_images" multiple accept="image/*,.svg" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <p class="mt-1 text-xs text-gray-500">Add new images without removing existing ones. Max 10 images total, automatically compressed.</p>
                            <p class="text-xs text-green-600 mt-1">✅ Supported formats: JPEG, PNG, GIF, WebP, BMP, TIFF, SVG. Images should be at least 100x100 pixels.</p>
                        </div>
                        
                        <!-- Image preview area -->
                        <div id="image-preview" class="hidden">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <div id="preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-2"></div>
                        </div>
                    </div>
                    
                    <?php $__errorArgs = ['new_images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Additional Information</h3>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Rating -->
                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating (0-5)</label>
                        <input type="number" step="0.1" min="0" max="5" name="rating" id="rating" value="<?php echo e(old('rating', $product->rating)); ?>" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Review Count -->
                    <div>
                        <label for="review_count" class="block text-sm font-medium text-gray-700">Review Count</label>
                        <input type="number" min="0" name="review_count" id="review_count" value="<?php echo e(old('review_count', $product->review_count)); ?>" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <?php $__errorArgs = ['review_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Tags -->
                <div class="mt-6">
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" name="tags" id="tags" value="<?php echo e(old('tags', $product->tags)); ?>" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                           placeholder="e.g., premium, luxury, bestseller">
                    <p class="mt-1 text-xs text-gray-500">Separate tags with commas</p>
                </div>

                <!-- Specifications -->
                <div class="mt-6">
                    <label for="specifications" class="block text-sm font-medium text-gray-700">Specifications</label>
                    <textarea name="specifications" id="specifications" rows="3" 
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                              placeholder="Technical specifications, materials, dimensions, etc."><?php echo e(old('specifications', $product->specifications)); ?></textarea>
                </div>

                <!-- Featured -->
                <div class="mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" id="featured" value="1" 
                               <?php echo e(old('featured', $product->is_featured) ? 'checked' : ''); ?>

                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="featured" class="ml-2 block text-sm text-gray-700">Featured Product</label>
                    </div>
                </div>

                <!-- Customizable -->
                <div class="mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="customizable" id="customizable" value="1" 
                               <?php echo e(old('customizable', $product->is_customizable) ? 'checked' : ''); ?>

                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="customizable" class="ml-2 block text-sm text-gray-700">Customizable Product</label>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Allow customers to add custom names or text to this product</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <a href="<?php echo e(route('admin.products')); ?>" 
                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Force normal form submission - prevent any AJAX interception
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('product-update-form');
    if (form) {
        // Override any existing event handlers
        form.onsubmit = null;
        
        // Remove any AJAX headers or behavior
        form.addEventListener('submit', function(e) {
            // Remove any headers that might cause JSON response
            const originalAction = this.action;
            
            // Ensure this submits as HTML form
            this.setAttribute('data-ajax', 'false');
            this.removeAttribute('data-remote');
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Updating Product...
                `;
            }
            
            // Let the browser handle this as a normal form submission
            return true;
        }, false);
    }
});

// Image Management Functions - these use AJAX
function removeImage(imageId) {
    if (confirm('Are you sure you want to remove this image?')) {
        fetch('/admin/products/images/' + imageId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error removing image: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing image. Please try again.');
        });
    }
}

function setPrimaryImage(imageId) {
    fetch('/admin/products/images/' + imageId + '/set-primary', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error setting primary image: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error setting primary image. Please try again.');
    });
}

// Image Preview Function
document.addEventListener('DOMContentLoaded', function() {
    const newImagesInput = document.getElementById('new_images');
    if (newImagesInput) {
        newImagesInput.addEventListener('change', function(e) {
            const files = e.target.files;
            const previewContainer = document.getElementById('preview-container');
            const previewSection = document.getElementById('image-preview');
            
            previewContainer.innerHTML = '';
            
            if (files.length > 0) {
                previewSection.classList.remove('hidden');
                
                const currentImageCount = parseInt('<?php echo e($product->images->count()); ?>');
                if (currentImageCount + files.length > 10) {
                    alert('You can only have 10 images total. You currently have ' + currentImageCount + ' images. Please select ' + (10 - currentImageCount) + ' or fewer new images.');
                    e.target.value = '';
                    previewSection.classList.add('hidden');
                    return;
                }
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-20 object-cover rounded border border-gray-300">
                            <div class="absolute top-1 right-1">
                                <button type="button" onclick="removePreview(this)" class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">×</button>
                            </div>
                        `;
                        previewContainer.appendChild(div);
                    };
                    
                    reader.readAsDataURL(file);
                }
            } else {
                previewSection.classList.add('hidden');
            }
        });
    }
});

function removePreview(button) {
    const previewDiv = button.closest('.relative');
    previewDiv.remove();
    
    const previewContainer = document.getElementById('preview-container');
    if (previewContainer.children.length === 0) {
        document.getElementById('image-preview').classList.add('hidden');
        document.getElementById('new_images').value = '';
    }
}

// Image management functions
function removeImage(imageId) {
    if (confirm('Are you sure you want to remove this image?')) {
        fetch(`/admin/products/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the image element from the page
                const imageContainer = document.querySelector(`[data-image-id="${imageId}"]`) || 
                                     document.querySelector(`button[onclick="removeImage(${imageId})"]`).closest('.relative');
                if (imageContainer) {
                    imageContainer.remove();
                }
                
                // Show success message
                showMessage(data.message, 'success');
            } else {
                showMessage(data.message || 'Failed to remove image', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Failed to remove image', 'error');
        });
    }
}

function setPrimaryImage(imageId) {
    fetch(`/admin/products/images/${imageId}/set-primary`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page to update primary image badges
            window.location.reload();
        } else {
            showMessage(data.message || 'Failed to set primary image', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Failed to set primary image', 'error');
    });
}

function showMessage(message, type) {
    // Create a simple notification
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\edit-product.blade.php ENDPATH**/ ?>