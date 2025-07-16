<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

echo "=== Gallery Upload Test ===\n";

// Test 1: Get first gallery
$gallery = Gallery::first();
if (!$gallery) {
  echo "No gallery found in database\n";
  exit;
}

echo "Testing with Gallery ID: {$gallery->id}\n";
echo "Current image: {$gallery->path_gambar}\n";

// Test 2: Check if current image exists
if ($gallery->path_gambar) {
  $imagePath = storage_path('app/public/' . $gallery->path_gambar);
  echo "Image file exists: " . (file_exists($imagePath) ? 'YES' : 'NO') . "\n";
  echo "Image path: $imagePath\n";
}

// Test 3: Test storage functionality
echo "\nTesting storage functionality:\n";
$testContent = "Test file content";
$testPath = 'galleries/test.txt';

try {
  Storage::disk('public')->put($testPath, $testContent);
  echo "✓ Storage write: SUCCESS\n";

  $content = Storage::disk('public')->get($testPath);
  echo "✓ Storage read: " . ($content === $testContent ? 'SUCCESS' : 'FAILED') . "\n";

  Storage::disk('public')->delete($testPath);
  echo "✓ Storage delete: SUCCESS\n";
} catch (Exception $e) {
  echo "✗ Storage test failed: " . $e->getMessage() . "\n";
}

// Test 4: Gallery update simulation
echo "\nTesting gallery update:\n";
$originalData = [
  'judul' => $gallery->judul,
  'deskripsi' => $gallery->deskripsi,
  'kategori' => $gallery->kategori,
  'urutan' => $gallery->urutan,
  'aktif' => $gallery->aktif
];

$testData = [
  'judul' => $gallery->judul . ' (Updated)',
  'deskripsi' => $gallery->deskripsi . ' (Test update)',
  'kategori' => $gallery->kategori,
  'urutan' => $gallery->urutan,
  'aktif' => $gallery->aktif
];

try {
  $gallery->update($testData);
  echo "✓ Gallery update: SUCCESS\n";

  // Restore original data
  $gallery->update($originalData);
  echo "✓ Gallery restore: SUCCESS\n";
} catch (Exception $e) {
  echo "✗ Gallery update failed: " . $e->getMessage() . "\n";
}

echo "\n=== Test completed ===\n";
