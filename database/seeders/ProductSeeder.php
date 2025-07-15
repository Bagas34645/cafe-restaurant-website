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
            // Appetizers
            [
                'name' => 'Bruschetta Trio',
                'description' => 'Three varieties of toasted bread topped with fresh tomatoes, burrata cheese, and prosciutto',
                'price' => 12.99,
                'category' => 'Appetizer',
                'image_path' => 'sample/bruschetta.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Calamari Rings',
                'description' => 'Crispy fried squid rings served with marinara sauce and lemon wedges',
                'price' => 14.99,
                'category' => 'Appetizer',
                'image_path' => 'sample/calamari.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Fresh romaine lettuce, parmesan cheese, croutons, and our signature caesar dressing',
                'price' => 11.99,
                'category' => 'Salad',
                'image_path' => 'sample/caesar-salad.jpg',
                'is_available' => true,
            ],

            // Main Courses
            [
                'name' => 'Grilled Salmon',
                'description' => 'Fresh Atlantic salmon grilled to perfection, served with seasonal vegetables and rice pilaf',
                'price' => 24.99,
                'category' => 'Main Course',
                'image_path' => 'sample/grilled-salmon.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Ribeye Steak',
                'description' => 'Premium 12oz ribeye steak cooked to your preference, served with mashed potatoes and asparagus',
                'price' => 32.99,
                'category' => 'Main Course',
                'image_path' => 'sample/ribeye-steak.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Chicken Parmigiana',
                'description' => 'Breaded chicken breast topped with marinara sauce and melted mozzarella, served with spaghetti',
                'price' => 19.99,
                'category' => 'Main Course',
                'image_path' => 'sample/chicken-parm.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Seafood Risotto',
                'description' => 'Creamy arborio rice cooked with fresh shrimp, scallops, and mussels in a white wine sauce',
                'price' => 26.99,
                'category' => 'Main Course',
                'image_path' => 'sample/seafood-risotto.jpg',
                'is_available' => true,
            ],

            // Pasta
            [
                'name' => 'Fettuccine Alfredo',
                'description' => 'Fresh fettuccine pasta tossed in our rich and creamy parmesan sauce',
                'price' => 16.99,
                'category' => 'Pasta',
                'image_path' => 'sample/fettuccine-alfredo.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Spaghetti Carbonara',
                'description' => 'Traditional Italian pasta with pancetta, eggs, parmesan cheese, and black pepper',
                'price' => 18.99,
                'category' => 'Pasta',
                'image_path' => 'sample/carbonara.jpg',
                'is_available' => true,
            ],

            // Desserts
            [
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert with layers of mascarpone cheese, coffee-soaked ladyfingers, and cocoa',
                'price' => 8.99,
                'category' => 'Dessert',
                'image_path' => 'sample/tiramisu.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Chocolate Lava Cake',
                'description' => 'Warm chocolate cake with a molten center, served with vanilla ice cream',
                'price' => 9.99,
                'category' => 'Dessert',
                'image_path' => 'sample/lava-cake.jpg',
                'is_available' => true,
            ],

            // Beverages
            [
                'name' => 'Fresh Orange Juice',
                'description' => 'Freshly squeezed orange juice from premium oranges',
                'price' => 4.99,
                'category' => 'Beverage',
                'image_path' => 'sample/orange-juice.jpg',
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
