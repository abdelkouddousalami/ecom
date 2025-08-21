<?php
/**
 * Simple Phone Collection Test
 * Access: http://localhost/Breifs/l3och/ecommerce/test-phone-collect.php
 */

// Include Laravel bootstrap
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h1>📱 Phone Collection Test</h1>";

try {
    // Get order count
    $orderCount = \App\Models\Order::whereNotNull('phone')
        ->whereNotNull('first_name')
        ->whereNotNull('last_name')
        ->count();

    echo "<p><strong>Orders available for collection:</strong> {$orderCount}</p>";

    if ($orderCount > 0) {
        // Try to collect
        echo "<p>🔄 Attempting to collect phone numbers...</p>";
        $collected = \App\Models\PhoneNumber::collectFromOrders();
        echo "<p>✅ <strong>Collected:</strong> {$collected} new phone numbers</p>";

        // Show current count
        $totalPhones = \App\Models\PhoneNumber::count();
        echo "<p>📱 <strong>Total phone numbers now:</strong> {$totalPhones}</p>";

        // Show sample data
        $phones = \App\Models\PhoneNumber::limit(5)->get();
        if ($phones->count() > 0) {
            echo "<h3>📋 Sample Phone Numbers:</h3>";
            echo "<ul>";
            foreach ($phones as $phone) {
                echo "<li><strong>{$phone->name}</strong> - {$phone->phone} - {$phone->address} ({$phone->source})</li>";
            }
            echo "</ul>";
        }

        echo "<p><a href='/admin/export/phone-numbers' target='_blank' style='background: #3b82f6; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none;'>📄 Test Export PDF</a></p>";
    } else {
        echo "<p>❌ No orders found with complete phone/name data</p>";
        
        // Check what's in orders
        $allOrders = \App\Models\Order::limit(3)->get();
        if ($allOrders->count() > 0) {
            echo "<h3>Sample Orders (checking data):</h3>";
            foreach ($allOrders as $order) {
                echo "<p>";
                echo "<strong>Order #{$order->order_number}:</strong><br>";
                echo "Name: " . ($order->first_name ?? 'NULL') . " " . ($order->last_name ?? 'NULL') . "<br>";
                echo "Phone: " . ($order->phone ?? 'NULL') . "<br>";
                echo "Address: " . ($order->address ?? 'NULL') . " " . ($order->city ?? 'NULL');
                echo "</p>";
            }
        }
    }

} catch (Exception $e) {
    echo "<p style='color: red;'><strong>Error:</strong> " . $e->getMessage() . "</p>";
}

echo "<h3>🔗 Quick Links:</h3>";
echo "<ul>";
echo "<li><a href='/admin/phone-numbers'>Phone Numbers Management</a></li>";
echo "<li><a href='/admin/collect-from-orders'>Official Collect Route</a></li>";
echo "<li><a href='/admin/export/phone-numbers'>Export Phone Numbers</a></li>";
echo "</ul>";

echo "<style>body { font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: 0 auto; }</style>";
?>
