<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gallery;

echo "=== VERIFIKASI DATA GALLERY SENTRA DURIAN TEGAL ===\n\n";

$galleries = Gallery::orderBy('urutan')->get();

echo "Total gallery: " . $galleries->count() . "\n\n";

foreach ($galleries as $gallery) {
  echo "ID: {$gallery->id}\n";
  echo "Judul: {$gallery->judul}\n";
  echo "Kategori: {$gallery->kategori}\n";
  echo "Urutan: {$gallery->urutan}\n";
  echo "Aktif: " . ($gallery->aktif ? 'Ya' : 'Tidak') . "\n";
  echo "Path Gambar: {$gallery->path_gambar}\n";
  echo "Deskripsi: " . substr($gallery->deskripsi, 0, 50) . "...\n";
  echo "---\n";
}

echo "\n=== VERIFIKASI BERDASARKAN KATEGORI ===\n";
$kategoris = Gallery::getKategoriTersedia();
foreach ($kategoris as $key => $label) {
  $count = Gallery::kategori($key)->count();
  echo "{$label}: {$count} item\n";
}
