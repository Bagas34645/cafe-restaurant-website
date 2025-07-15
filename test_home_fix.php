<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gallery;

try {
  echo "=== TEST HOMECONTROLLER QUERY ===\n";

  // Test query yang ada di HomeController
  $featuredGalleries = Gallery::aktif()->urutkan()->take(6)->get();
  echo "Featured galleries: " . $featuredGalleries->count() . " items\n";

  foreach ($featuredGalleries as $gallery) {
    echo "- {$gallery->judul} (Kategori: {$gallery->kategori}, Urutan: {$gallery->urutan})\n";
  }

  echo "\n✅ HomeController query berhasil!\n";
} catch (Exception $e) {
  echo "❌ ERROR: " . $e->getMessage() . "\n";
  echo "Line: " . $e->getLine() . "\n";
  echo "File: " . $e->getFile() . "\n";
}
