@extends('admin.layout')

@section('title', 'Add Product')
@section('header', 'Add New Product')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="max-w-4xl mx-auto">
        <form id="productForm" action="{{ route('admin.store-product') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <!-- Basic Information -->
            <div class="bg-white shadow px-6 py-6 sm:rounded-lg">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Basic Information</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name *</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter product name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category *</label>
                            <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                        <textarea name="description" id="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter detailed product description"></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="bg-white shadow px-6 py-6 sm:rounded-lg">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Pricing</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Current Price (DH) *</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" name="price" id="price" step="0.01" min="0" required class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0.00">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 sm:text-sm">DH</span>
                                </div>
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="original_price" class="block text-sm font-medium text-gray-700">Original Price (DH)</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" name="original_price" id="original_price" step="0.01" min="0" class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0.00">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 sm:text-sm">DH</span>
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Leave empty if no discount</p>
                            @error('original_price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity *</label>
                            <input type="number" name="stock" id="stock" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Images -->
            <div class="bg-white shadow px-6 py-6 sm:rounded-lg">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Product Images</h3>
                        <p class="text-sm text-gray-600 mb-4">Upload multiple images for your product. The first image will be set as primary.</p>
                    </div>
                    
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700">Product Images</label>
                        <div class="mt-1">
                            <div id="image-upload-area" class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-400 transition-colors cursor-pointer">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload multiple files</span>
                                            <input id="images" name="images[]" type="file" accept="image/jpeg,image/jpg,image/png,image/gif,image/svg+xml" multiple class="sr-only" onchange="previewImages(this)">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">Upload images (any size - automatically compressed, Max 10 images) - Optional</p>
                                    <p class="text-xs text-gray-400 mt-1">Supported formats: JPEG, PNG, GIF, SVG (JPEG will be converted to PNG automatically)</p>
                                    <p class="text-xs text-green-600 mt-1">✅ Images should be at least 100x100 pixels for best quality</p>
                                </div>
                            </div>
                            
                            <!-- Images Preview Grid -->
                            <div id="images-preview-container" class="mt-4 hidden">
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="images-preview-grid">
                                    <!-- Preview images will be inserted here -->
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="flex items-center space-x-4">
                                        <p class="text-sm text-gray-600">Drag images to reorder them. First image will be the primary image.</p>
                                        <button type="button" onclick="addMoreImages()" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium underline">Add More Images</button>
                                    </div>
                                    <button type="button" onclick="clearAllImages()" class="text-red-600 hover:text-red-800 text-sm font-medium">Clear All</button>
                                </div>
                                <!-- Hidden input for adding more images -->
                                <input type="file" id="additional-images" accept="image/jpeg,image/jpg,image/png,image/gif,image/svg+xml" multiple class="hidden" onchange="addAdditionalImages(this)">
                            </div>
                        </div>
                        @error('images')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Additional Details -->
            <div class="bg-white shadow px-6 py-6 sm:rounded-lg">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Additional Details</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700">Initial Rating</label>
                            <select name="rating" id="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">No Rating</option>
                                <option value="5">5 Stars</option>
                                <option value="4.5">4.5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3.5">3.5 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2.5">2.5 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1.5">1.5 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="review_count" class="block text-sm font-medium text-gray-700">Number of Reviews</label>
                            <input type="number" name="review_count" id="review_count" min="0" value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0">
                            <p class="mt-1 text-sm text-gray-500">How many users rated this product</p>
                            @error('review_count')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="featured" class="block text-sm font-medium text-gray-700">Featured Product</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="featured" id="featured" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">Mark as featured product</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Customization Section -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="customizable" class="block text-sm font-medium text-gray-700">Product Customization</label>
                                <div class="mt-2">
                                    <select name="customizable" id="customizable" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" onchange="updateCustomizableStatus()">
                                        <option value="0" selected>No - Standard product (no customization)</option>
                                        <option value="1">Yes - Allow customers to customize this product</option>
                                    </select>
                                    <div id="customizable-status" class="mt-1 text-sm font-semibold"></div>
                                    <p class="mt-1 text-sm text-gray-500">When enabled, customers can add custom names or text to this product (up to 50 characters)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                        <input type="text" name="tags" id="tags" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="luxury, gold, jewelry (comma separated)">
                        <p class="mt-1 text-sm text-gray-500">Enter tags separated by commas</p>
                    </div>

                    <div>
                        <label for="specifications" class="block text-sm font-medium text-gray-700">Specifications</label>
                        <textarea name="specifications" id="specifications" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Material: 18k Gold&#10;Weight: 15g&#10;Size: Adjustable"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Enter product specifications (one per line)</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.products') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Global variables for multiple images
let selectedFiles = [];
let draggedIndex = null;

// Enhanced multiple image preview functionality
function previewImages(input) {
    console.log('previewImages called with:', input.files.length, 'files');
    const newFiles = Array.from(input.files);
    
    // Add new files to existing selectedFiles array
    selectedFiles = selectedFiles.concat(newFiles);
    console.log('Total selected files:', selectedFiles.length);
    
    // Check file count limit
    if (selectedFiles.length > 10) {
        alert('Maximum 10 images allowed. Keeping first 10 images.');
        selectedFiles = selectedFiles.slice(0, 10);
    }
    
    // Validate each new file
    for (let file of newFiles) {
        // No file size limit - images will be automatically compressed
        // Just check file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml'];
        if (!allowedTypes.includes(file.type)) {
            alert(`File "${file.name}" is not a supported image format. Please use JPEG, PNG, GIF, or SVG images.`);
            selectedFiles = selectedFiles.filter(f => f !== file);
            continue;
        }
        
        if (!file.type.match('image.*')) {
            alert(`File "${file.name}" is not a valid image. Please select only image files.`);
            // Remove the problematic file
            selectedFiles = selectedFiles.filter(f => f !== file);
            continue;
        }

        // Check image dimensions using FileReader (skip for SVG files)
        if (file.type !== 'image/svg+xml') {
            const checkDimensions = (file) => {
                return new Promise((resolve) => {
                    const img = new Image();
                    img.onload = function() {
                        const width = this.width;
                        const height = this.height;
                        
                        if (width < 100 || height < 100) {
                            alert(`Image "${file.name}" is too small. Minimum size is 100x100 pixels.`);
                            selectedFiles = selectedFiles.filter(f => f !== file);
                        } else if (width > 5000 || height > 5000) {
                            alert(`Image "${file.name}" is too large. Maximum size is 5000x5000 pixels.`);
                            selectedFiles = selectedFiles.filter(f => f !== file);
                        }
                        resolve();
                    };
                    img.src = URL.createObjectURL(file);
                });
            };
            
            // Check dimensions asynchronously
            checkDimensions(file);
        }
    }
    
    updateFileInput();
    displayImagePreviews();
}

// Display image previews in grid
function displayImagePreviews() {
    const container = document.getElementById('images-preview-container');
    const grid = document.getElementById('images-preview-grid');
    
    if (selectedFiles.length === 0) {
        container.classList.add('hidden');
        document.getElementById('image-upload-area').classList.remove('hidden');
        return;
    }
    
    container.classList.remove('hidden');
    document.getElementById('image-upload-area').classList.add('hidden');
    grid.innerHTML = '';
    
    // Add image count indicator
    const countIndicator = document.createElement('div');
    countIndicator.className = 'col-span-full mb-2 text-sm text-gray-600 font-medium';
    countIndicator.innerHTML = `${selectedFiles.length} image${selectedFiles.length !== 1 ? 's' : ''} selected (${10 - selectedFiles.length} remaining)`;
    grid.appendChild(countIndicator);
    
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageContainer = document.createElement('div');
            imageContainer.className = 'relative group cursor-move';
            imageContainer.draggable = true;
            imageContainer.dataset.index = index;
            
            imageContainer.innerHTML = `
                <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-300 group-hover:border-indigo-400 transition-colors">
                <button type="button" onclick="removeImage(${index})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors opacity-0 group-hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                ${index === 0 ? '<div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Primary</div>' : ''}
                <div class="absolute bottom-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">${index + 1}</div>
            `;
            
            // Add drag and drop event listeners
            imageContainer.addEventListener('dragstart', handleDragStart);
            imageContainer.addEventListener('dragover', handleDragOver);
            imageContainer.addEventListener('drop', handleDrop);
            imageContainer.addEventListener('dragend', handleDragEnd);
            
            grid.appendChild(imageContainer);
        };
        reader.readAsDataURL(file);
    });
}

