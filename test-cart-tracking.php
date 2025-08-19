<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->boot();

echo "=== Cart Tracking Test ===\n";

// Check total interactions
$totalInteractions = DB::table('product_interactions')->count();
echo "Total interactions: $totalInteractions\n";

// Check cart additions
$cartAdditions = DB::table('product_interactions')->where('type', 'cart_add')->count();
echo "Cart additions: $cartAdditions\n";

// Check wishlist additions  
$wishlistAdditions = DB::table('product_interactions')->where('type', 'wishlist_add')->count();
echo "Wishlist additions: $wishlistAdditions\n";

// Check views
$views = DB::table('product_interactions')->where('type', 'view')->count();
echo "Views: $views\n";

// Check interactions by product
echo "\n=== By Product ===\n";
$byProduct = DB::table('product_interactions')
    ->select('product_id', 'type', DB::raw('COUNT(*) as count'))
    ->groupBy('product_id', 'type')
    ->orderBy('product_id', 'type')
    ->get();

foreach($byProduct as $row) {
    echo "Product {$row->product_id} - {$row->type}: {$row->count}\n";
}

echo "\n=== Recent Interactions ===\n";
$recent = DB::table('product_interactions')
    ->orderBy('created_at', 'desc')
    ->limit(5)
    ->get(['product_id', 'type', 'created_at']);

foreach($recent as $row) {
    echo "Product {$row->product_id} - {$row->type} at {$row->created_at}\n";
}
