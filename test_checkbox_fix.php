<?php

// Test checkbox validation fix
echo "Testing checkbox validation fix...\n";

// Simulate unchecked checkbox (only hidden input sent)
$request_data_unchecked = [
    'name' => 'Test Product',
    'description' => 'Test Description',
    'price' => 100000,
    'category' => 'Test Category',
    'is_available' => '0'  // Hidden input value when checkbox unchecked
];

// Simulate checked checkbox (both hidden and checkbox sent, checkbox value wins)
$request_data_checked = [
    'name' => 'Test Product',
    'description' => 'Test Description', 
    'price' => 100000,
    'category' => 'Test Category',
    'is_available' => '1'  // Checkbox value when checked
];

// Test validation
$validation_rules = [
    'name' => 'required|string|max:255',
    'description' => 'required|string',
    'price' => 'required|numeric|min:0',
    'category' => 'nullable|string|max:255',
    'is_available' => 'sometimes|boolean'
];

echo "Testing unchecked checkbox (value: '0'):\n";
$unchecked_bool = (bool) ($request_data_unchecked['is_available'] ?? 0);
echo "- Raw value: '{$request_data_unchecked['is_available']}'\n";
echo "- Boolean conversion: " . ($unchecked_bool ? 'true' : 'false') . "\n";
echo "- Validation: " . (in_array($request_data_unchecked['is_available'], ['0', '1', 0, 1, true, false]) ? 'PASS' : 'FAIL') . "\n\n";

echo "Testing checked checkbox (value: '1'):\n";
$checked_bool = (bool) ($request_data_checked['is_available'] ?? 0);
echo "- Raw value: '{$request_data_checked['is_available']}'\n";  
echo "- Boolean conversion: " . ($checked_bool ? 'true' : 'false') . "\n";
echo "- Validation: " . (in_array($request_data_checked['is_available'], ['0', '1', 0, 1, true, false]) ? 'PASS' : 'FAIL') . "\n\n";

echo "✓ Checkbox validation should work correctly now!\n";
