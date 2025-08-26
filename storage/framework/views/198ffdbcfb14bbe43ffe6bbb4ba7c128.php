<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Numbers Management - Admin Dashboard</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        /* Modern Card Styles */
        .modern-card { 
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Stat Cards */
        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
            border-radius: 16px 16px 0 0;
        }
        
        .stat-card.total::before { background: linear-gradient(90deg, #3b82f6, #6366f1); }
        .stat-card.orders::before { background: linear-gradient(90deg, #10b981, #059669); }
        .stat-card.manual::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
        .stat-card.active::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Button Styles */
        .btn-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            padding: 14px 28px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }
        
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-modern:hover::before {
            left: 100%;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }
        
        .btn-collect {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
        
        .btn-collect:hover {
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
        }
        
        .btn-export {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }
        
        .btn-export:hover {
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.6);
        }
        
        .btn-add {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }
        
        .btn-add:hover {
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.6);
        }
        
        /* Table Styles */
        .modern-table {
            border-radius: 16px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .table-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }
        
        .table-row {
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .table-row:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
            transform: scale(1.005);
        }
        
        /* Status Badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-order {
            background: linear-gradient(135deg, #dcfdf7 0%, #a7f3d0 100%);
            color: #065f46;
        }
        
        .status-manual {
            background: linear-gradient(135deg, #dbeafe 0%, #a5b4fc 100%);
            color: #1e40af;
        }
        
        .status-active {
            background: linear-gradient(135deg, #dcfdf7 0%, #a7f3d0 100%);
            color: #065f46;
        }
        
        .status-inactive {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: #991b1b;
        }
        
        /* Modal Styles */
        .modal-backdrop {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
        }
        
        .modal-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px 24px 0 0;
        }
        
        /* Form Styles */
        .form-input {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
        
        .form-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: rgba(255, 255, 255, 0.95);
        }
        
        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-up {
            animation: slideUp 0.3s ease-out;
        }
        
        @keyframes slideUp {
            from { transform: translateY(100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        /* Icon Styles */
        .icon-wrapper {
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
            border-radius: 16px;
            padding: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* Search and Filter Styles */
        .search-wrapper {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 4px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        /* Responsive Improvements */
        @media (max-width: 768px) {
            .stat-card:hover {
                transform: none;
            }
            
            .modern-card:hover {
                transform: none;
            }
            
            .table-row:hover {
                transform: none;
            }
        }
        
        /* Loading States */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        /* Success Animation */
        .success-notification {
            animation: slideInRight 0.3s ease-out;
        }
        
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    
    <!-- Navigation -->
    <?php if (isset($component)) { $__componentOriginal06600c18cadf0581659ec97dd74972b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal06600c18cadf0581659ec97dd74972b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-navbar','data' => ['activePage' => 'phone-numbers']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active-page' => 'phone-numbers']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal06600c18cadf0581659ec97dd74972b4)): ?>
<?php $attributes = $__attributesOriginal06600c18cadf0581659ec97dd74972b4; ?>
<?php unset($__attributesOriginal06600c18cadf0581659ec97dd74972b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal06600c18cadf0581659ec97dd74972b4)): ?>
<?php $component = $__componentOriginal06600c18cadf0581659ec97dd74972b4; ?>
<?php unset($__componentOriginal06600c18cadf0581659ec97dd74972b4); ?>
<?php endif; ?>

    <!-- Main Content -->
    <div class="min-h-screen pt-8 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Enhanced Header Section -->
            <div class="fade-in mb-12">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="p-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                                Phone Numbers Management
                            </h1>
                        </div>
                        <p class="text-gray-600 text-lg">Manage and analyze your customer contact database</p>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo e(route('admin.collect-from-orders')); ?>" 
                           class="btn-modern btn-collect text-center inline-flex items-center justify-center space-x-2 no-underline">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Collect from Orders</span>
                        </a>
                        
                        <a href="<?php echo e(route('admin.export.phone-numbers')); ?>" 
                           class="btn-modern btn-export text-center inline-flex items-center justify-center space-x-2 no-underline">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Export PDF</span>
                        </a>
                        
                        <button onclick="openAddModal()" 
                                class="btn-modern btn-add inline-flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Add Manually</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Enhanced Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 fade-in">
                <div class="stat-card total p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Numbers</p>
                            <p class="text-3xl font-bold text-gray-900"><?php echo e(number_format($stats['total'])); ?></p>
                            <p class="text-xs text-gray-500 mt-1">All collected numbers</p>
                        </div>
                        <div class="icon-wrapper" style="--bg-start: #dbeafe; --bg-end: #bfdbfe;">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card orders p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">From Orders</p>
                            <p class="text-3xl font-bold text-gray-900"><?php echo e(number_format($stats['from_orders'])); ?></p>
                            <p class="text-xs text-gray-500 mt-1">Auto-collected</p>
                        </div>
                        <div class="icon-wrapper" style="--bg-start: #dcfce7; --bg-end: #bbf7d0;">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card manual p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Manual Entry</p>
                            <p class="text-3xl font-bold text-gray-900"><?php echo e(number_format($stats['manual'])); ?></p>
                            <p class="text-xs text-gray-500 mt-1">Added manually</p>
                        </div>
                        <div class="icon-wrapper" style="--bg-start: #e0e7ff; --bg-end: #c7d2fe;">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card active p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Active Numbers</p>
                            <p class="text-3xl font-bold text-gray-900"><?php echo e(number_format($stats['active'])); ?></p>
                            <p class="text-xs text-gray-500 mt-1">Currently active</p>
                        </div>
                        <div class="icon-wrapper" style="--bg-start: #fef3c7; --bg-end: #fde68a;">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Enhanced Data Table -->
            <div class="modern-table fade-in">
                <!-- Search and Filter Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Phone Numbers Database</h2>
                            <p class="text-gray-600 mt-1">Manage your customer contact information</p>
                        </div>
                        
                        <!-- Search Bar -->
                        <div class="search-wrapper max-w-sm w-full" x-data="{ search: '' }">
                            <div class="relative">
                                <input type="text" 
                                       x-model="search"
                                       placeholder="Search numbers, names..." 
                                       class="w-full pl-10 pr-4 py-3 border-0 bg-transparent focus:outline-none">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="table-header">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact Info</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Phone Number</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">Address</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Source</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">Date Added</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php $__empty_1 = true; $__currentLoopData = $phoneNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phoneNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="table-row">
                                <!-- Contact Info -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-4">
                                            <?php echo e(strtoupper(substr($phoneNumber->name ?: 'U', 0, 1))); ?>

                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo e($phoneNumber->name ?: 'Unknown Contact'); ?>

                                            </div>
                                            <?php if($phoneNumber->notes): ?>
                                            <div class="text-xs text-gray-500"><?php echo e(Str::limit($phoneNumber->notes, 30)); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Phone Number -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-mono font-medium text-gray-900 bg-gray-50 px-3 py-1 rounded-lg">
                                        <?php echo e($phoneNumber->phone); ?>

                                    </div>
                                </td>
                                
                                <!-- Address -->
                                <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                    <div class="text-sm text-gray-600">
                                        <?php echo e($phoneNumber->address ? Str::limit($phoneNumber->address, 30) : 'No address'); ?>

                                    </div>
                                </td>
                                
                                <!-- Source -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge status-<?php echo e($phoneNumber->source === 'order' ? 'order' : 'manual'); ?>">
                                        <?php echo e(ucfirst($phoneNumber->source)); ?>

                                    </span>
                                </td>
                                
                                <!-- Date Added -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">
                                    <?php echo e($phoneNumber->collected_at ? $phoneNumber->collected_at->format('M j, Y') : $phoneNumber->created_at->format('M j, Y')); ?>

                                </td>
                                
                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge status-<?php echo e($phoneNumber->is_active ? 'active' : 'inactive'); ?>">
                                        <?php echo e($phoneNumber->is_active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <button class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-200"
                                                onclick="editPhoneNumber(<?php echo e($phoneNumber->id); ?>)">
                                            Edit
                                        </button>
                                        <form action="<?php echo e(route('admin.delete-phone-number', $phoneNumber)); ?>" method="POST" class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this phone number?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition-colors duration-200">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-24 h-24 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center mb-6">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No phone numbers found</h3>
                                        <p class="text-gray-600 mb-6">Start collecting phone numbers to build your customer database</p>
                                        <button onclick="openAddModal()" class="btn-modern btn-add inline-flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            <span>Add First Number</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <?php if($phoneNumbers->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <?php echo e($phoneNumbers->firstItem()); ?> to <?php echo e($phoneNumbers->lastItem()); ?> of <?php echo e($phoneNumbers->total()); ?> results
                        </div>
                        <div class="pagination-wrapper">
                            <?php echo e($phoneNumbers->links()); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Enhanced Add Phone Number Modal -->
    <div id="addModal" class="fixed inset-0 modal-backdrop z-50 hidden" x-data="{ loading: false }">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="modal-content max-w-lg w-full slide-up">
                <!-- Modal Header -->
                <div class="modal-header p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-white">Add New Contact</h2>
                            <p class="text-blue-100 mt-1">Add a customer phone number to your database</p>
                        </div>
                        <button onclick="closeAddModal()" class="text-white hover:text-gray-200 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form action="<?php echo e(route('admin.store-phone-number')); ?>" method="POST" class="p-8" x-on:submit="loading = true">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Contact Name</label>
                            <input type="text" id="name" name="name" 
                                   class="form-input w-full"
                                   placeholder="Enter contact name (optional)">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required
                                   class="form-input w-full"
                                   placeholder="e.g., +212612345678">
                            <p class="text-xs text-gray-500 mt-1">Format will be automatically adjusted</p>
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                            <input type="text" id="address" name="address"
                                   class="form-input w-full"
                                   placeholder="Customer address (optional)">
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                            <textarea id="notes" name="notes" rows="3"
                                      class="form-input w-full resize-none"
                                      placeholder="Add any notes about this contact..."></textarea>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex gap-4 mt-8">
                        <button type="button" onclick="closeAddModal()" 
                                class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-xl font-semibold hover:bg-gray-200 transition duration-300">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="flex-1 btn-modern relative overflow-hidden"
                                x-bind:disabled="loading">
                            <span x-show="!loading" class="inline-flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span>Add Contact</span>
                            </span>
                            <span x-show="loading" class="inline-flex items-center justify-center space-x-2">
                                <svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                <span>Adding...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Modal Management
        function openAddModal() {
            const modal = document.getElementById('addModal');
            const body = document.body;
            
            modal.classList.remove('hidden');
            body.classList.add('overflow-hidden');
            
            // Focus on first input
            setTimeout(() => {
                document.getElementById('name').focus();
            }, 100);
        }

        function closeAddModal() {
            const modal = document.getElementById('addModal');
            const body = document.body;
            const form = modal.querySelector('form');
            
            modal.classList.add('hidden');
            body.classList.remove('overflow-hidden');
            
            // Reset form
            form.reset();
        }

        // Enhanced phone number formatting
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            // Handle Moroccan numbers
            if (value.startsWith('0')) {
                value = '212' + value.substring(1);
            } else if (!value.startsWith('212') && value.length > 0) {
                value = '212' + value;
            }
            
            // Limit length
            if (value.length > 12) {
                value = value.substring(0, 12);
            }
            
            // Format with country code
            if (value.length > 0) {
                e.target.value = '+' + value;
            }
        });

        // Close modal on outside click
        document.getElementById('addModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddModal();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAddModal();
            }
        });

        // Edit phone number function
        function editPhoneNumber(id) {
            // Implement edit functionality
            //('Edit phone number:', id);
        }

        // Enhanced animations
        document.addEventListener('DOMContentLoaded', function() {
            // Stagger animation for stat cards
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in');
            });

            // Table row animations
            const tableRows = document.querySelectorAll('.table-row');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('fade-in');
            });
        });
    </script>

    <!-- Success/Error Notifications -->
    <?php if(session('success')): ?>
    <div class="fixed top-4 right-4 z-50 success-notification">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl max-w-sm">
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">Success!</p>
                    <p class="text-sm text-green-100"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const notification = document.querySelector('.success-notification');
            if (notification) {
                notification.style.transform = 'translateX(100%)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }
        }, 4000);
    </script>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="fixed top-4 right-4 z-50 success-notification">
        <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-xl shadow-2xl max-w-sm">
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">Error!</p>
                    <p class="text-sm text-red-100"><?php echo e(session('error')); ?></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const notification = document.querySelector('.success-notification');
            if (notification) {
                notification.style.transform = 'translateX(100%)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }
        }, 4000);
    </script>
    <?php endif; ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views/admin/phone-numbers.blade.php ENDPATH**/ ?>