<!DOCTYPE html>
<html>
<head>
    <title>Product Creation Diagnostic</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; }
        .error { color: red; }
        .warning { color: orange; }
        .section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h1>Product Creation Diagnostic Page</h1>
    
    <?php
    require_once __DIR__ . '/../vendor/autoload.php';
    
    // Initialize Laravel app
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    ?>
    
    <div class="section">
        <h2>1. PHP Configuration</h2>
        <p><strong>Upload Max Filesize:</strong> <?php echo ini_get('upload_max_filesize'); ?></p>
        <p><strong>Post Max Size:</strong> <?php echo ini_get('post_max_size'); ?></p>
        <p><strong>Max File Uploads:</strong> <?php echo ini_get('max_file_uploads'); ?></p>
        <p><strong>Memory Limit:</strong> <?php echo ini_get('memory_limit'); ?></p>
    </div>
    
    <div class="section">
        <h2>2. Laravel Configuration</h2>
        <p><strong>App URL:</strong> <?php echo config('app.url'); ?></p>
        <p><strong>Storage Path:</strong> <?php echo storage_path('app/public'); ?></p>
        <p><strong>Storage Writable:</strong> <?php echo is_writable(storage_path('app/public')) ? '✓ Yes' : '✗ No'; ?></p>
    </div>
    
    <div class="section">
        <h2>3. Database Status</h2>
        <?php
        try {
            $categories = App\Models\Category::count();
            echo "<p class='success'>✓ Categories: {$categories}</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ Categories Error: " . $e->getMessage() . "</p>";
        }
        
        try {
            $products = App\Models\Product::count();
            echo "<p class='success'>✓ Products: {$products}</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ Products Error: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
    
    <div class="section">
        <h2>4. Routes Status</h2>
        <?php
        try {
            $createUrl = route('admin.create-product');
            echo "<p class='success'>✓ Create Product Route: <a href='{$createUrl}' target='_blank'>{$createUrl}</a></p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ Create Product Route Error: " . $e->getMessage() . "</p>";
        }
        
        try {
            $storeUrl = route('admin.store-product');
            echo "<p class='success'>✓ Store Product Route: {$storeUrl}</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ Store Product Route Error: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
    
    <div class="section">
        <h2>5. Service Classes</h2>
        <?php
        try {
            $service = new App\Services\ImageUploadService();
            echo "<p class='success'>✓ ImageUploadService: Working</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ ImageUploadService Error: " . $e->getMessage() . "</p>";
        }
        
        try {
            $request = new App\Http\Requests\StoreProductRequest();
            echo "<p class='success'>✓ StoreProductRequest: Working</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ StoreProductRequest Error: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
    
    <div class="section">
        <h2>6. Recent Laravel Logs</h2>
        <?php
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $logs = file_get_contents($logFile);
            $recentLogs = array_slice(explode("\n", $logs), -10);
            if (empty(trim($logs))) {
                echo "<p class='success'>✓ No recent errors in logs</p>";
            } else {
                echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>";
                echo htmlspecialchars(implode("\n", $recentLogs));
                echo "</pre>";
            }
        } else {
            echo "<p class='warning'>⚠ Log file doesn't exist yet</p>";
        }
        ?>
    </div>
    
    <div class="section">
        <h2>7. Next Steps</h2>
        <p>If everything above shows as working, the issue might be:</p>
        <ul>
            <li>JavaScript errors in the browser (check console)</li>
            <li>Form validation issues</li>
            <li>Missing CSRF token</li>
            <li>Specific validation errors not being displayed properly</li>
        </ul>
        <p><strong>Try accessing the create product form:</strong> <a href="<?php echo route('admin.create-product'); ?>" target="_blank">Add New Product</a></p>
    </div>
</body>
</html>
