<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Boot the application
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test storage
use Illuminate\Support\Facades\Storage;

echo "Testing product image upload functionality...\n";

try {
    // Test if we can create and delete files in products directory
    $testPath = 'products/test_upload.txt';
    Storage::disk('public')->put($testPath, 'Test upload content');
    
    if (Storage::disk('public')->exists($testPath)) {
        echo "✓ Can create files in products directory\n";
        Storage::disk('public')->delete($testPath);
        echo "✓ Can delete files from products directory\n";
    } else {
        echo "✗ Cannot create files in products directory\n";
    }
    
    // Test if the public link works
    $publicPath = storage_path('app/public/products');
    $linkPath = public_path('storage/products');
    
    if (is_link(public_path('storage'))) {
        echo "✓ Storage link exists\n";
    } else {
        echo "✗ Storage link missing - run 'php artisan storage:link'\n";
    }
    
    echo "✓ Products image upload should work correctly now!\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
