<?php

// Simple test script to verify Instagram bot fix
// Run this with: php test_instagram_fix.php

require_once 'vendor/autoload.php';

$baseUrl = 'http://127.0.0.1:8000'; // Change this to your actual domain

echo "Testing Instagram Bot Fix for l3ochaq E-commerce Site\n";
echo "=" . str_repeat("=", 50) . "\n\n";

// Test cases
$testCases = [
    [
        'name' => 'Valid Product URL',
        'url' => '/products/valid-product-slug',
        'user_agent' => 'Mozilla/5.0 (compatible; facebookexternalhit/1.1)',
        'expected' => 200
    ],
    [
        'name' => 'Image File as Product URL (Instagram Bot)',
        'url' => '/products/detaille1_2025-08-23_13-00-43_e1j3vp.jpg',
        'user_agent' => 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
        'expected' => 302
    ],
    [
        'name' => 'Another Image File (Instagram Bot)',
        'url' => '/products/image_test.png',
        'user_agent' => 'Instagram 76.0.0.15.395',
        'expected' => 302
    ],
    [
        'name' => 'Non-existent Product',
        'url' => '/products/non-existent-product',
        'user_agent' => 'facebookexternalhit/1.1',
        'expected' => 404
    ]
];

function testUrl($url, $userAgent, $expectedCode) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    return [
        'code' => $httpCode,
        'error' => $error,
        'success' => $httpCode == $expectedCode
    ];
}

// Run tests
foreach ($testCases as $test) {
    echo "Testing: {$test['name']}\n";
    echo "URL: {$test['url']}\n";
    echo "User-Agent: {$test['user_agent']}\n";
    echo "Expected: HTTP {$test['expected']}\n";
    
    $result = testUrl($baseUrl . $test['url'], $test['user_agent'], $test['expected']);
    
    if ($result['error']) {
        echo "❌ ERROR: {$result['error']}\n";
    } else {
        $status = $result['success'] ? '✅ PASS' : '❌ FAIL';
        echo "{$status}: Got HTTP {$result['code']}\n";
    }
    
    echo "\n" . str_repeat("-", 50) . "\n\n";
}

echo "Test completed!\n";
echo "\nKey Points:\n";
echo "- Image files should return 302 (redirect) not 500 (error)\n";
echo "- Valid products should return 200\n";
echo "- Invalid products should return 404\n";
echo "- No 500 errors should occur for any bot requests\n";

?>
