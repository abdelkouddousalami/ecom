

<?php $__env->startSection('title', 'Categories'); ?>
<?php $__env->startSection('header', 'Categories Management'); ?>

<?php $__env->startSection('content'); ?>
<!-- Enhanced styling with modern design -->
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .stats-card {
        background: linear-gradient(135deg, var(--from-color) 0%, var(--to-color) 100%);
        border: none;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .category-image {
        transition: all 0.3s ease;
    }
    
    .category-card:hover .category-image {
        transform: scale(1.05);
    }
    
    .action-btn {
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .action-btn:hover::before {
        left: 100%;
    }
    
    .floating-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4);
        z-index: 1000;
        transition: all 0.3s ease;
    }
    
    .floating-btn:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 12px 40px rgba(102, 126, 234, 0.6);
    }
</style>

<!-- Full width container with enhanced styling -->
<div class="min-h-screen bg-gray-50">
    <!-- Enhanced Header -->
    <div class="bg-white border-b border-gray-200 shadow-lg">
        <div class="max-w-full px-6 sm:px-8 lg:px-12 py-12">
            <!-- Page Title -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">
                    <i class="fas fa-tags mr-3 text-blue-600"></i>Categories Management
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Organize your products with beautiful, functional categories
                </p>
            </div>
            
            <!-- Enhanced Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="stats-card text-center p-8 rounded-2xl bg-blue-50 border border-blue-200 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 text-blue-600"><?php echo e(count($categories)); ?></div>
                    <div class="text-gray-600 font-medium">Total Categories</div>
                </div>
                
                <div class="stats-card text-center p-8 rounded-2xl bg-green-50 border border-green-200 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 text-green-600"><?php echo e($categories->sum('products_count')); ?></div>
                    <div class="text-gray-600 font-medium">Total Products</div>
                </div>
                
                <div class="stats-card text-center p-8 rounded-2xl bg-yellow-50 border border-yellow-200 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 text-yellow-600"><?php echo e($categories->count() > 0 ? number_format($categories->sum('products_count') / $categories->count(), 1) : 0); ?></div>
                    <div class="text-gray-600 font-medium">Avg Products/Category</div>
                </div>
                
                <div class="stats-card text-center p-8 rounded-2xl bg-green-50 border border-green-200 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 text-green-600"><?php echo e($categories->where('is_active', true)->count()); ?></div>
                    <div class="text-gray-600 font-medium">Active Categories</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Main Content Area -->
    <div class="max-w-full px-6 sm:px-8 lg:px-12 py-12">
        <div class="flex gap-8">
            
            <!-- Enhanced Create Form - Left Side -->
            <div class="w-1/3 flex-shrink-0">
                <div id="add-category-form" class="bg-white rounded-2xl p-8 sticky top-24 shadow-lg border border-gray-200">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-md">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Create New Category</h3>
                        <p class="text-gray-600">Organize your products beautifully</p>
                    </div>
                    
                    <form action="<?php echo e(route('admin.store-category')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-bold text-gray-700">Category Name *</label>
                            <input type="text" name="name" id="name" required 
                                class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 font-medium bg-white" 
                                placeholder="e.g. Electronics, Fashion, Home & Garden">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-bold text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" 
                                class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 bg-white resize-none" 
                                placeholder="Describe what products belong to this category..."></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="space-y-2">
                            <label for="category_image" class="block text-sm font-bold text-gray-700">Category Image</label>
                            <div class="relative group">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-500 transition-all duration-300 bg-gray-50 group-hover:bg-blue-50">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition-colors duration-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <div class="mt-4">
                                        <label for="category_image" class="cursor-pointer bg-blue-600 text-white px-6 py-3 rounded-xl font-medium hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                            <span>Choose Image</span>
                                            <input id="category_image" name="image" type="file" accept="image/*" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
                            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 px-6 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Enhanced Categories Content - Right Side -->
            <div class="w-2/3 flex-1">
                <!-- Enhanced Search Bar -->
                <div class="bg-white rounded-2xl p-6 mb-8 shadow-lg border border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 items-center">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="category-search" placeholder="Search categories..." 
                                class="block w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 bg-white font-medium"
                                onkeyup="searchCategories()">
                        </div>
                        <div class="flex space-x-3">
                            <select class="px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 bg-white font-medium">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <button class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Categories Grid -->
                <div id="categories-grid" class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="category-card bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 group">
                        <div class="flex items-start justify-between mb-6">
                            <!-- Category Image & Info -->
                            <div class="flex items-center space-x-4">
                                <div class="relative group-hover:scale-105 transition-transform duration-300">
                                    <img class="w-16 h-16 rounded-xl object-cover shadow-md" 
                                        src="<?php echo e($category->image ? Storage::url($category->image) : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&h=300&fit=crop'); ?>" 
                                        alt="<?php echo e($category->name); ?>">
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1"><?php echo e($category->name); ?></h3>
                                    <p class="text-gray-600 text-sm"><?php echo e(Str::limit($category->description ?: 'No description available.', 60)); ?></p>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="text-xs text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            <?php echo e($category->products->count() ?? 0); ?> products
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            Created <?php echo e($category->created_at->diffForHumans()); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex flex-col items-end space-y-3">
                                <button onclick="toggleCategoryStatus(<?php echo e($category->id); ?>)" 
                                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 shadow-md hover:shadow-lg
                                        <?php echo e($category->is_active ? 'bg-green-100 text-green-800 border border-green-200 hover:bg-green-200' : 'bg-red-100 text-red-800 border border-red-200 hover:bg-red-200'); ?>">
                                    <div class="w-2 h-2 rounded-full mr-2 <?php echo e($category->is_active ? 'bg-green-500' : 'bg-red-500'); ?>"></div>
                                    <?php echo e($category->is_active ? 'Active' : 'Inactive'); ?>

                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3 pt-4 border-t border-gray-200">
                            <button onclick="viewCategory(<?php echo e($category->id); ?>, '<?php echo e(addslashes($category->name)); ?>', '<?php echo e(addslashes($category->description ?: 'No description available.')); ?>', <?php echo e($category->is_active ? 'true' : 'false'); ?>, <?php echo e($category->products->count() ?? 0); ?>)" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View
                            </button>
                            
                            <a href="<?php echo e(route('admin.edit-category', $category)); ?>" 
                                class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-black py-3 px-4 rounded-xl font-medium transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>

                            <form action="<?php echo e(route('admin.delete-category', $category->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl p-16 text-center shadow-lg border border-gray-200">
                            <div class="w-24 h-24 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-gray-200">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">No Categories Found</h3>
                            <p class="text-gray-600 text-lg mb-8">Create your first category to organize your products efficiently.</p>
                            <button onclick="document.getElementById('name').focus()" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create First Category
                            </button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Enhanced Pagination -->
                <div class="flex justify-center mt-8">
                    <?php echo e($categories->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Smooth scroll to add category form
function scrollToAddForm() {
    document.getElementById('add-category-form').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Category search functionality
function searchCategories() {
    const searchTerm = document.getElementById('category-search').value.toLowerCase();
    const categoryCards = document.querySelectorAll('.category-card');
    
    categoryCards.forEach(card => {
        const categoryName = card.querySelector('h4').textContent.toLowerCase();
        const categoryDescription = card.querySelector('p').textContent.toLowerCase();
        
        if (categoryName.includes(searchTerm) || categoryDescription.includes(searchTerm)) {
            card.style.display = '';
            card.classList.remove('hidden');
        } else {
            card.style.display = 'none';
            card.classList.add('hidden');
        }
    });
}

// Delete category confirmation
function deleteCategory(categoryId, categoryName) {
    if (confirm(`Are you sure you want to delete "${categoryName}" category? This action cannot be undone.`)) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/categories/${categoryId}`;
        
        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '_token';
        csrfField.value = csrfToken;
        form.appendChild(csrfField);
        
        // Add method override for DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        // Append form to body and submit
        document.body.appendChild(form);
        form.submit();
    }
}

// Category image preview functionality
document.getElementById('category_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Remove existing preview if any
            const existingPreview = document.getElementById('category-image-preview');
            if (existingPreview) {
                existingPreview.remove();
            }
            
            // Create new preview
            const preview = document.createElement('div');
            preview.id = 'category-image-preview';
            preview.className = 'mt-4 text-center';
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview" class="mx-auto h-32 w-32 object-cover rounded-lg border-2 border-gray-200 shadow-lg">
                <p class="text-sm text-gray-600 mt-2 font-medium">Image Preview</p>
            `;
            
            // Insert preview after the file input
            const fileInputContainer = document.querySelector('input[name="image"]').closest('div').parentNode;
            fileInputContainer.appendChild(preview);
        };
        reader.readAsDataURL(file);
    }
});

