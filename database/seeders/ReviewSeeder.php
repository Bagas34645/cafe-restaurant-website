<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'customer_name' => 'Sarah Johnson',
                'customer_email' => 'sarah.johnson@email.com',
                'rating' => 5,
                'comment' => 'Absolutely amazing experience! The food was exceptional, service was outstanding, and the atmosphere was perfect for our anniversary dinner. Will definitely be coming back!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Michael Chen',
                'customer_email' => 'michael.chen@email.com',
                'rating' => 4,
                'comment' => 'Great restaurant with delicious food. The ribeye steak was cooked perfectly and the seafood risotto was incredible. Only minor complaint is that it gets quite busy, so make a reservation!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Emily Rodriguez',
                'customer_email' => 'emily.rodriguez@email.com',
                'rating' => 5,
                'comment' => 'Best Italian food in the city! The pasta is clearly homemade and the tiramisu is to die for. The staff was very attentive and friendly. Highly recommended!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'David Thompson',
                'customer_email' => 'david.thompson@email.com',
                'rating' => 4,
                'comment' => 'Wonderful dining experience. The grilled salmon was fresh and perfectly seasoned. The wine selection is impressive. Great place for a business dinner or romantic evening.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Lisa Wang',
                'customer_email' => 'lisa.wang@email.com',
                'rating' => 5,
                'comment' => 'Outstanding service and incredible food! Every dish we ordered was perfectly prepared and beautifully presented. The chocolate lava cake was the perfect ending to a perfect meal.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Robert Miller',
                'customer_email' => 'robert.miller@email.com',
                'rating' => 3,
                'comment' => 'Food was good but service was a bit slow during our visit. The bruschetta was excellent and the atmosphere is nice. Maybe we just came on a busy night.',
                'is_approved' => false,
            ],
            [
                'customer_name' => 'Jennifer Brown',
                'customer_email' => 'jennifer.brown@email.com',
                'rating' => 5,
                'comment' => 'This place exceeded all our expectations! The chicken parmigiana was fantastic and the portion sizes are very generous. The staff made us feel very welcome.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Alex Garcia',
                'customer_email' => 'alex.garcia@email.com',
                'rating' => 4,
                'comment' => 'Great food and excellent presentation. The calamari rings were crispy and delicious. The only reason I\'m not giving 5 stars is the price point, but the quality justifies it.',
                'is_approved' => false,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
