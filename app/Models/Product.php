<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'description',
        'detailed_description',
        'specifications',
        'price',
        'discount_price',
        'stock_quantity',
        'weight',
        'origin',
        'care_instructions',
        'category',
        'image_path',
        'gallery_images',
        'is_available',
        'is_featured',
        'harvest_date'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'specifications' => 'array',
        'gallery_images' => 'array',
        'harvest_date' => 'datetime',
    ];

    /**
     * Get the available categories for products
     */
    public static function getCategories()
    {
        return ['durian', 'makanan', 'minuman', 'bibit'];
    }

    /**
     * Get category display names
     */
    public static function getCategoryDisplayNames()
    {
        return [
            'durian' => 'Durian',
            'makanan' => 'Makanan',
            'minuman' => 'Minuman',
            'bibit' => 'Bibit'
        ];
    }

    /**
     * Get the display name for the category
     */
    public function getCategoryDisplayNameAttribute()
    {
        $displayNames = self::getCategoryDisplayNames();
        return $displayNames[$this->category] ?? ucfirst($this->category);
    }

    /**
     * Get the final price (discount price if available, otherwise regular price)
     */
    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    /**
     * Check if product has discount
     */
    public function hasDiscount()
    {
        return $this->discount_price && $this->discount_price < $this->price;
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentageAttribute()
    {
        if (!$this->hasDiscount()) {
            return 0;
        }

        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    /**
     * Check if product is in stock
     */
    public function isInStock()
    {
        return $this->stock_quantity > 0;
    }

    /**
     * Get stock status
     */
    public function getStockStatusAttribute()
    {
        if ($this->stock_quantity > 10) {
            return 'in_stock';
        } elseif ($this->stock_quantity > 0) {
            return 'low_stock';
        } else {
            return 'out_of_stock';
        }
    }

    /**
     * Get all gallery images including main image
     */
    public function getAllImagesAttribute()
    {
        $images = [];

        // Add main image first
        if ($this->image_path) {
            $images[] = $this->image_path;
        }

        // Add gallery images
        if ($this->gallery_images) {
            $images = array_merge($images, $this->gallery_images);
        }

        return $images;
    }

    /**
     * Get formatted weight
     */
    public function getFormattedWeightAttribute()
    {
        if (!$this->weight) {
            return null;
        }

        if ($this->weight >= 1000) {
            return number_format($this->weight / 1000, 1) . ' kg';
        } else {
            return number_format($this->weight, 0) . ' gram';
        }
    }

    /**
     * Get the reviews for the product.
     */
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * Get approved reviews for the product.
     */
    public function approvedReviews()
    {
        return $this->hasMany(ProductReview::class)->approved();
    }

    /**
     * Get average rating for the product.
     */
    public function getAverageRatingAttribute()
    {
        return $this->approvedReviews()->avg('rating') ?? 0;
    }

    /**
     * Get total reviews count.
     */
    public function getTotalReviewsAttribute()
    {
        return $this->approvedReviews()->count();
    }

    /**
     * Get rating breakdown (count of each star rating)
     */
    public function getRatingBreakdownAttribute()
    {
        $breakdown = [];
        for ($i = 1; $i <= 5; $i++) {
            $breakdown[$i] = $this->approvedReviews()->where('rating', $i)->count();
        }
        return $breakdown;
    }
}