// Remove single image
function removeImage(index) {
    selectedFiles.splice(index, 1);
    updateFileInput();
    displayImagePreviews();
}

// Clear all images
function clearAllImages() {
    selectedFiles = [];
    document.getElementById('images').value = '';
    document.getElementById('additional-images').value = '';
    displayImagePreviews();
}

// Add more images function
function addMoreImages() {
    if (selectedFiles.length >= 10) {
        alert('Maximum 10 images allowed');
        return;
    }
    document.getElementById('additional-images').click();
}

// Handle additional images
function addAdditionalImages(input) {
    const newFiles = Array.from(input.files);
    
    // Add new files to existing selectedFiles array
    selectedFiles = selectedFiles.concat(newFiles);
    
    // Check file count limit
    if (selectedFiles.length > 10) {
        alert('Maximum 10 images allowed. Keeping first 10 images.');
        selectedFiles = selectedFiles.slice(0, 10);
    }
    
    // Validate each new file
    for (let file of newFiles) {
        // No file size limit - images will be automatically compressed
        // Just check file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml'];
        if (!allowedTypes.includes(file.type)) {
            alert(`File "${file.name}" is not a supported image format. Please use JPEG, PNG, GIF, or SVG images.`);
            selectedFiles = selectedFiles.filter(f => f !== file);
            continue;
        }
        
        if (!file.type.match('image.*')) {
            alert(`File "${file.name}" is not a valid image. Please select only image files.`);
            selectedFiles = selectedFiles.filter(f => f !== file);
            continue;
        }
    }
    
    // Clear the additional input
    input.value = '';
    
    updateFileInput();
    displayImagePreviews();
}

