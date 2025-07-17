<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductReview;
use App\Models\Product;
use App\Models\User;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, create some sample users if they don't exist
        $users = [
            [
                'name' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Maya Indira',
                'email' => 'maya@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(['email' => $userData['email']], $userData);
        }

        $allUsers = User::whereIn('email', array_column($users, 'email'))->get();
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->info('No products found. Please run the product seeder first.');
            return;
        }

        $reviews = [
            // Reviews for Durian Musang King Premium
            [
                'product_name' => 'Durian Musang King Premium',
                'reviews' => [
                    [
                        'user_email' => 'ahmad@example.com',
                        'rating' => 5,
                        'title' => 'Kualitas Premium, Rasanya Luar Biasa!',
                        'review' => 'Durian Musang King ini benar-benar premium! Dagingnya tebal, creamy, dan rasanya sangat enak. Pengiriman juga cepat dan buahnya sudah matang sempurna saat tiba. Akan order lagi pasti!',
                        'is_verified_purchase' => true,
                        'is_approved' => true,
                    ],
                    [
                        'user_email' => 'siti@example.com',
                        'rating' => 4,
                        'title' => 'Enak tapi agak mahal',
                        'review' => 'Rasanya memang enak sekali, daging tebal dan manis. Cuma harganya agak mahal ya, tapi untuk kualitas segini sih worth it lah.',
                        'is_verified_purchase' => true,
                        'is_approved' => true,
                    ],
                    [
                        'user_email' => 'budi@example.com',
                        'rating' => 5,
                        'title' => 'The King of Durian!',
                        'review' => 'Sebagai pecinta durian, saya sangat puas dengan Musang King ini. Aromanya khas, dagingnya tidak berserat, dan manisnya pas. Recommended!',
                        'is_verified_purchase' => false,
                        'is_approved' => true,
                    ],
                ]
            ],
            // Reviews for Durian Montong Jumbo
            [
                'product_name' => 'Durian Montong Jumbo',
                'reviews' => [
                    [
                        'user_email' => 'maya@example.com',
                        'rating' => 4,
                        'title' => 'Cocok untuk pemula',
                        'review' => 'Buat yang baru pertama kali makan durian, Montong ini cocok banget. Rasanya manis tanpa pahit, ukurannya juga besar. Anak-anak suka!',
                        'is_verified_purchase' => true,
                        'is_approved' => true,
                    ],
                    [
                        'user_email' => 'ahmad@example.com',
                        'rating' => 4,
                        'title' => 'Ukuran jumbo, rasa oke',
                        'review' => 'Ukurannya memang jumbo sesuai nama. Rasa manis, cocok untuk keluarga. Packaging rapih dan aman.',
                        'is_verified_purchase' => true,
                        'is_approved' => true,
                    ],
                ]
            ],
            // Reviews for Bibit Durian Musang King
            [
                'product_name' => 'Bibit Durian Musang King',
                'reviews' => [
                    [
                        'user_email' => 'budi@example.com',
                        'rating' => 5,
                        'title' => 'Bibit berkualitas tinggi',
                        'review' => 'Bibitnya sehat, akar kuat, dan petunjuk perawatannya lengkap. Sudah 3 bulan ditanam dan tumbuh dengan baik. Pelayanan seller juga responsif.',
                        'is_verified_purchase' => true,
                        'is_approved' => true,
                    ],
                    [
                        'user_email' => 'siti@example.com',
                        'rating' => 4,
                        'title' => 'Investasi jangka panjang yang bagus',
                        'review' => 'Untuk yang mau investasi atau hobby berkebun, bibit ini recommended. Kualitas bagus dan harga reasonable.',
                        'is_verified_purchase' => true,
                        'is_approved' => true,
                    ],
                ]
            ],
            // Reviews for Keripik Durian Original
            [
                'product_name' => 'Keripik Durian Original',
                'reviews' => [
                    [
                        'user_email' => 'maya@example.com',
                        'rating' => 5,
                        'title' => 'Renyah dan rasa durian kuat',
                        'review' => 'Keripik duriannya renyah banget dan rasa duriannya masih kuat. Cocok buat oleh-oleh atau cemilan sehari-hari. Kemasan juga bagus.',
                        'is_verified_purchase' => true,
                        'is_approved' => true,
                    ],
                    [
                        'user_email' => 'ahmad@example.com',
                        'rating' => 4,
                        'title' => 'Cemilan enak, tahan lama',
                        'review' => 'Enak, renyah, dan awet. Cocok buat yang pengen nostalgia rasa durian tapi praktis.',
                        'is_verified_purchase' => true,
                        'is_approved' => true,
                    ],
                ]
            ],
        ];

        foreach ($reviews as $productReview) {
            $product = $products->where('name', $productReview['product_name'])->first();

            if (!$product) {
                continue;
            }

            foreach ($productReview['reviews'] as $reviewData) {
                $user = $allUsers->where('email', $reviewData['user_email'])->first();

                if (!$user) {
                    continue;
                }

                ProductReview::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'rating' => $reviewData['rating'],
                    'title' => $reviewData['title'],
                    'review' => $reviewData['review'],
                    'is_verified_purchase' => $reviewData['is_verified_purchase'],
                    'is_approved' => $reviewData['is_approved'],
                    'approved_at' => $reviewData['is_approved'] ? now() : null,
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}
