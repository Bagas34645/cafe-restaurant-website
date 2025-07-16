<?php

// Script untuk memperbaiki masalah storage products
echo "Checking and fixing products storage directory...\n";

$basePath = __DIR__;
$publicStoragePath = $basePath . '/storage/app/public';
$productsPath = $publicStoragePath . '/products';

// Check if storage/app/public exists
if (!file_exists($publicStoragePath)) {
    echo "Creating storage/app/public directory...\n";
    if (!mkdir($publicStoragePath, 0755, true)) {
        echo "ERROR: Failed to create storage/app/public directory\n";
        exit(1);
    }
}

// Check if storage/app/public/products exists
if (!file_exists($productsPath)) {
    echo "Creating storage/app/public/products directory...\n";
    if (!mkdir($productsPath, 0755, true)) {
        echo "ERROR: Failed to create products directory\n";
        exit(1);
    }
} else {
    echo "Products directory already exists.\n";
}

// Check permissions
$perms = substr(sprintf('%o', fileperms($productsPath)), -4);
echo "Current permissions for products directory: $perms\n";

// Try to set correct permissions
if (chmod($productsPath, 0755)) {
    echo "Permissions updated successfully.\n";
} else {
    echo "WARNING: Could not update permissions. You may need to run this with sudo.\n";
}

// Check if directory is writable
if (is_writable($productsPath)) {
    echo "Products directory is writable. ✓\n";
} else {
    echo "ERROR: Products directory is not writable! ✗\n";
}

// Test creating a test file
$testFile = $productsPath . '/test_write.txt';
if (file_put_contents($testFile, 'test')) {
    echo "Write test successful. ✓\n";
    unlink($testFile); // Clean up
} else {
    echo "ERROR: Cannot write to products directory! ✗\n";
}

echo "Storage check completed.\n";
