<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Phone Numbers Export</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3B82F6;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #1E40AF;
            font-size: 28px;
        }
        .header p {
            margin: 5px 0;
            color: #6B7280;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            background: #F3F4F6;
            padding: 15px;
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
        }
        th, td {
            border: 1px solid #E5E7EB;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #F9FAFB;
            font-weight: bold;
            color: #374151;
        }
        tr:nth-child(even) {
            background-color: #F9FAFB;
        }
        .active {
            color: #10B981;
            font-weight: bold;
        }
        .inactive {
            color: #EF4444;
            font-weight: bold;
        }
        .source {
            background: #E0E7FF;
            color: #3730A3;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6B7280;
            border-top: 1px solid #E5E7EB;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📱 Phone Numbers Database</h1>
        <p>l3ochaq Store - Customer Contact Export</p>
        <p>Generated on: <?php echo e(now()->format('F j, Y \a\t g:i A')); ?></p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value"><?php echo e(number_format($stats['total_phone_numbers'])); ?></div>
            <div class="stat-label">Total Numbers</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo e(number_format($stats['from_orders'])); ?></div>
            <div class="stat-label">From Orders</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo e(number_format($stats['active_numbers'])); ?></div>
            <div class="stat-label">Active Numbers</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo e(number_format($stats['manual_entries'])); ?></div>
            <div class="stat-label">Manual Entries</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="25%">Name</th>
                <th width="20%">Phone Number</th>
                <th width="35%">Address</th>
                <th width="10%">Source</th>
                <th width="5%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $phoneNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $phoneNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($phoneNumber->name ?: 'N/A'); ?></td>
                <td style="font-family: monospace; font-weight: bold;"><?php echo e($phoneNumber->phone); ?></td>
                <td><?php echo e($phoneNumber->address ?: 'No address provided'); ?></td>
                <td>
                    <span class="source"><?php echo e(ucfirst($phoneNumber->source)); ?></span>
                </td>
                <td class="<?php echo e($phoneNumber->is_active ? 'active' : 'inactive'); ?>">
                    <?php echo e($phoneNumber->is_active ? '✓' : '✗'); ?>

                </td>
            </tr>
            <?php if($phoneNumber->notes): ?>
            <tr>
                <td></td>
                <td colspan="5" style="font-style: italic; color: #6B7280; font-size: 10px;">
                    Notes: <?php echo e($phoneNumber->notes); ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="footer">
        <p><strong>l3ochaq Store</strong> - Customer Database Export</p>
        <p>This document contains confidential customer information. Handle with care.</p>
        <p>Total Records: <?php echo e(number_format($stats['total_phone_numbers'])); ?> | Active: <?php echo e(number_format($stats['active_numbers'])); ?> | From Orders: <?php echo e(number_format($stats['from_orders'])); ?> | Export Date: <?php echo e(now()->format('M j, Y')); ?></p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views/admin/exports/phone-numbers.blade.php ENDPATH**/ ?>