<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Restaurant Interior',
                'description' => 'Our beautiful dining room with warm lighting and comfortable seating',
                'image_path' => 'sample/restaurant-interior.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Chef at Work',
                'description' => 'Our talented chef preparing fresh dishes in our open kitchen',
                'image_path' => 'sample/chef-cooking.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Outdoor Terrace',
                'description' => 'Enjoy your meal in our lovely outdoor dining area',
                'image_path' => 'sample/outdoor-terrace.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Private Dining Room',
                'description' => 'Perfect space for special occasions and business meetings',
                'image_path' => 'sample/private-dining.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Wine Selection',
                'description' => 'Our carefully curated wine collection from around the world',
                'image_path' => 'sample/wine-cellar.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Fresh Ingredients',
                'description' => 'We source only the finest and freshest ingredients',
                'image_path' => 'sample/fresh-ingredients.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
