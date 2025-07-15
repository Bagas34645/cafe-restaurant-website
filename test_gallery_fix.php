<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gallery;

try {
  echo "=== TEST GALLERY MODEL DENGAN FIELD BARU ===\n\n";

  // Test scope aktif
  $galleriesAktif = Gallery::aktif()->limit(3)->get();
  echo "Gallery aktif: " . $galleriesAktif->count() . " items\n";

  foreach ($galleriesAktif as $gallery) {
    echo "- {$gallery->judul} (Kategori: {$gallery->kategori})\n";
  }

  echo "\n=== TEST BERDASARKAN KATEGORI ===\n";
  $durianGallery = Gallery::aktif()->kategori('durian')->count();
  echo "Gallery kategori durian: {$durianGallery} items\n";

  echo "\n=== TEST CONTROLLER QUERY ===\n";
  $galleries = Gallery::aktif()->urutkan()->limit(5)->get(['id', 'judul', 'kategori', 'urutan']);
  echo "Query berhasil! Total: " . $galleries->count() . " items\n";

  echo "\n✅ SEMUA TEST BERHASIL! Field gallery sudah terupdate ke bahasa Indonesia.\n";
} catch (Exception $e) {
  echo "❌ ERROR: " . $e->getMessage() . "\n";
  echo "Line: " . $e->getLine() . "\n";
  echo "File: " . $e->getFile() . "\n";
}
