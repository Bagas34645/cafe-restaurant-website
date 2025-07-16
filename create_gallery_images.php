<?php
// Script untuk membuat file gambar dummy untuk gallery yang hilang

$galleryImages = [
  'gallery/durian-segar.jpg',
  'gallery/proses-petik.jpg',
  'gallery/durian-montong.jpg',
  'gallery/fasilitas-sortir.jpg',
  'gallery/durian-kemasan.jpg',
  'gallery/durian-bawor.jpg',
  'gallery/persemaian.jpg',
  'gallery/quality-control.jpg'
];

$storageBase = __DIR__ . '/storage/app/public/';

foreach ($galleryImages as $imagePath) {
  $fullPath = $storageBase . $imagePath;
  $dir = dirname($fullPath);

  // Buat direktori jika belum ada
  if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
    echo "Created directory: $dir\n";
  }

  // Cek apakah file sudah ada
  if (!file_exists($fullPath)) {
    // Copy dari durian-farm.jpg sebagai placeholder
    $sourcePath = $storageBase . 'images/durian-farm.jpg';
    if (file_exists($sourcePath)) {
      copy($sourcePath, $fullPath);
      echo "Created placeholder: $imagePath\n";
    } else {
      echo "Source image not found: $sourcePath\n";
    }
  } else {
    echo "File already exists: $imagePath\n";
  }
}

echo "Gallery images setup completed!\n";
