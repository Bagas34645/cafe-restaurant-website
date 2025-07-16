<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FixProductsStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:fix-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix products storage directory permissions and create if not exists';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking and fixing products storage directory...');

        $publicStoragePath = storage_path('app/public');
        $productsPath = $publicStoragePath . '/products';

        // Create storage/app/public if it doesn't exist
        if (!file_exists($publicStoragePath)) {
            $this->info('Creating storage/app/public directory...');
            if (!mkdir($publicStoragePath, 0775, true)) {
                $this->error('Failed to create storage/app/public directory');
                return 1;
            }
        }

        // Create products directory if it doesn't exist
        if (!file_exists($productsPath)) {
            $this->info('Creating storage/app/public/products directory...');
            if (!mkdir($productsPath, 0775, true)) {
                $this->error('Failed to create products directory');
                return 1;
            }
            $this->info('Products directory created successfully.');
        } else {
            $this->info('Products directory already exists.');
        }

        // Check if we can write to the directory
        $testFile = $productsPath . '/test_write.txt';
        if (file_put_contents($testFile, 'test')) {
            $this->info('Write test successful. ✓');
            unlink($testFile); // Clean up
        } else {
            $this->error('Cannot write to products directory! You may need to check permissions.');
            $this->info('Try running: sudo chown -R www-data:www-data storage/app/public/products');
            $this->info('Or: sudo chmod -R 775 storage/app/public/products');
            return 1;
        }

        // Test Storage facade
        try {
            Storage::disk('public')->put('products/test_laravel.txt', 'Laravel storage test');
            if (Storage::disk('public')->exists('products/test_laravel.txt')) {
                $this->info('Laravel Storage disk test successful. ✓');
                Storage::disk('public')->delete('products/test_laravel.txt');
            }
        } catch (\Exception $e) {
            $this->error('Laravel Storage disk test failed: ' . $e->getMessage());
            return 1;
        }

        $this->info('Products storage is working correctly! ✓');
        return 0;
    }
}