// Add animation on scroll for category cards
function animateOnScroll() {
    const categoryCards = document.querySelectorAll('.category-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';
                entry.target.style.transition = 'all 0.6s ease-out';
                
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 100);
                
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    categoryCards.forEach(card => {
        observer.observe(card);
    });
}

// Toggle category status
function toggleCategoryStatus(categoryId) {
    fetch(`/admin/categories/${categoryId}/toggle-status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Find the status button and update it
            const statusButton = document.querySelector(`button[onclick="toggleCategoryStatus(${categoryId})"]`);
            if (statusButton) {
                statusButton.textContent = data.is_active ? 'Active' : 'Inactive';
                statusButton.className = `inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors duration-200 hover:shadow-md ${
                    data.is_active 
                        ? 'bg-green-100 text-green-800 border border-green-200 hover:bg-green-200' 
                        : 'bg-red-100 text-red-800 border border-red-200 hover:bg-red-200'
                }`;
            }
            
            // Show success message
            showNotification(data.message, 'success');
        } else {
            showNotification('Error updating category status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error updating category status', 'error');
    });
}

// Simple notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-4 py-2 rounded-lg text-white z-50 ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// View category details - compact and wide design
function viewCategory(categoryId, categoryName, categoryDescription, isActive, productsCount) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto';
    modal.id = 'category-modal';
    
    modal.innerHTML = `
        <div class="bg-white rounded-lg max-w-2xl w-full mx-auto shadow-lg">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-blue-50 rounded-t-lg">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">${categoryName}</h3>
                        <p class="text-gray-600 text-xs">Category Details</p>
                    </div>
                </div>
                <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Content -->
            <div class="p-4">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Left Column - Stats -->
                    <div>
                        <div class="grid grid-cols-3 gap-2 mb-4">
                            <div class="text-center p-2 bg-blue-50 rounded border text-xs">
                                <div class="text-lg font-bold text-blue-600">${productsCount}</div>
                                <div class="text-gray-600">Products</div>
                            </div>
                            <div class="text-center p-2 ${isActive ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200'} rounded border text-xs">
                                <div class="text-lg font-bold ${isActive ? 'text-green-600' : 'text-red-600'}">${isActive ? '✓' : '✗'}</div>
                                <div class="text-gray-600">${isActive ? 'Active' : 'Inactive'}</div>
                            </div>
                            <div class="text-center p-2 bg-gray-50 rounded border text-xs">
                                <div class="text-lg font-bold text-gray-600">#${categoryId}</div>
                                <div class="text-gray-600">ID</div>
                            </div>
                        </div>
                        
                        <!-- Category Info -->
                        <div class="bg-blue-50 rounded p-3 border border-blue-200">
                            <h4 class="font-medium text-gray-900 mb-2 text-sm flex items-center">
                                <svg class="w-4 h-4 text-blue-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Information
                            </h4>
                            <div class="space-y-1 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Name:</span>
                                    <span class="font-medium text-gray-900">${categoryName}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Products:</span>
                                    <span class="font-medium text-gray-900">${productsCount} items</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                                        <div class="w-1 h-1 rounded-full mr-1 ${isActive ? 'bg-green-500' : 'bg-red-500'}"></div>
                                        ${isActive ? 'Active' : 'Inactive'}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <div class="bg-gray-50 rounded p-3 border h-32 overflow-y-auto">
                            <p class="text-gray-700 text-sm">${categoryDescription || 'No description available for this category.'}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex space-x-2 p-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                <a href="/admin/categories/${categoryId}/edit" class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-black py-2 px-3 rounded font-medium transition-colors duration-200 text-center flex items-center justify-center text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <button onclick="closeCategoryModal()" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-2 px-3 rounded font-medium transition-colors duration-200 flex items-center justify-center text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Close
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeCategoryModal();
        }
    });
}

function closeCategoryModal() {
    const modal = document.getElementById('category-modal');
    if (modal) {
        modal.remove();
    }
}

// Initialize animations when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    animateOnScroll();
    
    // Add hover effects to buttons
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-1px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\categories.blade.php ENDPATH**/ ?>