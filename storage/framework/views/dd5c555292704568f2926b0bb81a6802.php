<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Users Export</title>
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
        .admin {
            color: #DC2626;
            font-weight: bold;
        }
        .user {
            color: #059669;
            font-weight: bold;
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
        <h1>👥 Users Database</h1>
        <p>l3ochaq Store - User Management Export</p>
        <p>Generated on: <?php echo e($export_date); ?></p>
        <p>Total Users: <?php echo e(number_format($total_users)); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="25%">Full Name</th>
                <th width="30%">Email Address</th>
                <th width="15%">Role</th>
                <th width="25%">Registration Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td class="<?php echo e($user->role === 'admin' ? 'admin' : 'user'); ?>">
                    <?php echo e(ucfirst($user->role)); ?>

                </td>
                <td><?php echo e($user->created_at->format('M j, Y H:i')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="footer">
        <p><strong>l3ochaq Store</strong> - Users Export</p>
        <p>Total Records: <?php echo e(number_format($total_users)); ?> | Export Date: <?php echo e($export_date); ?></p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\admin\exports\users.blade.php ENDPATH**/ ?>