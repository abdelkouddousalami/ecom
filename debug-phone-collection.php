<?php
/**
 * Phone Number Collection Debug
 * Access: http://localhost/Breifs/l3och/ecommerce/debug-phone-collection.php
 */

// Include Laravel bootstrap to access models
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h1>🔍 Phone Number Collection Debug</h1>";

try {
    // Check orders in database
    $totalOrders = \App\Models\Order::count();
    $ordersWithPhone = \App\Models\Order::whereNotNull('phone')->count();
    $ordersWithNames = \App\Models\Order::whereNotNull('first_name')->whereNotNull('last_name')->count();
    $validOrders = \App\Models\Order::whereNotNull('phone')
        ->whereNotNull('first_name')
        ->whereNotNull('last_name')
        ->count();

    echo "<h2>📊 Database Analysis</h2>";
    echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
    echo "<ul>";
    echo "<li><strong>Total Orders:</strong> {$totalOrders}</li>";
    echo "<li><strong>Orders with Phone:</strong> {$ordersWithPhone}</li>";
    echo "<li><strong>Orders with Names:</strong> {$ordersWithNames}</li>";
    echo "<li><strong>Valid Orders for Collection:</strong> {$validOrders}</li>";
    echo "</ul>";
    echo "</div>";

    // Check current phone numbers
    $totalPhoneNumbers = \App\Models\PhoneNumber::count();
    $fromOrders = \App\Models\PhoneNumber::where('source', 'order')->count();
    $manual = \App\Models\PhoneNumber::where('source', 'manual')->count();

    echo "<h2>📱 Current Phone Numbers</h2>";
    echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
    echo "<ul>";
    echo "<li><strong>Total Phone Numbers:</strong> {$totalPhoneNumbers}</li>";
    echo "<li><strong>From Orders:</strong> {$fromOrders}</li>";
    echo "<li><strong>Manual Entries:</strong> {$manual}</li>";
    echo "</ul>";
    echo "</div>";

    if ($validOrders > 0) {
        echo "<h2>📋 Sample Orders Data</h2>";
        $sampleOrders = \App\Models\Order::whereNotNull('phone')
            ->whereNotNull('first_name')
            ->whereNotNull('last_name')
            ->limit(5)
            ->get();

        echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background: #e5e7eb;'>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db;'>Order #</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db;'>Name</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db;'>Phone</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db;'>Address</th>";
        echo "</tr>";

        foreach ($sampleOrders as $order) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>{$order->order_number}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>{$order->first_name} {$order->last_name}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>{$order->phone}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>{$order->address} {$order->city}</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

        // Trigger collection
        echo "<h2>🔄 Manual Collection Test</h2>";
        echo "<div style='background: #fef3c7; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
        echo "<p><strong>Running collection now...</strong></p>";

        $collected = \App\Models\PhoneNumber::collectFromOrders();
        
        echo "<p>✅ <strong>Result:</strong> Collected {$collected} new phone numbers from orders!</p>";
        echo "</div>";

        // Show updated stats
        $newTotal = \App\Models\PhoneNumber::count();
        $newFromOrders = \App\Models\PhoneNumber::where('source', 'order')->count();

        echo "<h2>📊 Updated Phone Numbers</h2>";
        echo "<div style='background: #dcfce7; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
        echo "<ul>";
        echo "<li><strong>Total Phone Numbers:</strong> {$newTotal}</li>";
        echo "<li><strong>From Orders:</strong> {$newFromOrders}</li>";
        echo "</ul>";
        echo "</div>";

    } else {
        echo "<div style='background: #fee2e2; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
        echo "<h3>⚠️ No Valid Orders Found</h3>";
        echo "<p>There are no orders with complete phone and name data to collect from.</p>";
        echo "<p>Make sure orders have:</p>";
        echo "<ul>";
        echo "<li>phone (not null)</li>";
        echo "<li>first_name (not null)</li>";
        echo "<li>last_name (not null)</li>";
        echo "</ul>";
        echo "</div>";
    }

} catch (Exception $e) {
    echo "<div style='background: #fee2e2; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
    echo "<h3>❌ Error</h3>";
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>File:</strong> " . $e->getFile() . " (Line " . $e->getLine() . ")</p>";
    echo "</div>";
}

echo "<h2>🧪 Next Steps</h2>";
echo "<div style='background: #dbeafe; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
echo "<ol>";
echo "<li><strong>Visit Admin Panel:</strong> <a href='/admin/phone-numbers'>Phone Numbers Management</a></li>";
echo "<li><strong>Click 'Collect from Orders':</strong> This will gather all phone numbers from existing orders</li>";
echo "<li><strong>Test Export:</strong> <a href='/admin/export/phone-numbers'>Export Phone Numbers PDF</a></li>";
echo "</ol>";
echo "</div>";

echo "<style>
body { font-family: Arial, sans-serif; padding: 20px; max-width: 1000px; margin: 0 auto; }
h1, h2, h3 { color: #1e40af; }
a { color: #0ea5e9; text-decoration: none; }
a:hover { text-decoration: underline; }
table { font-size: 12px; }
</style>";
?>
