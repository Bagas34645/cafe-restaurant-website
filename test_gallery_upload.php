<?php
// Test script untuk debugging gallery upload
echo "=== Gallery Upload Debug Test ===\n";

// Test direktori permissions
$galleryDir = __DIR__ . '/storage/app/public/galleries';
echo "Gallery directory: $galleryDir\n";
echo "Directory exists: " . (is_dir($galleryDir) ? 'YES' : 'NO') . "\n";
echo "Directory writable: " . (is_writable($galleryDir) ? 'YES' : 'NO') . "\n";

// Test storage permissions
$storageDir = __DIR__ . '/storage/app/public';
echo "\nStorage directory: $storageDir\n";
echo "Storage exists: " . (is_dir($storageDir) ? 'YES' : 'NO') . "\n";
echo "Storage writable: " . (is_writable($storageDir) ? 'YES' : 'NO') . "\n";

// Test symlink
$symlinkPath = __DIR__ . '/public/storage';
echo "\nSymlink path: $symlinkPath\n";
echo "Symlink exists: " . (is_link($symlinkPath) ? 'YES' : 'NO') . "\n";
if (is_link($symlinkPath)) {
  echo "Symlink target: " . readlink($symlinkPath) . "\n";
}

// List contents of galleries directory
echo "\nGalleries directory contents:\n";
if (is_dir($galleryDir)) {
  $files = scandir($galleryDir);
  foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
      echo "- $file\n";
    }
  }
  if (count($files) <= 2) {
    echo "Directory is empty\n";
  }
} else {
  echo "Directory not found\n";
}

// Test permissions
echo "\nDirectory permissions:\n";
echo "galleries: " . substr(sprintf('%o', fileperms($galleryDir)), -4) . "\n";
echo "public: " . substr(sprintf('%o', fileperms($storageDir)), -4) . "\n";

echo "\n=== Test completed ===\n";
