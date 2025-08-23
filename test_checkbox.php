<?php

// Simple test without Laravel bootstrapping
echo "Testing checkbox logic:\n";

// Simulate form data with checkbox checked
$data_with_checkbox = [
    'name' => 'Test Product',
    'customizable' => '1'
];

// Simulate form data without checkbox (unchecked checkboxes don't send data)
$data_without_checkbox = [
    'name' => 'Test Product'
    // No customizable field when unchecked
];

echo "With checkbox checked:\n";
echo "isset: " . (isset($data_with_checkbox['customizable']) ? 'true' : 'false') . "\n";
echo "value: " . ($data_with_checkbox['customizable'] ?? 'not set') . "\n";
echo "== '1': " . (($data_with_checkbox['customizable'] ?? '') == '1' ? 'true' : 'false') . "\n";

echo "\nWithout checkbox (unchecked):\n";
echo "isset: " . (isset($data_without_checkbox['customizable']) ? 'true' : 'false') . "\n";
echo "value: " . ($data_without_checkbox['customizable'] ?? 'not set') . "\n";
echo "== '1': " . (($data_without_checkbox['customizable'] ?? '') == '1' ? 'true' : 'false') . "\n";

echo "\nConclusion: The logic should work correctly.\n";
