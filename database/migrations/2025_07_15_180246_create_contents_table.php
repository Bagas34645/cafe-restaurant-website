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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // unique identifier for content
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('image_path')->nullable();
            $table->json('meta_data')->nullable(); // for additional structured data
            $table->string('type')->default('text'); // text, image, section, etc.
            $table->string('section')->nullable(); // home, about, contact, etc.
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
