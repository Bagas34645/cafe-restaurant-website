<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('detailed_description')->nullable()->after('description');
            $table->json('specifications')->nullable()->after('detailed_description');
            $table->string('sku')->nullable()->after('name');
            $table->integer('stock_quantity')->default(0)->after('price');
            $table->json('gallery_images')->nullable()->after('image_path');
            $table->decimal('weight', 8, 2)->nullable()->after('stock_quantity');
            $table->string('origin')->nullable()->after('weight');
            $table->text('care_instructions')->nullable()->after('origin');
            $table->boolean('is_featured')->default(false)->after('is_available');
            $table->decimal('discount_price', 10, 2)->nullable()->after('price');
            $table->timestamp('harvest_date')->nullable()->after('care_instructions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'detailed_description',
                'specifications',
                'sku',
                'stock_quantity',
                'gallery_images',
                'weight',
                'origin',
                'care_instructions',
                'is_featured',
                'discount_price',
                'harvest_date'
            ]);
        });
    }
};
