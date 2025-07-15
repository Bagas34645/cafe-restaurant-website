<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Durian Products
            [
                'name' => 'Durian Montong Premium',
                'description' => 'Durian montong berkualitas premium dengan daging tebal, manis, dan tekstur lembut',
                'price' => 85000.00,
                'category' => 'durian',
                'image_path' => 'products/durian-montong.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Durian Musang King',
                'description' => 'Durian musang king asli Malaysia dengan rasa yang khas dan aroma yang kuat',
                'price' => 120000.00,
                'category' => 'durian',
                'image_path' => 'products/durian-musang-king.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Durian Bawor Tegal',
                'description' => 'Durian bawor lokal Tegal dengan daging kuning cerah dan rasa manis legit',
                'price' => 65000.00,
                'category' => 'durian',
                'image_path' => 'products/durian-bawor.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Durian Duri Hitam',
                'description' => 'Durian duri hitam dengan tekstur creamy dan rasa yang balance antara manis dan sedikit pahit',
                'price' => 95000.00,
                'category' => 'durian',
                'image_path' => 'products/durian-duri-hitam.jpg',
                'is_available' => true,
            ],

            // Makanan (Food)
            [
                'name' => 'Es Krim Durian',
                'description' => 'Es krim durian homemade dengan tekstur lembut dan rasa durian yang autentik',
                'price' => 15000.00,
                'category' => 'makanan',
                'image_path' => 'products/es-krim-durian.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Pancake Durian',
                'description' => 'Pancake lembut dengan isian daging durian segar dan whipped cream',
                'price' => 25000.00,
                'category' => 'makanan',
                'image_path' => 'products/pancake-durian.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Keripik Durian',
                'description' => 'Keripik durian krispi dengan rasa durian yang intens, cocok untuk oleh-oleh',
                'price' => 35000.00,
                'category' => 'makanan',
                'image_path' => 'products/keripik-durian.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Dodol Durian',
                'description' => 'Dodol durian tradisional Tegal dengan tekstur kenyal dan rasa durian yang kuat',
                'price' => 40000.00,
                'category' => 'makanan',
                'image_path' => 'products/dodol-durian.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Lempok Durian',
                'description' => 'Lempok durian asli dengan tekstur padat dan rasa durian yang terkonsentrasi',
                'price' => 45000.00,
                'category' => 'makanan',
                'image_path' => 'products/lempok-durian.jpg',
                'is_available' => true,
            ],

            // Minuman (Beverages)
            [
                'name' => 'Jus Durian Segar',
                'description' => 'Jus durian segar tanpa pengawet dengan daging durian pilihan',
                'price' => 18000.00,
                'category' => 'minuman',
                'image_path' => 'products/jus-durian.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Milkshake Durian',
                'description' => 'Milkshake durian creamy dengan topping whipped cream dan potongan durian',
                'price' => 22000.00,
                'category' => 'minuman',
                'image_path' => 'products/milkshake-durian.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Es Durian Campur',
                'description' => 'Es campur dengan daging durian, kelapa muda, dan sirup gula aren',
                'price' => 20000.00,
                'category' => 'minuman',
                'image_path' => 'products/es-durian-campur.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Coffee Durian Latte',
                'description' => 'Kopi latte dengan flavor durian yang unik dan foam art yang menarik',
                'price' => 25000.00,
                'category' => 'minuman',
                'image_path' => 'products/coffee-durian-latte.jpg',
                'is_available' => true,
            ],

            // Bibit (Seedlings)
            [
                'name' => 'Bibit Durian Montong',
                'description' => 'Bibit durian montong umur 1 tahun dengan tinggi 80-100cm, siap tanam',
                'price' => 150000.00,
                'category' => 'bibit',
                'image_path' => 'products/bibit-durian-montong.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Bibit Durian Bawor',
                'description' => 'Bibit durian bawor lokal Tegal umur 8 bulan dengan akar yang kuat',
                'price' => 125000.00,
                'category' => 'bibit',
                'image_path' => 'products/bibit-durian-bawor.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Bibit Durian Musang King',
                'description' => 'Bibit durian musang king unggul umur 1.5 tahun dengan sertifikat keaslian',
                'price' => 200000.00,
                'category' => 'bibit',
                'image_path' => 'products/bibit-durian-musang-king.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Bibit Durian Duri Hitam',
                'description' => 'Bibit durian duri hitam berkualitas dengan pertumbuhan yang optimal',
                'price' => 175000.00,
                'category' => 'bibit',
                'image_path' => 'products/bibit-durian-duri-hitam.jpg',
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