// Update file input with current selected files
function updateFileInput() {
    const input = document.getElementById('images');
    
    try {
        const dt = new DataTransfer();
        
        selectedFiles.forEach(file => {
            dt.items.add(file);
        });
        
        input.files = dt.files;
        console.log('Updated file input:', input.files.length, 'files');
    } catch (error) {
        console.error('Error updating file input:', error);
        // Fallback: we'll handle this differently in form submission
    }
}

// Drag and drop functionality for reordering
function handleDragStart(e) {
    draggedIndex = parseInt(e.target.closest('[data-index]').dataset.index);
    e.target.closest('[data-index]').style.opacity = '0.5';
}

function handleDragOver(e) {
    e.preventDefault();
}

function handleDrop(e) {
    e.preventDefault();
    const dropIndex = parseInt(e.target.closest('[data-index]').dataset.index);
    
    if (draggedIndex !== null && draggedIndex !== dropIndex) {
        // Reorder the files array
        const draggedFile = selectedFiles[draggedIndex];
        selectedFiles.splice(draggedIndex, 1);
        selectedFiles.splice(dropIndex, 0, draggedFile);
        
        updateFileInput();
        displayImagePreviews();
    }
}

function handleDragEnd(e) {
    e.target.closest('[data-index]').style.opacity = '1';
    draggedIndex = null;
}

