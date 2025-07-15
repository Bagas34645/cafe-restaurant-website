<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   * Migrasi untuk mengubah struktur tabel galleries menjadi bahasa Indonesia
   * dan menambahkan field untuk Sentra Durian Tegal
   */
  public function up(): void
  {
    // Drop tabel lama jika ada
    Schema::dropIfExists('galleries');

    // Buat tabel baru dengan struktur yang sudah diperbarui
    Schema::create('galleries', function (Blueprint $table) {
      $table->id();
      $table->string('judul');
      $table->text('deskripsi')->nullable();
      $table->string('path_gambar');
      $table->string('kategori')->default('umum'); // umum, durian, kebun, proses, fasilitas
      $table->integer('urutan')->default(0);
      $table->boolean('aktif')->default(true);
      $table->timestamps();

      // Index untuk performa yang lebih baik
      $table->index(['kategori', 'aktif']);
      $table->index('urutan');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('galleries');
  }
};
