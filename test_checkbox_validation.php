<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

echo "=== Testing Checkbox Validation ===\n\n";

// Test case 1: Checkbox checked (aktif = "1")
$data1 = [
  'judul' => 'Test Gallery',
  'deskripsi' => 'Test Description',
  'kategori' => 'umum',
  'urutan' => 1,
  'aktif' => '1'  // Checkbox checked
];

$validator1 = Validator::make($data1, [
  'judul' => 'required|string|max:255',
  'deskripsi' => 'nullable|string',
  'kategori' => 'required|string|in:umum,durian,kebun,proses,fasilitas',
  'urutan' => 'nullable|integer|min:0',
  'aktif' => 'nullable|boolean'
]);

echo "Test 1 - Checkbox checked (aktif='1'):\n";
echo "Valid: " . ($validator1->passes() ? 'YES' : 'NO') . "\n";
if ($validator1->fails()) {
  echo "Errors: " . json_encode($validator1->errors()->all()) . "\n";
}

// Test case 2: Checkbox not checked (aktif not present)
$data2 = [
  'judul' => 'Test Gallery',
  'deskripsi' => 'Test Description',
  'kategori' => 'umum',
  'urutan' => 1
  // 'aktif' not present - checkbox not checked
];

$validator2 = Validator::make($data2, [
  'judul' => 'required|string|max:255',
  'deskripsi' => 'nullable|string',
  'kategori' => 'required|string|in:umum,durian,kebun,proses,fasilitas',
  'urutan' => 'nullable|integer|min:0',
  'aktif' => 'nullable|boolean'
]);

echo "\nTest 2 - Checkbox not checked (aktif not present):\n";
echo "Valid: " . ($validator2->passes() ? 'YES' : 'NO') . "\n";
if ($validator2->fails()) {
  echo "Errors: " . json_encode($validator2->errors()->all()) . "\n";
}

// Test checkbox value handling
echo "\nTesting checkbox value handling:\n";

// Case 1: has('aktif') && aktif = '1'
$request1 = new Request(['aktif' => '1']);
$result1 = $request1->has('aktif') && $request1->aktif;
echo "aktif='1': has('aktif')=" . ($request1->has('aktif') ? 'true' : 'false') .
  ", aktif=" . var_export($request1->aktif, true) .
  ", result=" . var_export($result1, true) . "\n";

// Case 2: aktif not present
$request2 = new Request([]);
$result2 = $request2->has('aktif') && $request2->aktif;
echo "aktif not present: has('aktif')=" . ($request2->has('aktif') ? 'true' : 'false') .
  ", result=" . var_export($result2, true) . "\n";

echo "\n=== Test completed ===\n";
