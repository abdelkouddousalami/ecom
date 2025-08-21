<?php
/**
 * Auto-Collect Phone Numbers from Orders
 * Access: http://localhost/Breifs/l3och/ecommerce/auto-collect-phones.php
 */

// Include Laravel bootstrap
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h1>🔄 Auto-Collecting Phone Numbers from Orders</h1>";

try {
    // First, clear existing phone numbers to avoid duplicates
    echo "<p>🗑️ Clearing existing phone numbers...</p>";
    \App\Models\PhoneNumber::truncate();
    
    // Get all orders with phone numbers
    $orders = \App\Models\Order::whereNotNull('phone')
        ->where('phone', '!=', '')
        ->get();
    
    echo "<p>📦 Found {$orders->count()} orders with phone numbers</p>";
    
    $collected = 0;
    $skipped = 0;
    
    foreach ($orders as $order) {
        // Skip if missing required data
        if (empty($order->phone) || (empty($order->first_name) && empty($order->last_name))) {
            $skipped++;
            continue;
        }
        
        // Create name from available data
        $name = trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''));
        if (empty($name)) {
            $name = 'Customer'; // Default name if none available
        }
        
        // Create address from available data
        $address = trim(($order->address ?? '') . ' ' . ($order->city ?? ''));
        if (empty($address)) {
            $address = 'No address provided';
        }
        
        // Check if phone already exists (to avoid duplicates)
        if (\App\Models\PhoneNumber::where('phone', $order->phone)->exists()) {
            continue;
        }
        
        // Create phone number record
        \App\Models\PhoneNumber::create([
            'name' => $name,
            'phone' => $order->phone,
            'address' => $address,
            'source' => 'order',
            'notes' => "Collected from order #{$order->order_number} placed on " . $order->created_at->format('Y-m-d'),
            'collected_at' => $order->created_at,
            'is_active' => true,
        ]);
        
        $collected++;
        
        echo "<div style='background: #f0f9ff; padding: 8px; margin: 5px 0; border-radius: 4px;'>";
        echo "✅ <strong>{$name}</strong> - {$order->phone} - {$address}";
        echo "</div>";
    }
    
    echo "<div style='background: #dcfce7; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #16a34a;'>";
    echo "<h3>🎉 Collection Complete!</h3>";
    echo "<ul>";
    echo "<li><strong>Collected:</strong> {$collected} phone numbers</li>";
    echo "<li><strong>Skipped:</strong> {$skipped} incomplete records</li>";
    echo "<li><strong>Total in database:</strong> " . \App\Models\PhoneNumber::count() . "</li>";
    echo "</ul>";
    echo "</div>";
    
    if ($collected > 0) {
        echo "<h2>📱 Sample Collected Data:</h2>";
        $samples = \App\Models\PhoneNumber::limit(10)->get();
        echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px;'>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background: #e5e7eb;'>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Name</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Phone</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Address</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Source</th>";
        echo "</tr>";
        
        foreach ($samples as $phone) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>{$phone->name}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db; font-family: monospace;'>{$phone->phone}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>{$phone->address}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>";
            echo "<span style='background: #dcfce7; color: #166534; padding: 2px 6px; border-radius: 3px; font-size: 12px;'>{$phone->source}</span>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        
        echo "<div style='background: #dbeafe; padding: 15px; border-radius: 8px; margin: 20px 0;'>";
        echo "<h3>🧪 Test Your Export Now:</h3>";
        echo "<p>The phone numbers have been collected. Now test the PDF export:</p>";
        echo "<a href='/admin/export/phone-numbers' target='_blank' style='background: #3b82f6; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; display: inline-block; margin: 10px 0;'>📄 Download Phone Numbers PDF</a>";
        echo "</div>";
    }
    
} catch (Exception $e) {
    echo "<div style='background: #fee2e2; padding: 15px; border-radius: 8px; margin: 20px 0;'>";
    echo "<h3>❌ Error occurred:</h3>";
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>File:</strong> " . $e->getFile() . " (Line " . $e->getLine() . ")</p>";
    echo "</div>";
}

echo "<h2>🔗 Quick Links:</h2>";
echo "<ul>";
echo "<li><a href='/admin/phone-numbers' target='_blank'>📱 Phone Numbers Management</a></li>";
echo "<li><a href='/admin/export/phone-numbers' target='_blank'>📄 Export Phone Numbers PDF</a></li>";
echo "<li><a href='/admin/dashboard' target='_blank'>🏠 Admin Dashboard</a></li>";
echo "</ul>";

echo "<style>
body { font-family: Arial, sans-serif; padding: 20px; max-width: 1000px; margin: 0 auto; }
h1, h2, h3 { color: #1e40af; }
a { color: #0ea5e9; text-decoration: none; }
a:hover { text-decoration: underline; }
table { font-size: 14px; }
</style>";
?>
