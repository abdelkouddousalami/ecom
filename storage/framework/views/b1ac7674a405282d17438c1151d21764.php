<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Complete Data Export</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #3B82F6;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #1E40AF;
            font-size: 32px;
        }
        .header p {
            margin: 5px 0;
            color: #6B7280;
        }
        .section {
            margin-bottom: 40px;
            page-break-inside: avoid;
        }
        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #1E40AF;
            margin-bottom: 15px;
            border-bottom: 2px solid #E5E7EB;
            padding-bottom: 5px;
        }
        .stats-grid {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            background: #F3F4F6;
            padding: 20px;
            border-radius: 8px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #1E40AF;
        }
        .stat-label {
            font-size: 12px;
            color: #6B7280;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }
        th, td {
            border: 1px solid #E5E7EB;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #F9FAFB;
            font-weight: bold;
            color: #374151;
        }
        tr:nth-child(even) {
            background-color: #F9FAFB;
        }
        .summary-box {
            background: #EFF6FF;
            border: 1px solid #DBEAFE;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6B7280;
            border-top: 1px solid #E5E7EB;
            padding-top: 15px;
            page-break-inside: avoid;
        }
        .price {
            font-weight: bold;
            color: #10B981;
        }
        .status {
            font-size: 9px;
            padding: 2px 6px;
            border-radius: 4px;
            color: white;
        }
        .status-pending { background: #F59E0B; }
        .status-confirmed { background: #3B82F6; }
        .status-delivered { background: #10B981; }
        .status-cancelled { background: #EF4444; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📊 Complete Data Export</h1>
        <p>l3ochaq Store - Full Database Export</p>
        <p>Generated on: <?php echo e($export_date); ?></p>
    </div>

    <!-- Summary Statistics -->
    <div class="summary-box">
        <h2 style="margin-top: 0; color: #1E40AF;">📈 Business Overview</h2>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value"><?php echo e(number_format($users->count())); ?></div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo e(number_format($products->count())); ?></div>
                <div class="stat-label">Products</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo e(number_format($orders->count())); ?></div>
                <div class="stat-label">Orders</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo e(number_format($total_revenue)); ?> DH</div>
                <div class="stat-label">Total Revenue</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo e(number_format($phoneNumbers->count())); ?></div>
                <div class="stat-label">Phone Numbers</div>
            </div>
        </div>
    </div>

    <!-- Users Section -->
    <div class="section">
        <h2 class="section-title">👥 Users (<?php echo e($users->count()); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="25%">Name</th>
                    <th width="30%">Email</th>
                    <th width="15%">Role</th>
                    <th width="25%">Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td style="text-transform: capitalize; font-weight: bold;"><?php echo e($user->role); ?></td>
                    <td><?php echo e($user->created_at->format('M j, Y H:i')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Products Section -->
    <div class="section">
        <h2 class="section-title">🛍️ Products (<?php echo e($products->count()); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="30%">Product Name</th>
                    <th width="15%">Category</th>
                    <th width="15%">Price</th>
                    <th width="10%">Stock</th>
                    <th width="10%">Rating</th>
                    <th width="15%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->category->name ?? 'N/A'); ?></td>
                    <td class="price"><?php echo e(number_format($product->price)); ?> DH</td>
                    <td><?php echo e($product->stock); ?></td>
                    <td><?php echo e($product->rating ? number_format($product->rating, 1) : 'N/A'); ?></td>
                    <td><?php echo e($product->is_active ? 'Active' : 'Inactive'); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Orders Section -->
    <div class="section">
        <h2 class="section-title">📦 Orders (<?php echo e($orders->count()); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="15%">Order Number</th>
                    <th width="20%">Customer</th>
                    <th width="15%">Total</th>
                    <th width="15%">Status</th>
                    <th width="15%">Items</th>
                    <th width="15%">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($order->order_number); ?></td>
                    <td><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></td>
                    <td class="price"><?php echo e(number_format($order->total)); ?> DH</td>
                    <td>
                        <span class="status status-<?php echo e($order->status); ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </td>
                    <td><?php echo e($order->items->count()); ?> items</td>
                    <td><?php echo e($order->created_at->format('M j, Y')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Phone Numbers Section -->
    <div class="section">
        <h2 class="section-title">📱 Phone Numbers (<?php echo e($phoneNumbers->count()); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="25%">Name</th>
                    <th width="20%">Phone</th>
                    <th width="25%">Email</th>
                    <th width="10%">Source</th>
                    <th width="15%">Added</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $phoneNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $phoneNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($phoneNumber->name ?: 'N/A'); ?></td>
                    <td style="font-family: monospace;"><?php echo e($phoneNumber->phone); ?></td>
                    <td><?php echo e($phoneNumber->email ?: 'N/A'); ?></td>
                    <td><?php echo e(ucfirst($phoneNumber->source)); ?></td>
                    <td><?php echo e($phoneNumber->created_at->format('M j, Y')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Categories Section -->
    <div class="section">
        <h2 class="section-title">📂 Categories (<?php echo e($categories->count()); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th width="40%">Category Name</th>
                    <th width="25%">Products Count</th>
                    <th width="25%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($category->name); ?></td>
                    <td><?php echo e($products->where('category_id', $category->id)->count()); ?> products</td>
                    <td><?php echo e($category->is_active ? 'Active' : 'Inactive'); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p><strong>l3ochaq Store</strong> - Complete Database Export</p>
        <p>This document contains confidential business data. Handle with care.</p>
        <p>
            Users: <?php echo e(number_format($users->count())); ?> | 
            Products: <?php echo e(number_format($products->count())); ?> | 
            Orders: <?php echo e(number_format($orders->count())); ?> | 
            Revenue: <?php echo e(number_format($total_revenue)); ?> DH | 
            Export Date: <?php echo e($export_date); ?>

        </p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\exports\all-data.blade.php ENDPATH**/ ?>