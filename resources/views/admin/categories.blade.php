@extends('admin.layout')

@section('title', 'Categories')
@section('header', 'Categories Management')

@section('content')
<!-- Full width container with clean styling -->
<div class="min-h-screen bg-gray-50">
    <!-- Page Header with Statistics -->
    <div class="bg-white shadow-sm border-b border-gray-200 mt-8">
        <div class="max-w-full px-6 sm:px-8 lg:px-12 py-8">
            <!-- Category Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="text-center p-6 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="w-12 h-12 bg-blue-100 border border-blue-200 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-blue-600">{{ count($categories) }}</div>
                    <div class="text-sm text-blue-700 mt-1 font-medium">Total Categories</div>
                </div>
                
                <div class="text-center p-6 bg-green-50 border border-green-200 rounded-lg">
                    <div class="w-12 h-12 bg-green-100 border border-green-200 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-green-600">{{ $categories->sum('products_count') }}</div>
                    <div class="text-sm text-green-700 mt-1 font-medium">Total Products</div>
                </div>
                
                <div class="text-center p-6 bg-purple-50 border border-purple-200 rounded-lg">
                    <div class="w-12 h-12 bg-purple-100 border border-purple-200 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-purple-600">{{ $categories->count() > 0 ? number_format($categories->sum('products_count') / $categories->count(), 1) : 0 }}</div>
                    <div class="text-sm text-purple-700 mt-1 font-medium">Avg Products/Category</div>
                </div>
                
                <div class="text-center p-6 bg-orange-50 border border-orange-200 rounded-lg">
                    <div class="w-12 h-12 bg-orange-100 border border-orange-200 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-orange-600">{{ $categories->where('is_active', true)->count() }}</div>
                    <div class="text-sm text-orange-700 mt-1 font-medium">Active Categories</div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="flex justify-center mb-8">
                <button onclick="scrollToAddForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New Category
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Area - Left: Form, Right: Categories -->
    <div class="max-w-full px-6 sm:px-8 lg:px-12 py-8">
        <div class="flex gap-6">
            
            <!-- Create New Category Form - Left Side (25%) -->
            <div class="w-1/4 flex-shrink-0">
                <div id="add-category-form" class="bg-white shadow-sm rounded-lg border border-gray-200 p-8 sticky top-24">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-blue-100 border border-blue-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 font-playfair">Create New Category</h3>
                        <p class="text-gray-600 text-sm mt-1">Add a new product category to organize your items</p>
                    </div>
                    
                    <form action="{{ route('admin.store-category') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Category Name *</label>
                            <input type="text" name="name" id="name" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors duration-200 font-medium" 
                                placeholder="e.g. Electronics, Fashion, Home & Garden">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors duration-200" 
                                placeholder="Describe what products belong to this category..."></textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_image" class="block text-sm font-semibold text-gray-700 mb-2">Category Image</label>
                            <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors duration-200 bg-gray-50">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="category_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 px-3 py-1 border border-blue-200">
                                            <span>Upload Image</span>
                                            <input id="category_image" name="image" type="file" accept="image/*" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold transition-colors duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories Content - Right Side (75%) -->
            <div class="w-3/4 flex-1">
                <!-- Search and Filter Bar -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <div class="flex flex-col sm:flex-row gap-4 items-center">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="category-search" placeholder="Search categories..." 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors duration-200"
                                onkeyup="searchCategories()">
                        </div>
                        <div class="flex space-x-3">
                            <select class="px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors duration-200">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-lg transition-colors duration-200 border border-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Categories List -->
                <div id="categories-grid" class="space-y-4 mb-8">
                    @foreach($categories as $category)
                    <div class="category-card bg-white rounded-lg shadow-sm hover:shadow-md border border-gray-200 transition-all duration-200 hover:bg-gray-50">
                        <div class="flex items-center p-4 space-x-6">
                            <!-- Category Image -->
                            <div class="flex-shrink-0">
                                <img class="w-16 h-16 rounded-lg object-cover border border-gray-200" 
                                    src="{{ $category->image ? asset('storage/' . $category->image) : 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&h=300&fit=crop' }}" 
                                    alt="{{ $category->name }}">
                            </div>
                            
                            <!-- Category Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h4 class="text-lg font-bold text-gray-900 font-playfair">{{ $category->name }}</h4>
                                        <p class="text-gray-600 text-sm mt-1 truncate">{{ $category->description ?: 'No description available.' }}</p>
                                    </div>
                                    <!-- Status -->
                                    <div class="flex items-center mx-8">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <!-- Action Buttons -->
                                    <div class="flex items-center space-x-2 flex-shrink-0">
                                        <button class="bg-blue-50 hover:bg-blue-100 text-blue-700 hover:text-blue-800 border border-blue-200 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button class="bg-green-50 hover:bg-green-100 text-green-700 hover:text-green-800 border border-green-200 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <button onclick="deleteCategory({{ $category->id }}, '{{ $category->name }}')" class="bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 border border-red-200 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                @if(count($categories) == 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 border border-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 font-playfair">No categories yet</h3>
                    <p class="text-gray-600 mb-6">Get started by creating your first product category.</p>
                    <button onclick="scrollToAddForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                        Create First Category
                    </button>
                </div>
                @endif
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
@endsection
