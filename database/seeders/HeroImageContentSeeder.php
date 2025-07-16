<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class HeroImageContentSeeder extends Seeder
{
  /**
   * Run the database seeder.
   */
  public function run(): void
  {
    Content::updateOrCreate(
      ['key' => 'home_hero_image'],
      [
        'title' => 'Gambar Hero Beranda',
        'content' => null,
        'image_path' => null,
        'type' => 'image',
        'section' => 'home',
        'order' => 1,
        'is_active' => true,
        'meta_data' => [
          'description' => 'Gambar yang ditampilkan di bagian hero section beranda',
          'max_width' => 400,
          'max_height' => 400
        ]
      ]
    );
  }
}