// Setup drag and drop for upload area
document.addEventListener('DOMContentLoaded', function() {
    const imageUploadArea = document.getElementById('image-upload-area');
    const imageInput = document.getElementById('images');

    if (imageUploadArea && imageInput) {
        imageUploadArea.addEventListener('click', function() {
            imageInput.click();
        });

        imageUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.add('border-indigo-500', 'bg-indigo-50');
        });

        imageUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('border-indigo-500', 'bg-indigo-50');
        });

        imageUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('border-indigo-500', 'bg-indigo-50');
            
            const files = Array.from(e.dataTransfer.files);
            if (files.length > 0) {
                // Add files to existing selection
                selectedFiles = selectedFiles.concat(files);
                
                // Check file count limit
                if (selectedFiles.length > 10) {
                    alert('Maximum 10 images allowed. Keeping first 10 images.');
                    selectedFiles = selectedFiles.slice(0, 10);
                }
                
                updateFileInput();
                displayImagePreviews();
            }
        });
    }

    // Auto-calculate discount percentage
    const originalPriceInput = document.getElementById('original_price');
    if (originalPriceInput) {
        originalPriceInput.addEventListener('input', function() {
            const originalPrice = parseFloat(this.value);
            const currentPrice = parseFloat(document.getElementById('price').value);
            
            if (originalPrice && currentPrice && originalPrice > currentPrice) {
                const discount = ((originalPrice - currentPrice) / originalPrice * 100).toFixed(0);
                
                // Show discount percentage
                let discountInfo = document.getElementById('discount-info');
                if (!discountInfo) {
                    discountInfo = document.createElement('p');
                    discountInfo.id = 'discount-info';
                    discountInfo.className = 'mt-1 text-sm text-green-600 font-medium';
                    this.parentNode.parentNode.appendChild(discountInfo);
                }
                discountInfo.innerHTML = `<span class="inline-flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>${discount}% discount</span>`;
            } else {
                const discountInfo = document.getElementById('discount-info');
                if (discountInfo) {
                    discountInfo.remove();
                }
            }
        });
    }

    // Rating and review count interaction
    const ratingSelect = document.getElementById('rating');
    if (ratingSelect) {
        ratingSelect.addEventListener('change', function() {
            const rating = this.value;
            const reviewCountInput = document.getElementById('review_count');
            
            if (rating && reviewCountInput.value === '0') {
                // Suggest a reasonable review count based on rating
                let suggestedCount;
                if (rating >= 4.5) suggestedCount = Math.floor(Math.random() * 50) + 20; // 20-70 reviews
                else if (rating >= 4) suggestedCount = Math.floor(Math.random() * 30) + 15; // 15-45 reviews  
                else if (rating >= 3) suggestedCount = Math.floor(Math.random() * 20) + 10; // 10-30 reviews
                else suggestedCount = Math.floor(Math.random() * 15) + 5; // 5-20 reviews
                
                // Show suggestion
                let ratingInfo = document.getElementById('rating-suggestion');
                if (!ratingInfo) {
                    ratingInfo = document.createElement('p');
                    ratingInfo.id = 'rating-suggestion';
                    ratingInfo.className = 'mt-1 text-sm text-blue-600 cursor-pointer hover:text-blue-800';
                    reviewCountInput.parentNode.appendChild(ratingInfo);
                }
                ratingInfo.innerHTML = `💡 Suggestion: <span onclick="setReviewCount(${suggestedCount})" class="underline">${suggestedCount} reviews</span> for ${rating} star rating`;
            } else if (!rating) {
                const ratingInfo = document.getElementById('rating-suggestion');
                if (ratingInfo) ratingInfo.remove();
            }
        });
    }
});

// Function to set suggested review count
function setReviewCount(count) {
    document.getElementById('review_count').value = count;
    const ratingInfo = document.getElementById('rating-suggestion');
    if (ratingInfo) ratingInfo.remove();
}

// Update customizable status display
function updateCustomizableStatus() {
    const select = document.getElementById('customizable');
    const status = document.getElementById('customizable-status');
    if (select && status) {
        if (select.value === '1') {
            status.textContent = '✅ CUSTOMIZABLE - Customers can add custom text';
            status.className = 'mt-1 text-sm font-semibold text-green-600';
        } else {
            status.textContent = '❌ NOT CUSTOMIZABLE - Standard product';
            status.className = 'mt-1 text-sm font-semibold text-red-600';
        }
        console.log('Customizable select changed to:', select.value);
    }
}

// Initialize status on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCustomizableStatus();
});

// Simple form submission handler
document.querySelector('form').addEventListener('submit', function(e) {
    // Debug: Check select status before submission
    const customizableSelect = document.getElementById('customizable');
    console.log('Form submitting - customizable select value:', customizableSelect ? customizableSelect.value : 'not found');
    console.log('Will be customizable:', customizableSelect && customizableSelect.value === '1');
    
    // Show alert to confirm what's being submitted
    if (customizableSelect) {
        if (customizableSelect.value === '1') {
            console.log('🟢 SUBMITTING AS CUSTOMIZABLE');
        } else {
            console.log('🔴 SUBMITTING AS NOT CUSTOMIZABLE');
        }
    }
    
    // Update file input before submission
    if (selectedFiles.length > 0) {
        updateFileInput();
    }
    
    // Show loading state
    const submitButton = document.querySelector('button[type="submit"]');
    if (submitButton) {
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;
        submitButton.disabled = true;
    }
    
    // Allow normal form submission
});
</script>
@endsection
