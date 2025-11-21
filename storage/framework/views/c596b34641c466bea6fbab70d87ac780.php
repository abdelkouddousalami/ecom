<!DOCTYPE html>
<html>
<head>
    <title>Test Page</title>
</head>
<body>
    <h1>Test Page Working</h1>
    <p>If you can see this, basic Laravel is working.</p>
    <p>Current time: <?php echo e(now()); ?></p>
    
    <?php if(auth()->guard()->check()): ?>
        <p>Logged in as: <?php echo e(auth()->user()->name); ?> (<?php echo e(auth()->user()->role); ?>)</p>
    <?php else: ?>
        <p>Not logged in</p>
    <?php endif; ?>
    
    <h2>Database Test</h2>
    <p>Total users: <?php echo e(\App\Models\User::count()); ?></p>
    <p>Total products: <?php echo e(\App\Models\Product::count()); ?></p>
    <p>Total categories: <?php echo e(\App\Models\Category::count()); ?></p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\test-page.blade.php ENDPATH**/ ?>