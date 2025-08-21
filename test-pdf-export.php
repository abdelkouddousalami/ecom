<?php
/**
 * Test Phone Numbers PDF Export
 * Access: http://localhost/Breifs/l3och/ecommerce/test-pdf-export.php
 */

// Include Laravel bootstrap
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h1>📄 Test Phone Numbers PDF Export</h1>";

try {
    // Get phone numbers data exactly like the controller does
    $phoneNumbers = \App\Models\PhoneNumber::orderBy('created_at', 'desc')->get();
    $stats = [
        'total_phone_numbers' => \App\Models\PhoneNumber::count(),
        'from_orders' => \App\Models\PhoneNumber::where('source', 'order')->count(),
        'manual_entries' => \App\Models\PhoneNumber::where('source', 'manual')->count(),
        'active_numbers' => \App\Models\PhoneNumber::where('is_active', true)->count(),
    ];

    echo "<div style='background: #f0f9ff; padding: 15px; border-radius: 8px; margin: 20px 0;'>";
    echo "<h3>📊 Current Database Status:</h3>";
    echo "<ul>";
    echo "<li><strong>Total Phone Numbers:</strong> {$stats['total_phone_numbers']}</li>";
    echo "<li><strong>From Orders:</strong> {$stats['from_orders']}</li>";
    echo "<li><strong>Manual Entries:</strong> {$stats['manual_entries']}</li>";
    echo "<li><strong>Active Numbers:</strong> {$stats['active_numbers']}</li>";
    echo "</ul>";
    echo "</div>";

    if ($phoneNumbers->count() > 0) {
        echo "<h3>📱 Phone Numbers in Database:</h3>";
        echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px;'>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background: #e5e7eb;'>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>#</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Name</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Phone</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Address</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Source</th>";
        echo "<th style='padding: 8px; border: 1px solid #d1d5db; text-align: left;'>Active</th>";
        echo "</tr>";
        
        foreach ($phoneNumbers as $index => $phoneNumber) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>" . ($index + 1) . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>{$phoneNumber->name}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db; font-family: monospace; font-weight: bold;'>{$phoneNumber->phone}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>{$phoneNumber->address}</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>";
            echo "<span style='background: #dcfce7; color: #166534; padding: 2px 6px; border-radius: 3px; font-size: 12px;'>{$phoneNumber->source}</span>";
            echo "</td>";
            echo "<td style='padding: 8px; border: 1px solid #d1d5db;'>";
            $status = $phoneNumber->is_active ? '✅ Active' : '❌ Inactive';
            echo "<span style='color: " . ($phoneNumber->is_active ? '#10b981' : '#ef4444') . ";'>{$status}</span>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

        echo "<div style='background: #dcfce7; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #16a34a;'>";
        echo "<h3>✅ Data is Ready for PDF Export!</h3>";
        echo "<p>All the phone numbers are now available in the database and ready to be exported as PDF.</p>";
        echo "<a href='/admin/export/phone-numbers' target='_blank' style='background: #16a34a; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; display: inline-block; margin: 10px 0;'>📄 Download Phone Numbers PDF</a>";
        echo "</div>";

    } else {
        echo "<div style='background: #fee2e2; padding: 15px; border-radius: 8px; margin: 20px 0;'>";
        echo "<h3>⚠️ No Phone Numbers Found</h3>";
        echo "<p>The phone numbers table is empty. You need to collect phone numbers from orders first.</p>";
        echo "<a href='auto-collect-phones.php' style='background: #3b82f6; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; display: inline-block; margin: 10px 0;'>🔄 Run Auto-Collect Script</a>";
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
echo "<li><a href='auto-collect-phones.php' target='_blank'>🔄 Auto-Collect Phone Numbers from Orders</a></li>";
echo "<li><a href='/admin/phone-numbers' target='_blank'>📱 Phone Numbers Management (Admin Panel)</a></li>";
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
